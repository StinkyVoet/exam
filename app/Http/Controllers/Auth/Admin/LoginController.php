<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $remember = $request->has('remember_me');

        if($validated['username'] !== 'admin' || $validated['password'] !== '#1Geheim') {
            return redirect()->back()->withErrors(['msg' => 'Credentials did not match an existing user']);
        }
        Auth::loginUsingId(1);

        return redirect(route('trips.index'));
    }
}
