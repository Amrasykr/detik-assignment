@extends('layouts.app')

@section('title', 'Main Dashboard')

@section('header')
    <h2 class="text-3xl font-medium text-secondary">
        Main Dashboard
    </h2>
@endsection

@section('content')
    <div class="p-4 bg-white rounded-lg shadow-xs">
        {{ __('Sample static text page') }}
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection
