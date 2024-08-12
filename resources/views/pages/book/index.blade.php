@extends('layouts.app')

@section('title', 'Books')

@section('header')
    <h2 class="text-3xl font-medium text-secondary">
        Books
    </h2>
@endsection

@section('content')
    <div class="my-10">
        <div class="w-full shadow-lg rounded-xl">
            <div class="flex sm:space-y-0 items-center justify-between p-4 space-x-5 md:space-x-0 bg-purple-200">
                <form id="category-form" action="{{ route('books.index') }}" method="GET">
                    <label for="category-search" class="sr-only">Search by Category</label>
                    <div class="relative">
                        <select id="category-search" name="category_id" class="block px-2 pr-10 text-sm rounded-lg bg-white">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="flex items-center">
                    <div class="join me-3">
                        <a href="/books/export/excel"
                            class="px-3 py-2.5 bg-green-600 join-item text-white text-sm rounded-s-md">
                            <i class="fa-solid fa-file-excel"></i>
                            Excel
                        </a>
                        <a href="/books/export/pdf"
                            class="px-3 py-2.5 bg-red-600 join-item text-white text-sm rounded-e-md">
                            <i class="fa-solid fa-file-pdf"></i>
                            Pdf
                        </a>
                    </div>
                    <a href="/books/create" class="inline-flex items-center text-black bg-white outline font-medium rounded-md text-sm text-black/50 px-3 py-2">
                        <i class="fas text-black fa-plus mr-2"></i>
                        Create Books
                    </a>
                </div>
            </div>
            <table class="w-full overflow-hidden text-sm text-left">
                    <thead class="text-sm uppercase bg-purple-600 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/4">Name</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Category</th>
                            <th scope="col" class="py-3 w-1/12">Quantity</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Created At</th>
                            <th scope="col" class="px-6 py-3 w-1/4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @empty($books->all())
                        <tr>
                            <td colspan="6" class="text-center py-5 text-lg">There is no books</td>
                        </tr>
                        @endempty
                        @foreach ($books as $book)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 w-1/4">{{ $book->name }}</td>
                            <td class="px-6 py-4 w-1/4">{{ $book->category->name }}</td>
                            <td class="px-6 py-4 w-1/12">{{ $book->quantity }}</td>
                            <td class="px-6 py-4 w-1/4">{{ \Carbon\Carbon::parse($book->created_at)->translatedFormat('l, j F Y') }}</td>
                            <td class="px-6 py-6 w-1/4 flex space-x-3 items-center">
                                 <a href="/books/{{$book->id}}" class="font-medium text-green-600 hover:underline text-lg">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/books/{{$book->id}}/edit" class="font-medium text-yellow-600 hover:underline text-lg">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/books/{{$book->id }}" method="POST">
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
                {{ $books->withQueryString()->links() }}
            </div>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category-search');
        const form = document.getElementById('category-form');

        categorySelect.addEventListener('change', async function() {
            const categoryId = categorySelect.value;
            const url = new URL(form.action);
            url.searchParams.set('category_id', categoryId);

            try {
                const response = await fetch(url.toString(), {
                    method: 'GET',
                    headers: {
                        'Accept': 'text/html',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const html = await response.text();
                    document.querySelector('table').innerHTML = new DOMParser().parseFromString(html, 'text/html').querySelector('table').innerHTML;
                    document.querySelector('.pagination').innerHTML = new DOMParser().parseFromString(html, 'text/html').querySelector('.pagination').innerHTML;
                } else {
                    console.error('Error fetching data:', response.statusText);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
</script>
@endsection
