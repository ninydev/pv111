<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show ()
    {
        return view('pages.contact');
    }
    public function send (ContactRequest $request) {

//    // dd($request);
//    $validator = Validator::make($request->all(), [
//        'name' => 'required|min:2|max:255',
//        'email' => 'required|email',
//        'subject' => 'required',
//        'message' => 'required',
//    ]);
//
//    if (!$validator->fails()) {
//        $user = [
//            'name' => $request->input('name'),
//            'email' => $request->input('email'),
//            'subject' => $request->input('subject'),
//            'message' => $request->input('message')
//        ];
//        dd($user);
//    }

        // Проверяем прошла ли валидация
        if ($request->validated()) {
            // Ваш код, который выполняется, если валидация прошла успешно

            $user = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message')
            ];


            Mail::to('keeper@ninydev.com')->send(new ContactMail($user));

            // $user = $request->all(); // В этом случае будет загружен и token

            // dd($user);
        }


        return view('pages.contact');

    }
}
