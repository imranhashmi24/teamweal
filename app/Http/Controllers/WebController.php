<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Frontend;
use App\Models\Language;
use App\Constants\Status;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\Auction;

class WebController extends Controller
{
    public function index()
    {
        $sections = Page::where('slug', '/')->first();
        return view('web.home', compact('sections'));
    }

    public function contact()
    {
        $user = auth()->user();
        return view('web.contact', compact('user'));
    }

    public function sectors()
    {
        $sections = Page::where('slug', 'sectors')->first();
        return view('web.pages.sectors', compact('sections'));
    }
    public function embeddedFinance()
    {
        $sections = Page::where('slug', 'embedded-finance')->first();
        return view('web.pages.embedded-finance', compact('sections'));
    }
    public function smartCollection()
    {
        $sections = Page::where('slug', 'smart-collection')->first();
        return view('web.pages.smart-collection', compact('sections'));
    }
    public function openBanking()
    {
        $sections = Page::where('slug', 'open-banking')->first();
        return view('web.pages.open-banking', compact('sections'));
    }
    public function events()
    {
        $sections = Page::where('slug', 'events')->first();
        return view('web.pages.events', compact('sections'));
    }
    public function marketing()
    {
        $sections = Page::where('slug', 'marketing')->first();
        return view('web.pages.marketing', compact('sections'));
    }
    public function investmentOpportunities()
    {
        $sections = Page::where('slug', 'investment-opportunities')->first();
        return view('web.pages.investment-opportunities', compact('sections'));
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;

        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new contact message has been submitted';
        $adminNotification->click_url = urlPath('admin.support.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('support.view', [$ticket->ticket])->withNotify($notify);
    }


    public function auction()
    {
        $sections = Page::where('slug', 'auctions-and-event')->first();
        return view('web.auctions_event', compact('sections'));
    }


    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) {
            $lang = 'en';
        }

        session()->put('lang', $lang);

        return back();
    }

    public function cookieAccept()
    {
        Cookie::queue('gdpr_cookie', gs('site_name'), 43200);
    }

    public function cookiePolicy()
    {
        $cookie = Frontend::where('data_keys', 'cookie.data')->first();
        return view('cookie', compact('cookie'));
    }


    public function pages($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        $title = $page->name;
        $sections = $page->secs;

        return view('pages', compact('title', 'sections'));
    }

    public function policyPages($slug, $id)
    {
        $policy = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $title = $policy->data_values->title;
        return view('policy', compact('policy', 'title'));
    }

    public function maintenance()
    {
        if (gs('maintenance_mode') == Status::DISABLE) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view('maintenance', compact('maintenance'));
    }

    public function subscribe(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:subscribers,email',
        ];
        $message = [
            "email.unique" => 'You have already subscribed',
        ];
        $validator = validator()->make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $subscribe = new Subscriber();
        $subscribe->email = $request->email;
        $subscribe->save();

        return response()->json(['success' => true, 'message' => 'Thanks for subscribe']);
    }



    public function fvtStore(Request $request)
    {

        $request->validate( [
            "type"        => "required|string",
            "property_id" => "required"
        ]);

        $type = $request->type;
        $property_id = $request->property_id;
        $message = fvtPost($type, $property_id);

        if($message){
            return response()->json([
                'status' => true,
                'message' => __('User already favorited this type. Existing favorite deleted.')
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => __('Favorite added successfully.')
            ]);
        }
    }

    public function service_request(Request $request)
    {

        $request->validate(
            [
                'service_id' => "nullable|numeric",
                'name' => "required|string|min:3|max:100",
                'email' => "required|string|email:rfc,dns|max:100",
                'mobile' => ['nullable', 'string'],
            ]
        );

        try {
            Order::create($request->all() + [
                'user_id' => auth()->id()
            ]);

            $message = __('Your request is been received and we will contact you shortly.');
            $notify[] = ['success', $message];
            return back()->withNotify($notify);

        } catch (Exception $e){
            $message = __('Something went wrong. Please try again');
            $notify[] = ['error', $message];
            return back()->withNotify($notify);
        }
    }

    public function e_service_request(Request $request)
    {
        $request->validate(
            [
                'name' => "required|string|max:100",
                'email' => "required|string|email:rfc,dns|max:100",
                'contact' => ['required', 'string', 'min:10', 'max:15'],
            ],
            [
                'contact.required' => 'The number field is required'
            ]
        );

        try{
            Order::create($request->all() + [
                'user_id' => auth()->id()
            ]);
            $message = __('Your request is been received and we will contact you shortly.');
            $notify[] = ['success', $message];
            return back()->withNotify($notify);
        } catch (Exception $e){
            $message = __('Something went wrong. Please try again');
            $notify[] = ['error', $message];
            return back()->withNotify($notify);
        }
    }

    public function contact_us(Request $request)
    {
        if (auth()->check()) {
            $request->merge([
                'email' => auth()->user()->email
            ]);
        }

        $validated_data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'required',
            'interested_project' => 'nullable',
            'capital' => 'nullable',
            'message' => 'required',
        ]);

        Message::create($validated_data);
        $notify[] = ['error', __('Message has been send successfully.')];

        return view('web.pages.success');
    }

    public function about_us()
    {
       
        return view('web.pages.about-us');
    }


    // public function services(Request $request, $slug = null)
    // {

    //     if ($slug != null) {
    //         $data['categories'] = Category::with('services')->where('id', $slug)->get();
    //         return view('web.pages.services', $data);
    //     }
    //     $data['categories'] = Category::where('is_featured', true)->orderBy('position','ASC')->with('childs.services')->get();
        
    //     return view('web.pages.services', $data);
    // }
    
    
    // public function categorywiseservices($id)
    // {
    //     $data['categories'] = Category::where('id',$id)->orderBy('position','ASC')->with('childs.services')->get();
    //     return view('web.pages.categorywiseservices', $data);
    // }
    
}


