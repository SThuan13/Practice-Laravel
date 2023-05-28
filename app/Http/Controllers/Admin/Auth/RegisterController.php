<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailNotify;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registration(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.auth.register');
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        
        // $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));

        return redirect()->route('admin.login')->with('message', 'Successfully registered!');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $mailData = [
            'title' => 'Mail from exampleapp',
            'body' => 'Registration success',
        ];

        Mail::to($data['email'])->send(new MailNotify($mailData));
        
        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin'
        ]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
