<?php

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::get('/about', function () {
    return view('pages.about');
})->name('page.about');

Route::get('/news', function () {
    return view('pages.news');
})->name('page.news');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('page.contact');

Route::post('/contact', function (ContactRequest $request) {

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

})->name('form.contact');


Route::get('/info', function () {
    phpinfo();
});

Route::get('/test', function () {
    \Illuminate\Support\Facades\Log::debug("Hello Test");
    return "Hello Test";
});
