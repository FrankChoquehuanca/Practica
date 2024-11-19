<!-- Page Header -->
<header id="page-header"
    class="fixed top-0 left-0 right-0 z-30 flex h-16 flex-none items-center bg-white shadow-sm transition-all duration-300 ease-out"
    x-bind:class="{ 'lg:pl-64': desktopSidebarOpen }">

    <div class="mx-auto  w-full justify-between px-4 lg:px-8 space-x-3">
        <div class="">
            <div class="flex  md:flex-row mx-3">
                <div class="flex mr-3 md:w-64 ">
                    <div class="">
                        <button type="button"
                        class="inline-flex items-center justify-center space-x-2 rounded border border-gray-300 bg-white px-3 py-2 font-semibold leading-6 text-gray-800 shadow-sm hover:border-gray-300 hover:bg-gray-100 hover:text-gray-800 hover:shadow focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none"
                        x-on:click="mobileSidebarOpen = true; desktopSidebarOpen = !desktopSidebarOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="hi-solid hi-menu-alt-1 inline-block h-5 w-5">
                            <path fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    </div>
                </div>
                <div class="justify-center flex-1 lg:mr-32  rounded-md mr-3">
                    <div class="relative w-full max-w-xl mr-2 focus-within:text-purple-500">
                        <div class="absolute inset-y-0 flex items-center pl-2"><svg aria-hidden="true"
                                fill="currentColor" viewBox="0 0 20 20"
                                class="w-4 h-4 hi-outline hi-home inline-block text-gray-600">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg></div><input
                            class="block w-full text-sm focus:outline-none border-gray-400 leading-5 focus:border-purple-400  focus:shadow-outline-purple rounded-md pl-8 text-gray-700"
                            type="text" placeholder="JobSearchPro: Encuentra el empleo ideal" aria-label="Search">
                    </div>
                </div>
                @props([
                    'align' => 'right',
                ])

                <div class="relative " x-data="{ open: false }">
                    <button class="inline-flex justify-center items-center group" aria-haspopup="true"
                        @click.prevent="open = !open" :aria-expanded="open">
                        {{-- Estee codigo es una condicional que nos muestra para incertar la imagen  que tenemos en la carpeta storage del perfil de usuario --}}
                        @if (Auth::user()->profile_photo_path)
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="/storage/{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                        @else
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        @endif
                        {{-- {{ Auth::user()->profile_photo_url }} este codigo es para la imagen que tenga --}}
                        <div class="flex items-center truncate">
                            <span
                                class="truncate ml-2 text-sm font-medium  group-hover:text-slate-800 ">{{ Auth::user()->name }}</span>
                            <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                            </svg>
                        </div>
                    </button>
                    <div class=" z-10 absolute top-full min-w-44   border border-slate-200    right-0  mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                        py-1.5 rounded shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
                        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" x-cloak>
                        <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200 ">
                            <div class="font-medium text-slate-800 ">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-slate-500  italic">Administrator</div>
                        </div>
                        <ul>
                            <li>
                                <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600  flex items-center py-1 px-3"
                                    href="{{ route('profile.show') }}" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600  flex items-center py-1 px-3"
                                        href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                        @focus="open = true" @focusout="open = false">
                                        {{ __('Sign Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
</header>
