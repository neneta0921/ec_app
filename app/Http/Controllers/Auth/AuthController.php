<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

class AuthController extends Controller
{

    public function TwitterRedirect()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function TwitterCallback()
    {
        // OAuthユーザー情報を取得
        $social_user = Socialite::driver('twitter')->user();
        $user = $this->first_or_create_social_user('twitter', $social_user->id, $social_user->name, $social_user->email, $social_user->avatar );

        // Laravel 標準の Auth でログイン
        \Auth::login($user);

        return redirect('/');
    }

    /**
     * ログインしたソーシャルアカウントがDBにあるかどうか調べます
     *
     * @param   string      $service_name       ( twitter , facebook ... )
     * @param   int         $social_id          ( 123456789 )
     * @param   string      $social_avatar      ( https://....... )
     *
     * @return  User   $user
     *
     */
    protected function first_or_create_social_user( string $service_name,
                                                int $social_id, string $social_name, string $social_email, string $social_avatar )
    {
        $user = null;
        $user = User::where( "{$service_name}_id", '=', $social_id )->first();
        if ( $user === null ){
            $user = new User();
            $user->fill( [
                "{$service_name}_id" => $social_id ,
                'name'               => $social_name ,
                'email'               => $social_email ,
                'avatar'             => $social_avatar ,
                'password'           => 'DUMMY_PASSWORD' ,
            ] );
            $user->save();
            return $user;
        }
        else{
            return $user;
        }
    }
}