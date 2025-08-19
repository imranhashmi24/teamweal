<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $countries = \App\Models\Country::orderByRaw('ISNULL(sort_order), sort_order')->get();
        return view('user.profile_setting', compact('user', 'countries'));
    }

    public function submitProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:192',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'entity_type' => 'required|in:Individual,Establishment,Company',
            'commercial_registration_no' => 'required|string|max:192',
            'country' => 'required|exists:countries,id',
            'city' => 'required|string|max:192',
            'mobile' => 'required|regex:/^([0-9]*)$/|unique:users,mobile,'.$user->id,
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'website' => 'nullable|url|max:192',
            'social_media' => 'nullable|string|max:255',
            'service_description' => 'required|string|max:1000',
            'pre_experience_project' => 'nullable|string|max:1000',
            'target_clients' => 'nullable|array',
            'target_clients.*' => 'in:Individuals,Companies,Government Entities',
            'preferred_communication' => 'required|in:Email,Phone,WhatsApp',
            'best_time_to_contact' => 'nullable|string|max:192',
            'estimated_response_time' => 'nullable|string|max:192',
            'commercial_registration_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'certificates' => 'nullable|array',
            'certificates.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'portfolio_files' => 'nullable|array',
            'portfolio_files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'company_profile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'address' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:255',
        ]);

        // Handle file uploads
        if ($request->hasFile('commercial_registration_file')) {
            try {
                $old = $user->commercial_registration_file;
                $user->commercial_registration_file = fileUploader(
                    $request->commercial_registration_file, 
                    'uploads/commercial_registrations',
                    null,
                    $old
                );
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload commercial registration file'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('certificates')) {
            $certificatePaths = [];
            foreach ($request->file('certificates') as $certificate) {
                try {
                    $certificatePaths[] = fileUploader($certificate, 'uploads/certificates');
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload one or more certificates'];
                    return back()->withNotify($notify);
                }
            }
            $user->certificates = json_encode($certificatePaths);
        }

        if ($request->hasFile('portfolio_files')) {
            $portfolioPaths = [];
            foreach ($request->file('portfolio_files') as $portfolio) {
                try {
                    $portfolioPaths[] = fileUploader($portfolio, 'uploads/portfolios');
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload one or more portfolio files'];
                    return back()->withNotify($notify);
                }
            }
            $user->portfolio_files = json_encode($portfolioPaths);
        }

        if ($request->hasFile('company_profile')) {
            try {
                $old = $user->company_profile;
                $user->company_profile = fileUploader(
                    $request->company_profile, 
                    'uploads/company_profiles',
                    null,
                    $old
                );
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload company profile'];
                return back()->withNotify($notify);
            }
        }

        // Handle profile image
        if ($request->hasFile('image')) {
            try {
                $old = $user->image;
                $user->image = fileUploader(
                    $request->image, 
                    getFilePath('userProfile'), 
                    getFileSize('userProfile'), 
                    $old
                );
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        // Update user data
        $user->name = $request->name;
        $user->entity_type = $request->entity_type;
        $user->commercial_registration_no = $request->commercial_registration_no;
        $user->country_id = $request->country;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->website = $request->website;
        $user->social_media = $request->social_media;
        $user->service_description = $request->service_description;
        $user->pre_experience_project = $request->pre_experience_project;
        $user->target_clients = json_encode($request->target_clients ?? []);
        $user->preferred_communication = $request->preferred_communication;
        $user->best_time_to_contact = $request->best_time_to_contact;
        $user->estimated_response_time = $request->estimated_response_time;
        $user->category_id = $request->category_id;
        $user->sub_category_id = $request->sub_category_id;
        
        $user->address = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$user->address->country,
            'city' => $request->city,
        ];

        $user->save();

        $notify[] = ['success', 'Profile updated successfully'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function submitPassword(Request $request)
    {
        $passwordValidation = Password::min(6);
        if (gs('secure_password')) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', $passwordValidation],
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }
}