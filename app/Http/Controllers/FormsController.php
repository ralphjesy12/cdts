<?php 

namespace App\Http\Controllers;
use Input;
use Response;
use Image;
use Storage;


use Auth;
use App\User;
use App\Exams;
use App\Question;
use App\Answers;
use App\Interactive;
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
	public function saveAnswer()
	{

		$input = Input::all();
		$answer = new Answers;
		$answer->exam_id = $input['exam'];
		$answer->question_id = $input['question'];
		$answer->user_id = $input['user'];
		$answer->answer = $input['answer'];
		$answer->assessment_id = $input['assessment'];
		$answer->save();
		return redirect()->intended('/assessment/exams/' . $input['examcode'] . '/'. ++$input['item']);
	}
	public function saveExamInteractive()
	{
		$exam = new Exams;
		$input = Input::all();

		$exam->code = strtoupper(str_random(10));
		$exam->title = strlen($input['examtitle']) > 0 ? $input['examtitle'] : "Exam ".$exam->code;
		$exam->items = count($input['title']);
		$exam->attempts = 3;
		$exam->type = "Interactive";
		$exam->status = 1;
		$exam->save();

		$title = $input['title'];
		$desc = $input['desc'];
		$images = Input::file('images');
		for($i=0;$i<count($title);$i++){
			$interactive = new Interactive;

			if(!empty($images[$i])){
				$outputname = hash('crc32b',$exam->code) . '_' . hash('crc32b',$title[$i]);
				$moveFolder = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'steps'.DIRECTORY_SEPARATOR;
				Image::make($images[$i])->resize(400, 250, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->resizeCanvas(400, 250, 'center', false, array(255, 255, 255, 0))->save($moveFolder.$outputname.'.jpg');

				$interactive->image = $outputname.'.jpg';
			}

			$interactive->exam_id = $exam->id;
			$interactive->step = $i + 1;
			$interactive->title = $title[$i];
			$interactive->desc = $desc[$i];
			$interactive->save();
		}

		return redirect()->intended('/assessment');
	}


	public function saveAnswerInteractive(Request $request)
	{

		$input = Input::all();
		$exam = Exams::where(['code'=>$input['code']])->firstOrFail();
		$user = User::find($request->user()->id);

		$correct = 0;
		foreach($input['steps'] as $k=>$v){
			if(($k+1) != $v) break;
			$correct++;
		}

		$assessment = User::find($user->id)->assessment()->where([
			'exam_id' => $exam->id
		])->get()->last();

		$assessment->status = 1;
		$assessment->score = $correct/count($input['steps']) ;
		$assessment->save();

		return redirect()->intended('/assessment/interactive/'.$input['code'].'/result');
	}

	public function ajaxAuthenticateSupervisor(){
		return [
			'status' => (
				Auth::attempt(['password' => Input::get('password'), 'level' => 2]) ||
				Auth::attempt(['password' => Input::get('password'), 'level' => 3]) ||
				Auth::attempt(['password' => Input::get('password'), 'level' => 4])
				)
		];
	}

}
