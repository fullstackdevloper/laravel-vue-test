<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();

        return QuestionResource::collection($questions);
    }
    
    public function submit(Request $request)
    {
        $questions = $request->questions;

        foreach ($questions as $key => $question) {
            Answer::create([
                'user_id' => Auth::user()->id,
                'question_id' => $question['id'],
                'option_id' => $question['value'],
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Survey Submited Successfully'
        ]);
    }
}
