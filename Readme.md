# Google Calendar API with Laravel Socialite

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This is a basic Google Authentication with Laravel Socialite to show a current year calendar.

![alt text](https://raw.githubusercontent.com/ajrmzcs/codetest/master/sample.PNG)

### Installation steps:
* Clone this repository
* Activate Google+ and Google Calendar Apis and obtain credentials from google developer console
* Copy .env from .env-example
* Set google credentials in .env file
* Add Google Console Applicaction name to config/calendar.php array under google-application-name
* run in terminal:
    ```bash
    composer install
    ```
* setup a ngrok public url
* set your ngrok public url on credentials callback url in google developer console  
