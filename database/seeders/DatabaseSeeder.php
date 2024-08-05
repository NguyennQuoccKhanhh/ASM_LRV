<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Catelogue;
use App\Models\Comment;
use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Faker::create();

        // Create Users
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = User::create([
                'name' => $faker->name,
                'avatar' => $faker->imageUrl(),
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'type' => $faker->randomElement([User::TYPE_ADMIN, User::TYPE_MEMBER]),
            ]);
        }

        // Create Catelogues
        $catelogues = [];
        for ($i = 0; $i < 5; $i++) {
            $catelogues[] = Catelogue::create([
                'name' => $faker->word,
            ]);
        }

        // Create Posts
        $posts = [];
        for ($i = 0; $i < 20; $i++) {
            $posts[] = Post::create([
                'user_id' => $faker->randomElement($users)->id,
                'catelogue_id' => $faker->randomElement($catelogues)->id,
                'title' => Str::limit($faker->sentence, 100),
                'slug' => Str::slug($faker->sentence),
                'sku' => $faker->unique()->ean8,
                'image_post' => $faker->imageUrl(),
                'description' => Str::limit($faker->paragraph, 200),
                'content' => Str::limit($faker->paragraphs(3, true), 1000),
                'view' => $faker->numberBetween(0, 1000),
                'is_show_home' => $faker->boolean,
                'published_at' => $faker->dateTimeThisYear,
            ]);
        }

        // Create Comments
        for ($i = 0; $i < 50; $i++) {
            Comment::create([
                'post_id' => $faker->randomElement($posts)->id,
                'user_id' => $faker->randomElement($users)->id,
                'content' => Str::limit($faker->paragraph, 500),
            ]);
        }

        // Create Media
        for ($i = 0; $i < 30; $i++) {
            Media::create([
                'post_id' => $faker->randomElement($posts)->id,
                'image_media' => $faker->imageUrl(),
            ]);
        }
    }
}
