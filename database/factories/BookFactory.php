<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'pdf_file' => 'book-' . $this->faker->unique()->numberBetween(1, 100) . '.pdf',
            'cover_image' => 'image-' . $this->faker->unique()->numberBetween(1, 100) . '.jpg',
            'author_id' => 1,
            'category_id' => Category::factory(),
        ];
    }
}
