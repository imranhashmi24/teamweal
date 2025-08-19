<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::query()->searchable(['first_name', 'last_name', 'email', 'phone'])->latest()->paginate(getPaginate());
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::find($id);
        $message->update(['seen_at' => now()]);
        return view('admin.messages.show', compact('message'));
    }
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'reply' => ['required', 'min:3']
        ]);


        $message->update(
            ['reply' => $request->reply]
        );

        if ($request->input('send_email')) {
            try {
                $message = 'Mailed successfully';
                Mail::send(new ContactMessageMail(auth()->user(), $message));

            } catch (\Throwable $th) {
                $message = 'Mail server config error.';
            }
        }

        $message = 'Replyed successfully';

        $notify[] = ['success', $message];
        return back()->withNotify($notify);

    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        $notify[] = ['success', 'Message has been deleted successfully'];
        return back()->withNotify($notify);
    }
}
