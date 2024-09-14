<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            // 'user_id' is set in the seeder
        ];
    }

    public function withCategories()
    {
        return $this->afterCreating(function (Post $post) {
            $categories = Category::where('name', '!=', 'unsorted')
            ->inRandomOrder()
            ->take(rand(1, 3))
            ->pluck('id');
            $post->categories()->attach($categories);
        });
    }
}
