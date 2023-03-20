<main class="lg:mx-4">

    <section class="bg-white backdrop:blur-md rounded mt-5 shadow-md">
        <div class="p-4">
            <h4 class="capitalize font-bold text-lg">latest apps</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="{{ route('app.all') }}">see all apps <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 p-1">
            @foreach ($latest_apps as $app)
                <a href="{{ route('app.details', [$app->slug, $app->id])  }}" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                    <div class="flex md:justify-start md:items-start justify-center items-center flex-col md:flex-row">
                        <div class="h-16 w-16 flex-shrink-0">
                            <img class="h-full w-full rounded"
                                src="{{Storage::URL($app->icon_path)}}" alt>
                        </div>
                        <div class="md:pl-2 md:truncate text-center md:text-left">
                            <h3
                                class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                                {{$app->name}}
                            </h3>
                            <p class="font-light text-xs truncate hidden md:block">{{$app->publisher}}</p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </section>

    <section class="bg-white backdrop:blur-md rounded mt-5 shadow-md">
        <div class="p-4">
            <h4 class="capitalize font-bold text-lg">latest games</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="{{ route('game.all') }}">see all games <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 p-1">

            @foreach ($latest_games as $game)
                <a href="{{ route('game.details', [$game->slug, $game->id])  }}" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                    <div class="flex md:justify-start md:items-start justify-center items-center flex-col md:flex-row">
                        <div class="h-16 w-16 flex-shrink-0">
                            <img class="h-full w-full rounded"
                                src="{{Storage::URL($game->icon_path)}}" alt>
                        </div>
                        <div class="md:pl-2 md:truncate text-center md:text-left">
                            <h3
                                class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                                {{$game->name}}
                            </h3>
                            <p class="font-light text-xs truncate hidden md:block">{{$game->publisher}}</p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </section>

    <section class="bg-white backdrop:blur-md rounded mt-5 shadow-md">
        <div class="p-4">
            <h4 class="capitalize font-bold text-lg"> ⭐ Editor's choice</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 p-1">

            @foreach ($editors_choice as $choice)
                <a href="{{ route('game.details', [$choice->slug, $choice->id])  }}" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                    <div class="flex md:justify-start md:items-start justify-center items-center flex-col md:flex-row">
                        <div class="h-16 w-16 flex-shrink-0">
                            <img class="h-full w-full rounded"
                                src="{{Storage::URL($choice->icon_path)}}" alt>
                        </div>
                        <div class="md:pl-2 md:truncate text-center md:text-left">
                            <h3
                                class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                                {{$choice->name}}
                            </h3>
                            <p class="font-light text-xs truncate hidden md:block">{{$choice->publisher}}</p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </section>

</main>
