<footer class="flex flex-col items-center">
    <div class="w-full flex flex-col md:flex-row xl:px-48 px-10 pt-5 justify-evenly">
        <div class="capitalize text-center">
            <div class="flex md:block">
                <a href="#" class="m-1 bg-blue-700 rounded text-white w-10 h-10 flex items-center justify-center"><i
                        class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="m-1 bg-blue-500 rounded text-white w-10 h-10 flex items-center justify-center"><i
                        class="fa-brands fa-twitter"></i></a>
                <a href="#"
                    class="m-1 bg-orange-500 rounded text-white w-10 h-10 flex items-center justify-center"><i
                        class="fa-brands fa-instagram"></i></a>
            </div>
        </div>

        <div class="flex justify-between md:w-6/12 mt-10">
            <div>
                <ul class="list-disc">
                    <h4 class="font-bold leading-loose text-gray-700">Pages</h4>
                    @foreach ($pages as $page)
                        <li class="text-sm"><a class="hover:text-blue-500" href="{{ route('page.static', [$page->slug, $page->id]) }}"> {{$page->title}} </a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <ul class="list-disc">
                    <h4 class="font-bold leading-loose text-gray-700">Categories</h4>
                    @foreach ($categories as $category)
                        <li class="text-sm"><a class="hover:text-blue-500" href="{{ route('category.index', [$category->slug, $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <span class="font-semibold text-gray-600 p-3 text-xs md:text-sm">Copyright <a href="/">{{ env('APP_NAME') }}</a> &#169; - all rights reserved 2023</span>
    </div>
</footer>
