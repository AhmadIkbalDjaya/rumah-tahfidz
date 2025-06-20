<!DOCTYPE html>
<html
  lang="{{ str_replace("_", "-", app()->getLocale()) }}"
  data-theme="light"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
      {{ isset($title) && $title != "" ? "$title - " . env("APP_NAME") : env("APP_NAME") }}
      
    </title>

    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>
  <body>
    {{ $slot }}
  </body>
</html>
