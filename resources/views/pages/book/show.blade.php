@extends('layouts.app')

@section('title', $book->name)

@section('header')
    <h2 class="text-4xl font-medium text-secondary">
        {{$book->name}}
    </h2>
@endsection

@section('content')
    <div class="mb-10 md:flex md:space-x-5">
        <div class="w-full md:w-1/3 bg-white">
            <div class="tumbnail">
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
                <div class="mt-2 flex justify-end">
                    <a href="/books/{{$book->id}}/download" class="bg-purple-600 text-white px-6 py-2 shadow-lg rounded-md">Download Book</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
    </script>
@endsection
