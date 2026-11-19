<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:120', 'not_regex:/[\r\n]/'],
            'email' => ['required', 'email', 'max:254'],
            'subject' => ['required', 'string', 'max:160', 'not_regex:/[\r\n]/'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        if ($validator->fails()) {
            return redirect()->to(route('home').'#contact')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        ContactMessage::query()->create($validated);
        $body = implode("\n\n", [
            "From: {$validated['name']} <{$validated['email']}>",
            $validated['message'],
        ]);

        Mail::raw($body, function ($mail) use ($validated): void {
            $mail->to('sagarshrestha813@gmail.com')
                ->replyTo($validated['email'], $validated['name'])
                ->subject($validated['subject']);
        });

        return redirect()->to(route('home').'#contact')->with('success', 'Thank you. Your message has been sent.');
    }
}
