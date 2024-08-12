<aside class="z-20 hidden w-64 overflow-y-auto  md:block flex-shrink-0 shadow-xl">
    <div class="py-4 text-gray-500">
        <a class="ml-6  text-lg font-bold text-gray-800" href="{{ route('dashboard') }}">
            Digital Library
        </a>

        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon">
                        <i class="text-purple-800 fa-solid fa-house"></i>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    <x-slot name="icon">
                        <i class="text-purple-800 fa-solid fa-users"></i>
                    </x-slot>
                    {{ __('Users') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.index')">
                    <x-slot name="icon">
                        <i class="text-purple-800 fa-solid fa-tag"></i>
                    </x-slot>
                    {{ __('Category') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('books.index') }}" :active="request()->routeIs('books.index')">
                    <x-slot name="icon">
                        <i class="text-purple-800 fa-solid fa-book"></i>
                    </x-slot>
                    {{ __('Books') }}
                </x-nav-link>
            </li>

        </ul>
    </div>
</aside>
