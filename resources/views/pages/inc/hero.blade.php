<div class="md:flex lg:mx-4">

    @foreach ($featured_apps as $app)
        <div class="w-full md:w-6/12 {{ $loop->index == 0 ? 'mr-2' : '' }} {{ $loop->index != 0 ? 'mt-2 md:mt-0' : 'mt-0' }} rounded shadow-sm bg-white">
            <div class="w-full min-h-52 h-52">
                <a href="{{ route('app.details', [$app->slug, $app->app_id])  }}">
                    <img class="rounded-t w-full h-full object-cover" src="{{ Storage::url($app->cover_path) }}" alt="{{ $app->name }} cover - featured media">
                </a>
            </div>
            <a href="{{ route('app.details', [$app->slug, $app->app_id])  }}" class="p-2 flex">
                <div class="h-16 w-16">
                    <img class="h-full w-full rounded" src="{{ Storage::url($app->icon_path) }}" alt>
                </div>

                <div class="p-2">
                    <h2 class="font-bold">{{ $app->name }}</h2>
                    <p class="text-sm text-gray-600">Updated
                        {{ \Carbon\Carbon::parse($app->updated_at)->diffForHumans() }}
                    </p>
                </div>
            </a>
        </div>
    @endforeach

    {{-- <div class="w-full md:w-6/12 mr-2 rounded shadow-sm bg-white">
        <div class="w-full max-h-52">
            <img class="rounded-t h-52 w-full object-cover" src="https://i.ytimg.com/vi/eVyeFIaFHT8/maxresdefault.jpg" alt>
        </div>
        <div class="p-2 flex">
            <div class="h-16 w-16">
                <img class="h-full w-full" src="https://app-cdn.acelitchi.com/prod/app/2022/12/16/mZbr48lbEG6cvZl.webp" alt>
            </div>

            <div class="p-2">
                <h2 class="font-bold">Who Needs a Hero</h2>
                <p class="text-sm text-gray-600">Updated on Wed Nov 09 2022</p>
            </div>
        </div>
    </div>
    <div class="w-full md:w-6/12 rounded shadow-sm bg-white">
        <div class="w-full max-h-52">
            <img class="rounded-t h-52 w-full object-cover" src="https://i.ytimg.com/vi/hyhdnayPRM4/maxresdefault.jpg" alt>
        </div>
        <div class="p-2 flex">
            <div class="h-16 w-16">
                <img class="h-full w-full" src="https://app-cdn.acelitchi.com/prod/app/2022/12/16/KmmYPPGb8at3nuf.webp" alt>
            </div>

            <div class="p-2">
                <h2 class="font-bold">POIU</h2>
                <p class="text-sm text-gray-600">Updated on Sun Dec 04 2022</p>
            </div>
        </div>
    </div> --}}

</div>
