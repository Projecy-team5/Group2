<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->jobTitle();
        $slugBase = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slugBase . '-' . Str::lower(Str::random(4)),
            'description' => $this->faker->sentence(),
            'is_admin' => false,
        ];
    }
}
