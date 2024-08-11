<!-- resources/views/pages/book/_table.blade.php -->
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
        @forelse($books as $book)
        <tr class="bg-white border-b hover:bg-gray-50">
            <td class="px-6 py-4 w-1/4">{{ $book->name }}</td>
            <td class="px-6 py-4 w-1/4">{{$book->category->name}}</td>
            <td class="px-6 py-4 w-1/12">{{$book->quantity}}</td>
            <td class="px-6 py-4 w-1/4">{{ \Carbon\Carbon::parse($book->created_at)->translatedFormat('l, j F Y') }}</td>
            <td class="px-6 py-6 w-1/4 flex space-x-3 items-center">
                <a href="/categories/{{$book->id}}/edit" class="font-medium text-yellow-600 hover:underline text-lg">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="/categories/{{$book->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-medium text-red-600 hover:underline text-lg">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-5 text-lg">There are no books</td>
        </tr>
        @endforelse
    </tbody>
</table>
<!-- Pagination Links -->
<div class="px-4 py-3 bg-white border-t border-gray-200">
    {{ $books->withQueryString()->links() }}
</div>
