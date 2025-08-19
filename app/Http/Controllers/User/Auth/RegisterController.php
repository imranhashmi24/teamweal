<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Models\Country;
use App\Constants\Status;
use App\Models\UserLogin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('registration.status');
    }

    public function showRegistrationForm()
    {
        $countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->get();
        return view('user.auth.register', compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        if (preg_match("/[^a-z0-9_]/", trim($request->username))) {
            $notify[] = ['info', 'Username can contain only small letters, numbers and underscore.'];
            $notify[] = ['error', 'No special character, space or capital letters in username.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $exist = User::where('mobile', $request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }

        event(new Registered($user = $this->create($request->all())));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function validator(array $data)
    {
        $general = gs();
        $passwordValidation = Password::min(6);
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }
    
        $validate = Validator::make($data, [
            'email' => 'required|string|email|unique:users',
            'mobile' => 'required|unique:users|regex:/^([0-9]*)$/',
            'name' => 'required|string|max:192',
            'city' => 'required|string|max:192',
            'entity_type' => 'required|in:Individual,Establishment,Company',
            'commercial_registration_no' => 'required|string|max:192',
            'country' => 'required|exists:countries,id',
            'website' => 'nullable|url|max:192',
            'social_media' => 'nullable|string|max:255',
            'service_description' => 'required|string|max:1000',
            'pre_experience_project' => 'nullable|string|max:1000',
            'target_clients' => 'nullable|array',
            'target_clients.*' => 'in:Individuals,Companies,Government Entities',
            'certificates' => 'nullable|array',
            'certificates.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'preferred_communication' => 'required|in:Email,Phone,WhatsApp',
            'best_time_to_contact' => 'nullable|string|max:192',
            'estimated_response_time' => 'nullable|string|max:192',
            'commercial_registration_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'portfolio_files' => 'nullable|array',
            'portfolio_files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'company_profile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'password' => ['required', 'confirmed', $passwordValidation],
            'username' => 'required|unique:users|min:6',
            'captcha' => 'sometimes|required',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable',
            'agree' => $agree
        ], [
            // General validation messages
            'required' => __('This field is required'),
            'string' => __('Please enter a valid text'),
            'email' => __('Please enter a valid email address'),
            'unique' => __('This value is already taken'),
            'max.string' => __('Text should not exceed :max characters'),
            'max.file' => __('File size should not exceed :max KB'),
            'in' => __('The selected value is invalid'),
            'exists' => __('The selected value does not exist'),
            'url' => __('Please enter a valid URL'),
            'array' => __('Please select valid options'),
            'file' => __('Please upload a valid file'),
            'mimes' => __('Allowed file types: :values'),
            'confirmed' => __('Confirmation does not match'),
            'min.string' => __('Should be at least :min characters'),
            'regex' => __('Invalid format'),
            
            // Field-specific messages
            'email.required' => __('Please enter your email address'),
            'email.email' => __('Please enter a valid email'),
            'email.unique' => __('This email is already registered'),
            'mobile.required' => __('Please enter your mobile number'),
            'mobile.unique' => __('This mobile number is already registered'),
            'mobile.regex' => __('Mobile number should contain only numbers'),
            'name.required' => __('Please enter your name'),
            'city.required' => __('Please enter your city'),
            'entity_type.required' => __('Please select entity type'),
            'commercial_registration_no.required' => __('Please enter commercial registration number'),
            'country.required' => __('Please select your country'),
            'service_description.required' => __('Please describe your services'),
            'preferred_communication.required' => __('Please select preferred communication method'),
            'commercial_registration_file.required' => __('Please upload commercial registration file'),
            'password.required' => __('Please enter a password'),
            'password.confirmed' => __('Password confirmation does not match'),
            'username.required' => __('Please choose a username'),
            'username.unique' => __('This username is already taken'),
            'username.min' => __('Username should be at least 6 characters'),
            'category_id.required' => __('Please select a category'),
            'agree.required' => __('You must agree to the terms and conditions')
        ]);
    
        return $validate;
    }

    protected function create(array $data)
    {
        // Handle file uploads
        $commercialRegistrationPath = $data['commercial_registration_file']->store('uploads/commercial_registrations', 'public');
        $certificatePaths = [];
        $portfolioPaths = [];
        $companyProfilePath = null;

        if (isset($data['certificates'])) {
            foreach ($data['certificates'] as $certificate) {
                $certificatePaths[] = $certificate->store('uploads/certificates', 'public');
            }
        }

        if (isset($data['portfolio_files'])) {
            foreach ($data['portfolio_files'] as $portfolio) {
                $portfolioPaths[] = $portfolio->store('uploads/portfolios', 'public');
            }
        }

        if (isset($data['company_profile'])) {
            $companyProfilePath = $data['company_profile']->store('uploads/company_profiles', 'public');
        }

        // User Create
        $user = new User();
        $user->email = strtolower($data['email']);
        $user->password = Hash::make($data['password']);
        $user->username = $data['username'];
        $user->country_id = $data['country'];
        $user->mobile = $data['mobile'];
        $user->name = $data['name'];
        $user->city = $data['city'];
        $user->entity_type = $data['entity_type'];
        $user->commercial_registration_no = $data['commercial_registration_no'];
        $user->website = $data['website'] ?? null;
        $user->social_media = $data['social_media'] ?? null;
        $user->service_description = $data['service_description'];
        $user->pre_experience_project = $data['pre_experience_project'] ?? null;
        $user->target_clients = isset($data['target_clients']) ? json_encode($data['target_clients']) : null;
        $user->preferred_communication = $data['preferred_communication'];
        $user->best_time_to_contact = $data['best_time_to_contact'] ?? null;
        $user->estimated_response_time = $data['estimated_response_time'] ?? null;
        $user->commercial_registration_file = $commercialRegistrationPath;
        $user->certificates = !empty($certificatePaths) ? json_encode($certificatePaths) : null;
        $user->portfolio_files = !empty($portfolioPaths) ? json_encode($portfolioPaths) : null;
        $user->company_profile = $companyProfilePath;
        $user->category_id = $data['category_id'];
        $user->sub_category_id = $data['sub_category_id'];
        $user->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'city' => $data['city']
        ];
        $user->ev = gs()->ev ? Status::NO : Status::YES;
        $user->sv = gs()->sv ? Status::NO : Status::YES;
        $user->profile_complete = Status::YES;
        $user->save();

        // Admin Notification
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New service provider registered';
        $adminNotification->click_url = urlPath('admin.users.detail', $user->id);
        $adminNotification->save();

        // Login Log Create
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        if ($exist) {
            $userLogin->longitude = $exist->longitude;
            $userLogin->latitude = $exist->latitude;
            $userLogin->city = $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country = $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude = @implode(',', $info['long']);
            $userLogin->latitude = @implode(',', $info['lat']);
            $userLogin->city = @implode(',', $info['city']);
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country = @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip = $ip;
        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();

        return $user;
    }

    public function checkUser(Request $request)
    {
        $exist['data'] = false;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = User::where('email', $request->email)->exists();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = User::where('mobile', $request->mobile)->exists();
            $exist['type'] = 'mobile';
        }
        if ($request->username) {
            $exist['data'] = User::where('username', $request->username)->exists();
            $exist['type'] = 'username';
        }
        return response($exist);
    }
}