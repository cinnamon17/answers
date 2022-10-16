
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        <div class="">
            @include('guest.navigation')

            <!-- Page Heading -->
            <header class="container mx-auto">

            </header>

            <!-- Page Content -->
            <main>

    <div class= "container mx-10 my-10 ">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-xl font-bold">{{ $question->title }} </div>
                    <div>{{ $question->content}} </div>
                    <div class="flex">


        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>{{ $answer->content}} </div>
                    <div class="flex">


            </div>
                </div>
            </div>
        </div>



            </div>
                </div>
            </div>
        </div>

    </div>
            </main>
        </div>
    </body>
</html>
