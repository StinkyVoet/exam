<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // Check of input in juiste format is
        $validated = $request->validate([
            'email' => 'email|required',
            'password' => 'required|string',
        ]);
        $remember = $request->has('remember_me');

        // Check of bijbehorend account het adminaccount is
        $username = User::select('name')->where('email', $validated['email'])->get();
        if($username === 'admin') {
            return redirect()->back()->withInput()->withErrors(['msg' => 'Credentials did not match an existing user']);
        }

        // Probeer in te loggen
        if(!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember)) {
            return redirect()->back()->withInput()->withErrors(['msg' => 'Credentials did not match an existing user']);
        }

        return redirect(route('trips.index'));
    }
}
