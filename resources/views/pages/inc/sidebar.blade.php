<aside class="w-full">

    <div class="side-section p-2 w-full">
        <div class="xl:flex justify-between items-center">
            <h4 class="font-bold text-lg">Top picks</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all top Picks <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="mt-2">
            @if (false)
                <div class="h-32 w-full bg-white text-center border rounded-lg">
                    No picks for you
                </div>
            @endif
            <div>

                @foreach ($top_picks as $app)
                    <a href="{{ route('app.details', [$app->slug, $app->app_id]) }}" class="side-app block hover:bg-gray-100/60 w-full p-2 rounded-md">
                        <div class="flex">
                            <div class="h-10 min-w-10 flex-shrink-0">
                                <img class="h-full w-full rounded-md object-cover"
                                    src="{{ Storage::url($app->icon_path) }}"
                                    alt>
                            </div>
                            <div class="pl-2 w-full truncate">
                                <h3 class="font-bold truncate">{{ $app->name }}</h3>
                                <p class="font-light text-xs truncate">{{ $app->publisher }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
    <div class="side-section p-2">
        <div class="xl:flex justify-between items-center">
            <h4 class="font-bold text-lg">Top Apps</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all top Apps <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="mt-2 w-full">
            <div class="w-full">
                <a href="#" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                    <div class="flex w-full">
                        <div class="h-10 min-w-10 flex-shrink-0">
                            <img class="h-full min-w-10 rounded-md object-cover"
                                src="https://cdn.ezjojoy.com/packages/com.playit.videoplayer/icon_fa91b1.png" alt>
                        </div>
                        <div class="pl-2 w-full truncate">
                            <h3 class="font-bold truncate">PLAYit</h3>
                            <p class="font-light text-xs truncate">PLAYIT TECHNOLOGY PTE. LTD.</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="app block w-full hover:bg-gray-100 p-2 rounded-md">
                    <div class="flex">
                        <div class="h-10 w-10">
                            <img class="h-full w-full rounded-md object-cover"
                                src="https://cdn.ezjojoy.com/packages/com.plexapp.android/icon_2c08f7.png" alt>
                        </div>
                        <div class="pl-2 truncate">
                            <h3 class="font-bold truncate">Plex</h3>
                            <p class="font-light text-xs truncate">Plex, Inc.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="side-section p-2">
        <div class="xl:flex justify-between items-center">
            <h4 class="font-bold text-lg">Top Games</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all top Games <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="mt-2">
            <div>
                <a href="#" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                    <div class="flex">
                        <div class="h-10 w-10 flex-shrink-0">
                            <img class="h-full w-full rounded-md object-cover"
                                src="https://cdn.ezjojoy.com/packages/com.mojang.minecraftpe/icon_37987f.png" alt>
                        </div>
                        <div class="pl-2 truncate">
                            <h3 class="font-bold truncate">Minecraft</h3>
                            <p class="font-light text-xs truncate">Mojang</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="side-section p-2">
        <div class="xl:flex justify-between items-center">
            <h4 class="font-bold text-lg">Categories</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all Categories <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="mt-2">
            <div class="grid grid-cols-2 gap-1">
                @foreach ($categories as $c)
                    <div>
                        <a href="{{ route('category.index', [$c->slug, $c->id]) }}" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                            <div class="flex">
                                <div class="h-6 w-6 flex-shrink-0">
                                    <img class="h-full w-full rounded-md" src="{{ Storage::url($c->icon_path) }}" alt>
                                </div>
                                <div class="pl-2 truncate">
                                    <h3 class="truncate">{{ $c->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</aside>
