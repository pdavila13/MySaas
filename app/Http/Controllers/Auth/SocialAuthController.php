<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Mockery\CountValidator\Exception;
use Symfony\Component\Routing\Tests\Fixtures\RedirectableUrlMatcher;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToAuthenticationServiceProvider($provider) {
        return Socialite::driver($provider)->redirect();

    }

    public function handleAuthenticationServiceProviderCallback($provider) {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return Redirect::to('auth' . $provider);
        }

        //dd($user);

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return Redirect::to('home');
    }

    public function findOrCreateUser($providerUser, $provider) {
        if ($authUser = $this->userExistsByProviderUserId($providerUser))
            return $authUser;
        return $this->createUser($providerUser, $provider);
    }

    private function createUser($providerUser, $provider){
        if (! $user = $this->userExistsByEmail($providerUser)) {
            $user = $this->newUser();
            foreach (['name','email','avatar'] as $item) {
                $user->$item = $providerUser->$item;
            }
            $user->save();
        }
        $oAuthIdentity = new OAuthIdentity();
        $oAuthIdentity->provider_user_id = $providerUser->getId();
        $oAuthIdentity->provider = $provider;
        $oAuthIdentity->access_token = $providerUser->token;
        $oAuthIdentity->user_id = $user->id;
        $oAuthIdentity->avatar = $providerUser->getAvatar();
        $oAuthIdentity->name = $providerUser->getName();
        $oAuthIdentity->nickname = $providerUser->getNickname();
        $oAuthIdentity->save();
        return $user;
    }

    private function newUser() {
        $user_model = Config::get('acacha-socialite.model');
        return new $user_model;
    }

    private function userExistsByProviderUserId($providerUser) {
        /** @var OAuthIdentity $provUser */
        if ( $provUser = OAuthIdentity::where('provider_user_id', $providerUser->id)->first()) {
            return $provUser->user;
        }
        return false;
    }

    private function userExistsByEmail($providerUser) {
        if ( $user = User::where('email', $providerUser->email)->first()) {
            return $user;
        }
        return false;
    }
}
