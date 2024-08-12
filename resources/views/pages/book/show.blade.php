@extends('layouts.app')

@section('title', $book->name)

@section('header')
    <h2 class="text-4xl font-medium text-secondary">
        {{ $book->name }}
    </h2>
@endsection

@section('content')
    <div class="my-10 md:flex md:space-x-5">
        <div class="w-full h-full md:w-1/3 bg-white flex flex-col justify-between items-center">
            <div class="thumbnail">
                <img src="{{ asset('assets/book_covers/'. $book->cover_image) }}" alt="cover_image" class="w-full h-96 rounded-lg object-cover object-center">
            </div>
        </div>
        <div class="w-full md:w-2/3 bg-white mt-3 md:mt-0">
            <div class="w-full border p-8 shadow-xl rounded-lg">
                <div class="flex flex-wrap -mx-3 mb-3">
                    <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                        <label for="name" class="block uppercase tracking-wide text-tertiary text-xs font-bold mb-2">Book Name</label>
                        <input id="name" name="name" type="text" value="{{ $book->name }}" class="appearance-none block w-full bg-purple-200 border-none rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" disabled>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="category" class="block uppercase tracking-wide text-tertiary text-xs font-bold mb-2">Category</label>
                        <input id="category" name="category" type="text" value="{{ $book->category->name }}" class="appearance-none block w-full bg-purple-200 border-none rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" disabled>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-3">
                    <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                        <label for="quantity" class="block uppercase tracking-wide text-tertiary text-xs font-bold mb-2">Quantity</label>
                        <input id="quantity" name="quantity" type="text" value="{{ $book->quantity }}" class="appearance-none block w-full bg-purple-200 border-none rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" disabled>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="author" class="block uppercase tracking-wide text-tertiary text-xs font-bold mb-2">Author</label>
                        <input id="author" name="author" type="text" value="{{ $book->user->name }}" class="appearance-none block w-full bg-purple-200 border-none rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" disabled>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-3">
                    <div class="w-full px-3 mb-3 md:mb-0">
                        <label for="description" class="block uppercase tracking-wide text-tertiary text-xs font-bold mb-2">Description</label>
                        <textarea id="description" name="description" class="appearance-none block w-full bg-purple-200 border-none rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" disabled>{{ $book->description }}</textarea>
                    </div>
                </div>
                <div class="mt-2 flex justify-end gap-5">
                    <button id="previewPdfButton" data-pdf-url="{{ asset('assets/book_files/' . $book->pdf_file) }}" class="bg-purple-600 text-white px-6 py-2 shadow-lg rounded-md">Preview Book</button>
                    <a href="/books/{{$book->id}}/download" class="bg-yellow-600 text-white px-6 py-2 shadow-lg rounded-md">Download Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for PDF Preview -->
    <div id="pdfModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-purple-100 rounded-xl shadow-lg w-11/12 md:w-3/4 lg:w-2/3 p-10 relative">
                <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6 text-purple-600 font-medium" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <iframe id="pdfPreview" src="" style="width:100%; height:80vh;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get modal, open button, and close button
        const pdfModal = document.getElementById('pdfModal');
        const previewPdfButton = document.getElementById('previewPdfButton');
        const closeModalButton = document.getElementById('closeModal');
        const pdfPreview = document.getElementById('pdfPreview');

        // Show modal with PDF preview
        previewPdfButton.addEventListener('click', function() {
            const pdfUrl = this.getAttribute('data-pdf-url');
            pdfPreview.src = pdfUrl;
            pdfModal.classList.remove('hidden');
        });

        // Close modal
        closeModalButton.addEventListener('click', function() {
            pdfModal.classList.add('hidden');
            pdfPreview.src = '';
        });

        // Close modal if clicked outside
        pdfModal.addEventListener('click', function(e) {
            if (e.target === pdfModal) {
                pdfModal.classList.add('hidden');
                pdfPreview.src = '';
            }
        });
    });
    </script>
@endsection
