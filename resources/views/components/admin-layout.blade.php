<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">

    <title>Admin</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    @if (Session::has('message'))
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-indigo-600" x-data="{ bannerOpen: true }" x-show="bannerOpen">
            <div class="px-3 py-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex items-center flex-1 w-0">
                        <p class="ml-3 font-medium text-white truncate">
                            <span class="md:hidden"> {{ Session::get('message') }} </span>
                            <span class="hidden md:inline"> {{ Session::get('message') }} </span>
                        </p>
                    </div>
                    <div class="flex-shrink-0 order-2 sm:order-3 sm:ml-3">
                        <button type="button" @click="bannerOpen = false"
                            class="flex p-2 -mr-1 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                            <span class="sr-only">Dismiss</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('layouts.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">
            @include('layouts.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>