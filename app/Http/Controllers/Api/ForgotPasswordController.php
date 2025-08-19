<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class ForgotPasswordController extends Controller
{
    use ApiResponse;

    public function sendResetCodeEmail(Request $request)
    {
        $request->validate([
            'value'=>'required'
        ]);

        if(!verifyCaptcha()){
            $notify = __('Invalid captcha provided');
            return $this->notFound($notify);
        }

        $fieldType = $this->findFieldType();
        $user = User::where($fieldType, $request->value)->first();

        if (!$user) {
            $notify = __('Couldn\'t find any account with this information');
            return $this->notFound($notify);
        }

        PasswordReset::where('email', $user->email)->delete();
        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = Carbon::now();
        $password->save();

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();

        notify($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ],['email']);

        $email = $user->email;


        $notify = __('Password reset email sent successfully');

        return $this->successResponse($email, $notify);
    }



    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required'
        ]);

        $code =  $request->code;

        if (PasswordReset::where('token', $code)->where('email', $request->email)->count() != 1) {
            $notify = __('Verification code doesn\'t match');

            return $this->notFound($notify);
        }

        $notify = __('You can change your password.');

        return $this->successResponse($code, $notify);

    }


    public function findFieldType()
    {
        $input = request()->input('value');

        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $input]);

        return $fieldType;
    }


    public function resetPassword(Request $request)
    {
       try{
            $passwordValidation = Password::min(6);

            if (gs('secure_password')) {
                $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
            }

            $validator = Validator($request->all(), [
                'code' => 'required',
                'email' => 'required',
                'password' => ['required', $passwordValidation],
            ]);


            if($validator->fails()){
                return $this->validationError(  $validator->errors());
            }

            $code =  $request->code;

            if (PasswordReset::where('token', $code)->where('email', $request->email)->count() != 1) {
                $notify = __('Verification code doesn\'t match');

                return $this->notFound($notify);
            }


            $user = User::where('email', $request->email)->first();

            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return $this->successResponse($user,  __('Password reset successfully'));
       } catch (\Exception $e) {
            return $this->serverError();
       }
    }

}
