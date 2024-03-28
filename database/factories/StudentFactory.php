<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
	private static $lastNumber = 50; 
	protected $model = Student::class;
	
	public function definition()
	{
		self::$lastNumber++;

		return [
			'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
			'birthday' => $this->faker->dateTimeBetween('-20 year', 'now'),
			'number_phone' => random_int(900000000, 999999999),
			'number_bi' => random_int(000000000, 999999999),
			'gender' => $this->faker->randomElement(['masculino', 'feminino']),
			'address' => $this->faker->address(),
			'nationality' => $this->faker->country,
			'process_number' => self::$lastNumber,
			'language_option' => $this->faker->randomElement(['Inglês', 'Francês']),
			'image' => 'user_default.png',
			'course_id' => Course::inRandomOrder()->first()->id
		];
	}

}
