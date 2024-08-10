<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory()->count(5)->create();

        foreach ($categories as $index => $category) {
            Book::factory()->create([
                'category_id' => $category->id,
                'pdf_file' => 'book-' . ($index + 1) . '.pdf',
                'cover_image' => 'image-' . ($index + 1) . '.jpg',
            ]);
        }
    }
}
