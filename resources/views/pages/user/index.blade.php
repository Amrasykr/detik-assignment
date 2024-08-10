@extends('layouts.app')

@section('title', 'Main Dashboard')
@section('header')
    <h2 class="text-3xl font-medium text-secondary">
        Users
    </h2>
@endsection

@section('content')
    <div class="my-10">
        <div class="w-full shadow-lg rounded-xl">
                <div class="sm:space-y-0 items-center justify-between p-4 bg-purple-200 ">
                    <form action="{{ route('users.index') }}" method="GET">
                        <label for="table-search" class="sr-only text-tertiary">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                                <svg class="w-5 h-5 text-tertiary" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="table-search" name="search" class="block p-2 pl-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search" value="{{ $search ?? '' }}">
                        </div>
                    </form>
                </div>
                <table class="w-full overflow-hidden text-sm text-left">
                    <thead class="text-sm uppercase bg-purple-600 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/3">Name</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Email</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Joined At</th>
                            <th scope="col" class="px-6 py-3 w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @empty($users->all())
                        <tr>
                            <td colspan="6" class="text-center py-5 text-lg">There is no user</td>
                        </tr>
                        @endempty
                        @foreach ($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 w-1/4">{{ $user->name }}</td>
                            <td class="px-6 py-4 w-1/4">{{ $user->email }}</td>
                            <td class="px-6 py-4 w-1/4">{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('l, j F Y') }}</td>
                            <td class="px-6 py-6 w-24 flex space-x-3 items-center">
                                <form action="/users/{{$user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button href="#" class="font-medium text-red-600 hover:underline text-lg">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="px-4 py-3 bg-white border-t border-gray-200 ">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection
