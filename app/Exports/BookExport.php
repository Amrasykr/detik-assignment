<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class BookExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Book::with('category', 'user')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Quantity',
            'Author',
            'Created At'
        ];
    }

    public function map($book): array
    {
        return [
            $book->name,
            $book->category->name,
            $book->quantity,
            $book->user->name,
            $book->created_at_formatted = Carbon::parse($book->created_at)->format('l j F Y'),
        ];
    }
}
