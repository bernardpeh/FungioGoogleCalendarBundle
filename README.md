# Google Calendar Bundle

This bundle use Google API for list, create, or update events in Google Calendar.

Please feel free to contribute, to fork, to send merge request and to create ticket.

## Requirement

### Create a API account

Go to the developers console : https://console.developers.google.com

Create an oauth ID. Do not forget the redirect Uri.

Click on "Download JSON" to get your client_secret.json

## Installation

### Step 1: Install GoogleCalendarBundle

In composer.json

```
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/bernardpeh/GoogleCalendarBundle"
        }
],
"require": {
  "bpeh/google-calendar-bundle": "dev-master"
  ...
}
```

then

```
composer update
```

### Step 2: Enable the bundle

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        // ...
        new Bpeh\GoogleCalendarBundle\BpehGoogleCalendarBundle()
    ];
}
```

### Step 3: Configuration

```yml
# app/config/config.yml

# google calendar
bpeh_google_calendar:
    application_name: "Google Calendar"
    credentials_path: "%kernel.root_dir%/config/google_credentials.json"
    client_secret_path: "%kernel.root_dir%/config/google_client_secret.json"
```

where google_client_secret.json is the file downloaded from google console previously

and

google_credentials.json is to be generated dynamically by running init_google_calendar.php from the command line. init_google_calendar.php can be found under the Service folder. You only need to run this once from the command line, after which it will be dynamically generated when the token expires.

```
# follow the prompts after running this line
php init_google_calendar.php
```

**Make sure this google_credentials.json is WRITABLE.**

## Example

``` php
<?php
// in a controller
$googleCalendar = $this->get('bpeh.google_calendar');
$events = $googleCalendar->getEventsForDate('primary', new \DateTime('now');
```
