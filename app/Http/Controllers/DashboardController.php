<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // Query untuk mendapatkan jumlah buku per bulan dengan SQLite
        $booksPerMonth = DB::table('book')
            ->select(
                DB::raw('strftime("%Y", created_at) as year'),
                DB::raw('strftime("%m", created_at) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('strftime("%Y", created_at)'), DB::raw('strftime("%m", created_at)'))
            ->orderBy(DB::raw('strftime("%Y", created_at)'))
            ->orderBy(DB::raw('strftime("%m", created_at)'))
            ->get();

        // Format data untuk Chart.js
        $months = $booksPerMonth->map(function($data) {
            return $data->year . '-' . str_pad($data->month, 2, '0', STR_PAD_LEFT);
        });
        $totals = $booksPerMonth->pluck('total');

        return view('pages.index', compact('totalBooks', 'totalCategories', 'totalUsers', 'months', 'totals'));
    }
}
