<main class="lg:mx-4">

    <section class="bg-white backdrop:blur-md rounded mt-5 shadow-md">
        <div class="p-4">
            <h4 class="capitalize font-bold text-lg">latest apps</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all apps <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="grid grid-cols-4 md:grid-cols-3 gap-2 p-1">
            <a href="#" class="app w-full block hover:bg-gray-100 p-2 rounded-md">
                <div class="flex md:justify-start justify-center items-center flex-col md:flex-row">
                    <div class="h-16 w-16 flex-shrink-0">
                        <img class="h-full w-full"
                            src="https://app-cdn.acelitchi.com/prod/app/2022/12/16/ySGm1acxtfnVozl.webp" alt>
                    </div>
                    <div class="pl-2 md:truncate text-center md:text-left">
                        <h3
                            class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                            AVG AntiVirus</h3>
                        <p class="font-light text-xs truncate hidden md:block">AVG Mobile</p>
                    </div>
                </div>
            </a>
            <a href="#" class="app block w-full hover:bg-gray-100 p-2 rounded-md">
                <div class="flex md:justify-start justify-center items-center flex-col md:flex-row">
                    <div class="h-16 w-16 flex-shrink-0">
                        <img class="h-full w-full"
                            src="https://cdn.ezjojoy.com/packages/com.plexapp.android/icon_2c08f7.png" alt>
                    </div>
                    <div class="pl-2 md:truncate text-center md:text-left">
                        <h3
                            class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                            Plex</h3>
                        <p class="font-light text-xs truncate hidden md:block">Plex, Inc.</p>
                    </div>
                </div>
            </a>
            <a href="#" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                <div class="flex md:justify-start justify-center items-center flex-col md:flex-row">
                    <div class="h-16 w-16 flex-shrink-0">
                        <img class="h-full w-full"
                            src="https://cdn.ezjojoy.com/packages/com.avast.android.mobilesecurity/icon_fd5b24.png" alt>
                    </div>
                    <div class="pl-2 md:truncate text-center md:text-left">
                        <h3
                            class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                            Avast Mobile Security</h3>
                        <p class="font-light text-xs truncate hidden md:block">Avast Software</p>
                    </div>
                </div>
            </a>
            <a href="#" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                <div class="flex md:justify-start justify-center items-center flex-col md:flex-row">
                    <div class="h-16 w-16 flex-shrink-0">
                        <img class="h-full w-full"
                            src="https://cdn.ezjojoy.com/packages/com.playit.videoplayer/icon_fa91b1.png" alt>
                    </div>
                    <div class="pl-2 md:truncate text-center md:text-left">
                        <h3
                            class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                            PLAYit</h3>
                        <p class="font-light text-xs truncate hidden md:block">PLAYIT TECHNOLOGY PTE. LTD.</p>
                    </div>
                </div>
            </a>

        </div>
    </section>

    <section class="bg-white backdrop:blur-md rounded mt-5 shadow-md">
        <div class="p-4">
            <h4 class="capitalize font-bold text-lg">latest games</h4>
            <div>
                <a class="text-xs hover:text-blue-500" href="#">see all games <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 p-1">

            @foreach ($latest_games as $game)
                <a href="#" class="app block hover:bg-gray-100 w-full p-2 rounded-md">
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
    </section>

</main>
