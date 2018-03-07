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
     * @return array
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

        $events = $service->events->listEvents($calendarId,$opt_params)->getItems();

        $dateArray = getdate();
        $year = $dateArray['year'];
        $months = config('calendar.months');
        $daysPerMonth = [];

        // Prepare yearly data
        foreach ($months as $key => $month) {

            // Date for first day of month
            $monthFirstDay = mktime(0,0,0,$key,1,$year);

            // Days of the month
            $daysOfMonth = date('t',$monthFirstDay);

            $daysPerMonth[$month] = $daysOfMonth;

        }

        // Prepare calendar data
        $calendarData = [];
        foreach ($daysPerMonth as $month => $days)
        {
            for ($i=1; $i<=$days; $i++) {
                $calendarData[$year][$month][$i] = null;

            }
        }

        // Add calendar events to calendar array
        foreach ($events as $event) {
            $eventYear = date('Y',strtotime($event->start->dateTime));
            $eventMonth = date('F',strtotime($event->start->dateTime));
            $eventDay = intval(date('d',strtotime($event->start->dateTime)));

            $colorArray = config('calendar.colors');

            $color = isset($colorArray[$event->colorId]) ? $colorArray[$event->colorId] : null;

            $calendarData[$eventYear][$eventMonth][$eventDay] = [
                'color' => $color,
                'summary' => $event->summary,
            ];
        }

        return $calendarData;

    }

}