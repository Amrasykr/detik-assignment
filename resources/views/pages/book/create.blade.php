@extends('layouts.app')

@section('title', 'Create Books')

@section('header')
    <h2 class="text-4xl font-medium text-secondary">
        Create Books
    </h2>
@endsection
@section('content')

<div class="mb-10">
    <form class="w-full p-8 shadow-xl border border-purple-50 rounded-lg" enctype="multipart/form-data" method="POST" action="/books">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="name" class="block uppercase tracking-wide text-xs font-bold mb-2">Books Title</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" class="appearance-none block w-full bg-purple-200 border-none @error('name') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight" >
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="quantity" class="block uppercase tracking-wide text-xs font-bold mb-2">Quantity</label>
                <input id="quantity" name="quantity" type="number" value="{{ old('quantity') }}" class="appearance-none block w-full bg-purple-200 border-none @error('name') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight" >
                @error('quantity')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="pdf_file" class="block uppercase tracking-wide text-xs font-bold mb-2">PDF File</label>
                <input id="pdf_file" name="pdf_file" type="file" value="{{ old('name') }}" class="appearance-none block w-full bg-purple-200 border-none @error('name') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight" >
                @error('pdf_file')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="cover_image" class="block uppercase tracking-wide text-xs font-bold mb-2">Cover Image</label>
                <input id="cover_image" name="cover_image" type="file" value="{{ old('quantity') }}" class="appearance-none block w-full bg-purple-200 border-none @error('name') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight" >
                @error('cover_image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label for="description" class="block uppercase tracking-wide text-xs font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="4" class="appearance-none block w-full bg-purple-200 border-none @error('description') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-2 flex justify-end">
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 shadow-lg rounded-md">Submit</button>
        </div>
    </form>
</div>

@endsection

@section('script')
@endsection
