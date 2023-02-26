@extends('layouts.main')

@section('content')
    @include('pages.inc.header')

    <div class="max-w-screen z-[-100] absolute top-0 left-48">
        <img class="w-full" src="{{ asset('images/static/main-top-bg.png') }}" alt>
    </div>

    <div class="pt-24 px-2 md:px-0 lg:px-10 xl:px-32 z-40 bg-white/60 flex">
        <div class="flex-1">
            @include('pages.inc.app-details')
        </div>
        <div class="hidden lg:block lg:w-3/12">
            @include('pages.inc.sidebar')
        </div>
    </div>

    @include('pages.inc.footer')
@endsection