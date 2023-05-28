<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin/home/index')->with('users', $users);
    }

    public function create()
    {
        return view('admin.home.create');
    }
}
