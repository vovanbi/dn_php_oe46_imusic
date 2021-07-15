<?php

namespace Database\Factories;

use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Song::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cate_id' => rand(1,10),
            'artist_id' => rand(1,10),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'link' => $this->faker->url(),
        ];
    }
}
