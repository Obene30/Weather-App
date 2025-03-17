<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function sendInquiry(Request $request)
    {
        // ✅ Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // ✅ Email details
        $emailData = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // ✅ Send email using Laravel's Mail facade
        Mail::send([], [], function ($message) use ($emailData) {
            $message->to('support@tech-premier.com')  // Change this to your support email
                    ->subject('New Contact Inquiry from ' . $emailData['name'])
                    ->setBody(
                        "Name: {$emailData['name']}\n".
                        "Email: {$emailData['email']}\n".
                        "Message: {$emailData['message']}",
                        'text/plain'
                    );
        });

        // ✅ Show success message
        return back()->with('success', 'Your inquiry has been sent successfully. We will get back to you soon!');
    }
}
