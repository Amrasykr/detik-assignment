@extends('layouts.app')

@section('title', 'Main Dashboard')

@section('header')
    <h2 class="text-3xl font-medium text-secondary">
        Categories
    </h2>
@endsection

@section('content')
    <div class="my-10">
        <div class="w-full shadow-lg rounded-xl">
            <div class="flex sm:space-y-0 items-center justify-between p-4 space-x-5 md:space-x-0 bg-purple-200">
                <form id="category-form" action="{{ route('categories.index') }}" method="GET">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                            <svg class="w-5 h-5 text-tertiary" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search" name="search" class="block p-2 pl-8 text-sm rounded-lg bg-white" placeholder="Search" value="{{ $search ?? '' }}">
                    </div>
                </form>
                <div>
                    <a href="/categories/create" class="inline-flex items-center text-black bg-white outline font-medium rounded-md text-sm text-black/50 px-3 py-2">
                        <i class="fas text-black fa-plus mr-2"></i>
                        Create Category
                    </a>
                </div>
            </div>
            <table class="w-full overflow-hidden text-sm text-left">
                    <thead class="text-sm uppercase bg-purple-600 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/4">Name</th>
                            <th scope="col" class="px-6 py-3 w-1/3">Created At</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Total Books</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Action</th>
                        </tr>
                    </thead>
                    <tbody id="category-table-body">
                        @empty($categories->all())
                        <tr>
                            <td colspan="6" class="text-center py-5 text-lg">There is no category</td>
                        </tr>
                        @endempty
                        @foreach ($categories as $category)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 w-1/4">{{ $category->name }}</td>
                            <td class="px-6 py-4 w-1/4">{{ \Carbon\Carbon::parse($category->created_at)->translatedFormat('l, j F Y') }}</td>
                            <td class="px-6 py-4 w-1/4">5</td>

                            <td class="px-6 py-6 w-1/4 flex space-x-3 items-center">
                                <a href="/categories/{{$category->id}}/edit" class="font-medium text-yellow-600 hover:underline text-lg">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/categories/{{$category->id }}" method="POST">
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
                <div class="px-4 py-3 bg-white border-t border-gray-200" id="pagination-links">
                    {{ $categories->withQueryString()->links() }}
                </div>
            </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('category-form');
            const tableBody = document.getElementById('category-table-body');
            const paginationLinks = document.getElementById('pagination-links');

            form.addEventListener('input', function (event) {
                event.preventDefault();

                const formData = new FormData(form);

                fetch('{{ route('categories.index') }}?' + new URLSearchParams(formData), {
                    method: 'GET',
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    tableBody.innerHTML = doc.querySelector('#category-table-body').innerHTML;
                    paginationLinks.innerHTML = doc.querySelector('#pagination-links').innerHTML;
                });
            });
        });
    </script>
@endsection
