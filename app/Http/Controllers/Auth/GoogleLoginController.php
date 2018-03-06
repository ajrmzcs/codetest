<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Calendar;
use Socialite;

class GoogleLoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->scopes([Google_Service_Calendar::CALENDAR_READONLY])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     * @return mixed
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')
            ->scopes([Google_Service_Calendar::CALENDAR])
            ->stateless()->user();

        $google_client_token = [
            'access_token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in' => $user->expiresIn
        ];

        $client = new Google_Client();
        $client->setApplicationName("Laravel test");
        $client->setDeveloperKey(env('GOOGLE_CLIENT_ID'));
        $client->setAccessToken(json_encode($google_client_token));

        $service = new Google_Service_Calendar($client);

        dd($service->events->listEvents('ajrmzcs@gmail.com',[])->getItems());


        dd($user);
    }
}
