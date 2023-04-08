@extends('layouts.main')

@section('content')
    @include('pages.inc.header')

    <div class="max-w-screen z-[-100] absolute top-0 left-48">
        <img class="w-full" src="{{ asset('images/main-top-bg.png') }}" alt>
    </div>

    <div class="pt-24 px-2 md:px-0 lg:px-10 xl:px-32 z-40 bg-white/60 flex">
        <div class="flex-1 p-2">
            <div>
                <div class="category-title flex items-center">
                    <h4 class="font-bold text-xl">Categories</h4>
                </div>
                <div class="grid grid-cols-2 gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($cats as $c)
                        <div>
                            <a href="{{ route('category.index', [$c->slug, $c->id]) }}"
                                class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                                <div class="flex">
                                    <div class="h-6 w-6 flex-shrink-0">
                                        <img class="h-full w-full rounded-md"
                                            src="{{ Storage::url($c->icon_path) }}"
                                            alt="">
                                    </div>
                                    <div class="pl-2 truncate">
                                        <h3 class="truncate">Adventure</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="hidden lg:block lg:w-3/12">
            @include('pages.inc.sidebar')
        </div>
    </div>

    @include('pages.inc.footer')
@endsection
