<?php namespace App\Http\Controllers\Auth;

use Auth;
use Crypt;
use Validator;
use App\Models\User;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite as Socialize;


class SocialController extends Controller {

	public function getSource($media)
	{
	    return Socialize::driver($media)->scopes(['email'])->redirect();
	}

	public function getCallback($media)
	{
	    $userData = Socialize::driver($media)->user();
			$social = SocialAccount::where('email', $userData->getEmail())->where('provider', $media)->first();
			$user = User::where('email', $userData->getEmail())->first();
    	if($social)
    	{
    		// TODO: update the user social media data
    		if($social->user_id)
    		{
	        	Auth::loginUsingId($social->user_id);
    				return redirect('/');
    		}
    	}
    	else
    	{
    		$social = SocialAccount::create([
		        'email' 		=> $userData->getEmail(),
		        'provider' 		=> $media,
		        'provider_uid' 	=> $userData->getId(),
		        'data' 			=> serialize($userData)
			]);

    		if($user)
    		{
    			$social->user_id = $user->id;
    			$social->save();
	        	Auth::login($user);
    			return redirect('/');
    		}

	    }

		$data = [
			'name'					=> $userData->getName(),
			'email' 				=> $userData->getEmail(),
			'social_id'				=> Crypt::encrypt($social->id)
		];
		return view('auth.completeRegister')
					->with('data', $data);
	}

	public function postCompleteRegister(Request $request)
	{
		try
		{
		    $sid = Crypt::decrypt($request->sid);
		}
		catch (DecryptException $e)
		{
		    return 'social data error';
		}
	  $social = SocialAccount::find($sid);
		$user_array = [
			'name'					=> $request->name,
			'username' 				=> $request->username,
			'password' 				=> $request->password,
			'password_confirmation'	=> $request->password_confirmation,
			'active'				=> true,
			'email' 				=> $social->email,
			'social_id'				=> $sid
		];
		$validator = Validator::make($user_array, [
			'name' 		=> 'required|max:255',
			'username' 	=> 'required|max:255|unique:users',
			'email'		=> 'required|email|max:255|unique:users',
			'password'	=> 'required|confirmed|min:6',
		]);
		if ($validator->fails())
			return view('auth.completeRegister')
                    ->withErrors($validator)
					->with('data', $user_array);

		$user_array['password'] = bcrypt( $user_array['password'] );
    $user = User::registerNewUser($user_array);
    $social->user_id = $user->id;
    $social->save();
    Auth::login($user);
		return redirect('/');
	}
}
