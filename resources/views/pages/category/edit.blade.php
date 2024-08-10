@extends('layouts.app')

@section('title', 'Edit Category')

@section('header')
    <h2 class="text-4xl font-medium text-secondary">
        Edit Category
    </h2>
@endsection
@section('content')

<div class="mb-10">
    <form class="w-full p-8 shadow-xl border border-purple-50 rounded-lg" enctype="multipart/form-data" method="POST" action="/categories/{{$category->id}}">
        @csrf
        @method('PATCH')
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label for="name" class="block uppercase tracking-wide text-xs font-bold mb-2">Category Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" class="appearance-none block w-full bg-purple-200 border-none @error('name') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight" >
                @error('name')
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
