<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite([
            'resources/css/sass/app.sass',
            'resources/js/app.js',
        ])
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

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="uk-alert-danger" uk-alert>{!! $error !!}</div>
                @endforeach
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
