<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class ChartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $questions = Question::with('userOptions')->get();
            $finalData = [];
            
            foreach ($questions as $key => $question) {

                $data['name'] = $question->name;
                $count = 0;
                foreach ($question->userOptions as $key => $option) {

                    if ($question->answer == $option->option_id) {
                        $count++;
                    }
                }
                $data['y'] = $count;
                array_push($finalData, $data);
            }

            $finalData = json_encode($finalData);

            return response()->json($finalData);
        }
        return view('admin.charts.index');
    }
}
