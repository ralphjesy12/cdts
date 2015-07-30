<?php 

namespace App\Http\Controllers;
use Input;
use Response;
use Storage;

use App\Exams;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormsController extends Controller {

	/*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */
	public $data = [];

	/**
     * Show the homepage of Kcom Realty
     *
     * @return Response
     */
	public function __construct(Request $request)
	{
		$this->middleware('auth');

		if($user = $request->user()){
			$this->data['user'] = $user->toArray();
		};
	}

	public function saveExam()
	{
		$exam = new Exams;

		$input = Input::all();
        $exam->code = $input['examcode'];
        $exam->title = strlen($input['examtitle']) > 0 ? $input['examtitle'] : "Exam ".$input['examcode'];
        $exam->items = $input['examitems'] > 0 ? $input['examitems'] : 1;
        $exam->attempts = $input['examattempts'] > 0 ? $input['examattempts'] : 1;
        $exam->type = $input['examtype'];
        $exam->status = 1;

        $exam->save();
		
		return redirect()->intended('/assessment');
	}
	public function saveQuestion()
	{
		
		$input = Input::all();
		if(!empty($input['questionid'])){
			$question = Question::find($input['questionid']);
		}else{
			$question = new Question;
		}
		$question->exam = $input['exam'];
		$question->body = $input['examtitle'];
		$question->choices = json_encode($input['choices']);
		if(!empty($input['questionid'])){
        	$question->save();
		}else{
			$question->save();
		}
		return redirect()->intended('/assessment/exams/' . $input['examcode'] . '/edit');
	}

}
