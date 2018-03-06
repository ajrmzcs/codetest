<?php

namespace App\Helpers;


use Google_Client;
use Google_Service_Calendar;

class CustomGoogleCalendar
{

    protected $client;

    /**
     * @param $googleToken
     * @param $calendarId
     * @return \Google_Service_Calendar_Events
     */
    public function getCalendarEvents($googleToken, $calendarId)
    {

        $this->client = new Google_Client();

        $this->client->setApplicationName(config('calendar.google-application-name'));
            $this->client->setDeveloperKey(env('GOOGLE_CLIENT_ID'));
        $this->client->setAccessToken(json_encode($googleToken));

        // Get Calendar Object
        $service = new Google_Service_Calendar($this->client);

        $year = date('Y');

        // Query Params to retrieve only events form the current year
        $opt_params = [
            'timeMin' => date('c', mktime(0, 0, 0, 1, 1, $year)),
            'timeMax' => date('c', mktime(23, 59, 59, 12, 31, $year))
        ];

        dd($service->events->listEvents($calendarId,$opt_params)->getItems());


    }





}