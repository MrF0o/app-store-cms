<div class="">
    <div class="category-title flex items-center">
        <h4 class="font-bold text-xl">Showing results for "<span class="underline">{{ $query_string }}</span>"</h4>
    </div>
    <div>

        <div class="bg-white backdrop:blur-md rounded mt-5 shadow-md min-h-[5rem]">
            <div class="{{ $apps->count() || $apps->hasMorePages() ? "grid grid-cols-4 gap-2 p-1" : "flex justify-center items-center h-[5rem]" }}">
                @if ($apps->count() || $apps->hasMorePages())
                    @foreach ($apps as $app)
                        <a href="{{ $app->is_app ? route('app.details', [$app->slug, $app->id]) : route('game.details', [$app->slug, $app->id]) }}"
                            class="app block hover:bg-gray-100 w-full p-2 rounded-md">
                            <div
                                class="flex md:justify-start md:items-start justify-center items-center flex-col md:flex-row">
                                <div class="h-16 w-16 flex-shrink-0">
                                    <img class="h-full w-full rounded" src="{{ Storage::URL($app->icon_path) }}" alt>
                                </div>
                                <div class="md:pl-2 md:truncate text-center md:text-left">
                                    <h3
                                        class="font-bold line-clamp-2 md:line-clamp-none md:block md:truncate leading-5 md:leading-7">
                                        {{ $app->name }}
                                    </h3>
                                    <p class="font-light text-xs truncate hidden md:block">{{ $app->publisher }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                
                    <div class="text-xl self-center">
                        <span class="font-semibold text-gray-600">No results found for "{{ $query_string }}"</span>
                    </div>
                    
                @endif
            </div>
        </div>

        <div class="py-5">
            {!! $apps->links() !!}
        </div>

    </div>
</div>
