<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
                        [
                            'name' => "Tom",
                        ],
                        [
                            'name' => "John",
                        ],
                        [
                            'name' => "Sachin",
                        ],
                        [
                            'name' => "Chris",
                        ],
                        [
                            'name' => "Tim",
                        ],
                        [
                            'name' => "Nick",
                        ]
        ];
        foreach ($teachers as $teacher)  {
            Teacher::create($teacher);
        }
    }
}
