<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            // если пользователь существует — выберем случайного, иначе создадим
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
