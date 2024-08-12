@extends('layouts.app')

@section('title', 'Main Dashboard')

@section('header')
    <h2 class="text-3xl font-medium text-secondary">
        Main Dashboard
    </h2>
@endsection

@section('content')
    <div class="my-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 w-full">
            <div class="bg-gradient-to-l from-purple-400 via-purple-500 to-purple-600 rounded-lg p-5">
                <div class="flex items-center justify-between text-white">
                    <div class="flex flex-col gap-5">
                        <p class="text-2xl font-medium">Books</p>
                        <p class="text-4xl font-semibold">{{$totalBooks}}</p>
                        <p class="text-sm font-light">
                            This is the total books
                        </p>
                    </div>
                    <i class="fa-solid fa-book text-6xl text-white mx-6"></i>
                </div>
            </div>
            <div class="bg-gradient-to-l from-purple-400 via-purple-500 to-purple-600 rounded-lg p-5">
                <div class="flex items-center justify-between text-white">
                    <div class="flex flex-col gap-5">
                        <p class="text-2xl font-medium">Categories</p>
                        <p class="text-4xl font-semibold">{{$totalCategories}}</p>
                        <p class="text-sm font-light">
                            This is the total categories
                        </p>
                    </div>
                    <i class="fa-solid fa-folder text-6xl text-white mx-6"></i>
                </div>
            </div>
            <div class="bg-gradient-to-l from-purple-400 via-purple-500 to-purple-600 rounded-lg p-5">
                <div class="flex items-center justify-between text-white">
                    <div class="flex flex-col gap-5">
                        <p class="text-2xl font-medium">Users</p>
                        <p class="text-4xl font-semibold">{{$totalUsers}}</p>
                        <p class="text-sm font-light">
                            This is the total users
                        </p>
                    </div>
                    <i class="fa-solid fa-users text-6xl text-white mx-6"></i>
                </div>
            </div>
        </div>

        <div class="w-full my-10">
            <!-- Bar Chart -->
            <canvas id="booksChart"></canvas>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('booksChart').getContext('2d');
            var booksChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Total Books',
                        data: @json($totals),
                        backgroundColor: 'rgb(172, 147, 249)',
                        borderColor: 'rgb(127, 59, 241)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Books'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
