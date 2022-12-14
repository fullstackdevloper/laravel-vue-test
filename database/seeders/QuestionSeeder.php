<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = [
            [
                'name' => "Which animal is known as the 'Ship of the Desert'?",
                'answer' => 'Camel',
                'options' => ['Dog', 'Camel', 'Elephant', 'Cat', 'Lion']
            ],
            [
                'name' => "How many days are there in a week?",
                'answer' => '7 days',
                'options' => ['7 days', '6 days', '5 days', '8 days', '4 days']
            ],
            [
                'name' => "How many hours are there in a day?",
                'answer' => '24 hours',
                'options' => ['7 hours', '12 hours', '24 hours', '36 hours', '48 hours']
            ],
            [
                'name' => "How many letters are there in the English alphabet?",
                'answer' => '26 letters',
                'options' => ['21 letters', '24 letters', '26 letters', '24 letters', '51 letters']
            ],
            [
                'name' => "Rainbow consist of how many colours?",
                'answer' => '7 colours',
                'options' => ['7 colours', '8 colours', '6 colours', '5 colours', '9 colours']
            ],
            [
                'name' => "How many days are there in a year?",
                'answer' => '366 days',
                'options' => ['366 days', '367 days', '365 days', '360 days', '369 days']
            ],
            [
                'name' => "How many minutes are there in an hour?",
                'answer' => '60 minutes',
                'options' => ['63 minutes', '60 minutes', '65 minutes', '69 minutes', '70 minutes']
            ],
            [
                'name' => "How many seconds are there in a minute?",
                'answer' => '60 seconds',
                'options' => ['30 seconds', '50 seconds', '60 seconds', '90 seconds', '40 seconds']
            ],
            [
                'name' => "How many seconds make one hour?",
                'answer' => '3600 seconds',
                'options' => ['1200 seconds', '2400 seconds', '3600 seconds', '4800 seconds', '7200 seconds']
            ],
            [
                'name' => "How many consonants are there in the English alphabet?",
                'answer' => '24 Consonants',
                'options' => ['24 Consonants', '25 Consonants', '23 Consonants', '26 Consonants', '27 Consonants']
            ],
        ];

        foreach($questions as $question) {
            $newQuestion = Question::updateOrCreate(['name' => $question['name']]);
            foreach($question['options'] as $option) {
                
                $questionOptions= QuestionOption::updateOrCreate(['name' => $option,'question_id' =>$newQuestion->id ]);

                if($question['answer'] == $option){
                    $newQuestion->update(['answer' =>$questionOptions->id]); 
                }
            }
        }
    }
}
