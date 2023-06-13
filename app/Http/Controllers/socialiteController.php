<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Socialite;

use App\Models\Usuario;

class socialiteController extends Controller
{
    public function login_google()
	{
	    $user_google = Socialite::driver('google')->user();
	    
	    $email = $user_google->getEmail();
	    $user = Usuario::where('email', $email)->first();

	    if ($user) {
	        Auth::login($user);

	        //preenchendo os dados da sessão
	        Session::put($user->toArray());

	        return redirect()->route('dashboard');

	    } else {
	        return 'ERRO';
	    }
	}


}
