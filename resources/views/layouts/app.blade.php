<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/css/uikit.min.css" />
    </head>
    <body>
        <div class="uk-container">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if(session()->has('message'))
            <div class="uk-alert uk-alert-primary">
                <p>{{ session()->get('message') }}</p>
            </div>
            @endif

            @if (session()->has('error'))
                <div class="uk-alert-danger" uk-alert>{!! session()->get('error') !!}</div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/js/uikit-icons.min.js"></script>
    </body>
</html>
