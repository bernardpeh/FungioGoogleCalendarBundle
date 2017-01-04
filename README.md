# Google Calendar Bundle

This bundle use Google API for list, create, or update events in Google Calendar.

Please feel free to contribute, to fork, to send merge request and to create ticket.

## Requirement

### Create a API account

Go to the developers console : https://console.developers.google.com

Create an oauth ID. Do not forget the redirect Uri.

Click on "Download JSON" to get your client_secret.json

Get the sample php to create the credentials.json. Make sure this credentials.json is WRITABLE.

https://developers.google.com/google-apps/calendar/quickstart/php


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
# app/config/parameters.yml

bpeh_google_calendar:
    application_name: "Google Calendar"
    credentials_path: "%kernel.root_dir%/.credentials/calendar.json"
    client_secret_path: "%kernel.root_dir%/Resources/GoogleCalendarBundle/client_secret.json"
```


## Example

``` php
<?php
// in a controller
$request = $this->getMasterRequest();

$googleCalendar = $this->get('bpeh.google_calendar');
$googleCalendar->setRedirectUri($redirectUri);

if ($request->query->has('code') && $request->get('code')) {
    $client = $googleCalendar->getClient($request->get('code'));
} else {
    $client = $googleCalendar->getClient();
}

if (is_string($client)) {
    return new RedirectResponse($client);
}

$events = $googleCalendar->getEventsForDate('primary', new \DateTime('now');
```
