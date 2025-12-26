<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaketUjianFactory extends Factory
{
    public function definition(): array
    {
        $jenisUjian = [
            'SAS',                 
            'SAT',                 
            'PTS',                 
            'PAS',                 
            'UAS',                 
            'UTS',                 
            'US',                  
            'AS',                  
            'PH',                  
            'ANBK',                
            'Try Out',
            'Remedial',
            'Susulan',
        ];

        $semester = ['Ganjil', 'Genap'];

        return [
            'nama' => $this->faker->randomElement($jenisUjian)
                    . ' Semester '
                    . $this->faker->randomElement($semester),
        ];
    }
}
