<div class="app-details lg:mx-4 mb-10">

    <div class="bg-white/70 backdrop:blur-sm p-5 shadow-md rounded-md md:flex justify-between block">
        <div class="flex-1">
            <div class="flex ">
                
                <div class="h-16 w-16 md:h-32 md:w-32 flex-shrink-0">
                    <img class="h-full w-full object-cover rounded-md"
                        src="{{ Storage::url($app->icon_path) }}" alt>
                </div>
    
                <div class="ml-5 w-full h-full flex flex-col">
                    <h1 class="text-2xl font-bold text-gray-700 ">{{ $app->name }}</h1>
                    <p class="font-light text-sm whitespace-nowrap">{{ 'Published on ' . Carbon\Carbon::parse($app->created_at)->isoFormat('LL') }}</p>
                    <p class="font-light text-sm leading-6">Published by <a href="{{ $app->publisher_url ?? '#' }}" class="font-bold">{{ $app->publisher }}</a></p>
                </div>
            </div>

            <div class="max-w-full mx-5 mt-5">
                <a href="#" class="font-bold w-full block py-3 text-center rounded-lg shadow-sm shadow-green-700 text-white bg-green-500">Download</a>
            </div>
            
        </div>
        <div class="md:w-6/12 w-full pt-5 md:pt-0 md:self-center">
            <table class="table-fixed w-full">
                <tbody>
                    <tr class="">
                        <th class="border-b border-slate-100 p-4 text-slate-500">Version</th>
                        <td class="border-b border-slate-100 p-4 text-slate-500">{{ $app->version ?? 'Unknown' }}</td>
                    </tr>
                    <tr class="">
                        <th class="border-b border-slate-100 p-4 text-slate-500">Category</th>
                        <td class="border-b border-slate-100 p-4 text-slate-500"><a href="#">{{ $app->category ? $app->category->name : 'Uncategorized' }}</a></td>
                    </tr>
                    <tr class="">
                        <th class="border-b border-slate-100 p-4 text-slate-500">Size (TODO)</th>
                        <td class="border-b border-slate-100 p-4 text-slate-500">182.33 MB</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-10 bg-white shadow-md rounded-md p-5">

        <h1 class="font-bold pb-5">More about {{ $app->name }}</h1>

        <div class="wysiwyg">
            {!! $app->description !!}
        </div>
    </div>

</div>
