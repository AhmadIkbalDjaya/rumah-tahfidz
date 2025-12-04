<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
      function setTheme() {
        try {
          document.documentElement.setAttribute(
            'data-theme',
            localStorage.getItem('theme') || 'light',
          );
        } catch (e) {}
      }

      setTheme();

      document.addEventListener('livewire:navigated', () => {
        setTheme();
      });
    </script>

    <title>
      {{ isset($title) && $title != "" ? "$title - " . config("APP_NAME") : config("APP_NAME") }}
      
    </title>

    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>
  <body>
    <x-toast />
    {{ $slot }}
    @vite(["resources/js/alpine-data.js"])
  </body>
</html>
