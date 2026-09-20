<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'Backend Development',
                'Frontend Development',
                'Database Management',
                'API Development',
                'DevOps',
                'Cloud Infrastructure',
                'Networking',
                'Cybersecurity',
                'System Administration',
                'Testing and QA',
                'Bug Fixing',
                'Code Review',
                'Documentation',
                'Performance Optimization',
                'CI/CD',
                'Monitoring and Logging',
                'Data Engineering',
                'Machine Learning',
                'UI/UX Design',
                'Technical Research']),
        ];
    }
}
