<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookCloud>
 */
class BookCloudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = ['Comedy','Funny','Family','Drama','Action and Adventure','senice','futures','programing','Classics','Comic Book or Graphic Novel','Historical Fiction','Fantasy','Detective and Mystery'];
        return [
            'title' => $this->faker->name(),
            'content' => $this->faker->paragraph(4),
            'author' => $this->faker->name(),
            'rate' => $this->faker->randomFloat(1,1,5),
            'totalpages' => $this->faker->randomNumber(3,true),
            'img' => $this->faker->imageUrl(50,80,'animals', true),
            'audio' => $this->faker->fileExtension(),
            'categories'=>json_encode($categories),
            'tags' => json_encode($this->faker->randomElements($categories, 3), true),
            'file' => $this->faker->mimeType(),

        ];
    }
}
