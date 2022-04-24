<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
                        [
                            'subject' => "Physics",
                        ],
                        [
                            'subject' => "History",
                        ],
                        [
                            'subject' => "Science",
                        ]
                    ];
        foreach ($subjects as $subject)  {
            Subject::create($subject);
        }
        
    }
}
