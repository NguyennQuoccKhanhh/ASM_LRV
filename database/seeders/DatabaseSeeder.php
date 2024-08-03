<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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

        Media::query()->truncate();
        Post::query()->truncate();
        User::query()->truncate();

        $faker = Faker::create('vi_VN');

        // Tạo Users
        $users = [];
        for ($i = 0; $i < 5; $i++) {
            $users[] = User::create([
                'name' => $faker->name,
                'avatar' => $faker->imageUrl(200, 200, 'people'),
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'type' => $faker->randomElement([User::TYPE_ADMIN, User::TYPE_MEMBER]),
            ]);
        }

        // Tạo Posts và Media
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $title = $faker->sentence;
                $sku = $faker->unique()->ean8;
                $slug = Str::slug($title . ' ' . $sku);

                $post = Post::create([
                    'user_id' => $user->id,
                    'catelogue_id' => rand(3, 5),
                    'title' => $title,
                    'slug' => $slug,
                    'sku' => $sku,
                    'image_post' => $faker->imageUrl(),
                    'description' => $faker->paragraph,
                    'content' => $faker->paragraphs(3, true),
                    'view' => $faker->numberBetween(0, 1000),
                    'is_show_home' => $faker->boolean,
                    'published_at' => $faker->dateTimeThisYear,
                ]);

                for ($j = 0; $j < rand(2, 5); $j++) {
                    Media::create([
                        'post_id' => $post->id,
                        'image_media' => $faker->imageUrl(),
                    ]);
                }
            }
        }
    }
}
