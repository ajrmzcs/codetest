<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomGoogleCalendar;
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

        $calendarEvents = (new CustomGoogleCalendar())->getCalendarEvents($google_client_token, $user->email);

        return view('calendar', compact('calendarEvents'));

    }
}
