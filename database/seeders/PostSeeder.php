<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();

        // Create posts for each user
        foreach ($users as $user) {
            Post::factory()
            ->count(2)
            ->withCategories()
            ->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
