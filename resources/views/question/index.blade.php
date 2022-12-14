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
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="container mx-auto">

            </header>

            <!-- Page Content -->
            <main>

        <a href = {{ route('question.create') }} class="rounded-full bg-green-200 px-3">Create</a>

@foreach ($questions as $question)

    <div class= "container mx-10 my-10 ">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-xl font-bold">{{ $question->title }} </div>
                    <div>{{ $question->content}} </div>
                    <div class="flex">
        <a href = {{ route('question.show', ['question' => $question->id]) }} class="rounded-full bg-blue-400 px-3">ver</a>
        <a href = {{ route('question.edit', ['question' => $question->id]) }} class="rounded-full bg-green-200 px-3">edit</a>

        <form action=" {{ route('question.destroy', $question->id )}}" method="POST" >

            @csrf
            @method('DELETE')

            <input type="submit" value="delete" class="rounded bg-red-200 px-3">

            </form>
            </div>
                </div>
            </div>
        </div>

    </div>
@endforeach
            </main>
        </div>
    </body>
</html>
