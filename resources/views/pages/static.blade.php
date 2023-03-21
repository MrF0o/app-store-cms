@extends('layouts.main')

@section('content')
    @include('pages.inc.header')

    <div class="max-w-screen z-[-100] absolute top-0 left-48">
        <img class="w-full" src="{{ asset('images/main-top-bg.png') }}" alt>
    </div>

    <div class="pt-24 px-2 md:px-0 lg:px-10 xl:px-32 z-40 bg-white/60 flex justify-center padd">
        <div class="bg-white xl:w-8/12 md:w-10/12 p-3 rounded-md shadow-md mb-10">
            <div class="py-2">
                <h1 class="text-xl font-semibold">{{ $page->title }}</h1>
            </div>
            <div class="wysiwyg">
                {!! $page->content !!}
            </div>
        </div>
    </div>

    @include('pages.inc.footer')
@endsection
