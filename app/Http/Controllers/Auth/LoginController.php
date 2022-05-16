<?php

namespace App\Http\Controllers\Auth;

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
            'email' => 'email|required',
            'password' => 'string',
        ]);
        $remember = $request->has('remember_me');
        if(!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember)) {
            return redirect()->back()->withInput()->withErrors(['msg' => 'Credentials did not match an existing user']);
        }
        return redirect(route('trip'));
    }
}
