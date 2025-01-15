<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title ?? config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    @stack('styles')
</head>

<body>

    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600"
        data-gjs-tagName="nav">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"><a
                href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse" data-gjs-type="link"
                data-gjs-editable="false"><img src="https://flowbite.com/docs/images/logo.svg" alt="Flowbite Logo"
                    class="h-8" data-gjs-type="image" data-gjs-resizable="{&quot;ratioDefault&quot;:1}" /><span
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white" data-gjs-tagName="span"
                    data-gjs-type="text">Flowbite</span></a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse"><button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    data-gjs-tagName="button" data-gjs-type="text">Get started</button><button
                    data-collapse-toggle="navbar-sticky" type="button" aria-controls="navbar-sticky"
                    aria-expanded="false"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    data-gjs-tagName="button"><span class="sr-only" data-gjs-tagName="span" data-gjs-type="text">Open
                        main menu</span><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14" class="w-5 h-5" data-gjs-type="svg"
                        data-gjs-resizable="{&quot;ratioDefault&quot;:true}">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" data-gjs-tagName="path" data-gjs-type="svg-in"
                            data-gjs-resizable="{&quot;ratioDefault&quot;:true}"></path>
                    </svg></button></div>
            <div id="navbar-sticky" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                    data-gjs-tagName="ul">
                    <li data-gjs-tagName="li"><a href="#" aria-current="page"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                            data-gjs-type="link">Home</a></li>
                    <li data-gjs-tagName="li"><a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            data-gjs-type="link">About</a></li>
                    <li data-gjs-tagName="li"><a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            data-gjs-type="link">Services</a></li>
                    <li data-gjs-tagName="li"><a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            data-gjs-type="link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
 
    <section class="bg-white dark:bg-gray-900 mt-10">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-5">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Berita</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Dapatkan Berita Teerbaru.</p>
            </div>
            <div class="grid gap-5 lg:grid-cols-2">
                @foreach ($data as $post)
                    <article
                        class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                        clip-rule="evenodd"></path>
                                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                                </svg>
                                {{ $post->category_name }}
                            </span>
                            <span
                                class="text-sm">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                href="#">{{ $post->title }}</a></h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{!! \Illuminate\Support\Str::limit(strip_tags($post->content), 200, '...') !!}</p>
                        <!-- Menggunakan  untuk menampilkan HTML -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                {{-- <img class="w-7 h-7 rounded-full" src="" alt="{{ $post->author_name }} avatar" /> --}}
                                <span class="font-medium dark:text-white">
                                    {{ $post->author_name }}
                                </span>
                            </div>
                            <a href="#"
                                class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    {{-- {{ $slot }} --}}
    @livewireScripts
    @stack('scripts')
</body>

</html>
