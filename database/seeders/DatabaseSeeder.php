<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(7)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        $categories = Category::factory()->count(5)->create();

        $userIds = $users->pluck('id')->toArray();
        $categoryIds = $categories->pluck('id')->toArray();

        $books = [
            [
                'name' => 'The Art of Programming',
                'description' => 'An in-depth exploration of algorithms and data structures.',
                'quantity' => 50,
                'pdf_file' => 'book-1.pdf',
                'cover_image' => 'image-1.jpg',
                'author_id' => $admin->id,
                'category_id' => $categoryIds[0],
            ],
            [
                'name' => 'Mastering Laravel',
                'description' => 'Comprehensive guide to Laravel framework.',
                'quantity' => 30,
                'pdf_file' => 'book-2.pdf',
                'cover_image' => 'image-2.jpg',
                'author_id' => $admin->id,
                'category_id' => $categoryIds[4],
            ],
            [
                'name' => 'Data Science Handbook',
                'description' => 'Basics of machine learning and AI.',
                'quantity' => 40,
                'pdf_file' => 'book-3.pdf',
                'cover_image' => 'image-3.jpg',
                'author_id' => $admin->id,
                'category_id' => $categoryIds[1],
            ],
            [
                'name' => 'Advanced Python',
                'description' => 'Take your Python skills to the next level.',
                'quantity' => 20,
                'pdf_file' => 'book-4.pdf',
                'cover_image' => 'image-4.jpg',
                'author_id' => $userIds[0],
                'category_id' => $categoryIds[2],
            ],
        ];

        // Insert buku ke dalam database
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
