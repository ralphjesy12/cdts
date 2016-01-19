<?php namespace App\Http\Controllers;
use Input;
use Response;
use Storage;

use App\User;
use App\Activity;
use App\Answers;
use App\Question;
use App\Exams;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class StaticsController extends Controller {

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
			$this->data['userobj'] = $user;
		};
	}

	public function home()
	{
		return view('home.home',$this->data);
	}
	public function training()
	{
		return view('home.training',$this->data);
	}
	public function account()
	{
		return view('home.account',$this->data);
	}
	public function accountmanage()
	{
		if(in_array($this->data['user']['level'],[4,3,2])){
			$this->data['users'] = User::orderBy("updated_at",'desc')->paginate(20);
			return view('home.accountmanage',$this->data);
		}
		else
			return redirect()->intended('/account');
	}
	public function browser($type)
	{

		$path = Input::get('folder');


		if(empty($path))
			$path = '';
		else
			$path = '/'.$path;

		if (Storage::exists('training'.'/'.$type.$path))
		{
			$path = 'training'.'/'.$type.$path;

		}else{
			$path = 'training'.DIRECTORY_SEPARATOR.$type.$path;
		}
		$d = Storage::directories($path);
		$f = Storage::files($path);

		foreach($d as $k=>$v){
			$d[$k] = str_replace('/', '\\',  $v);
		}

		foreach($f as $k=>$v){
			$f[$k] = str_replace('/', '\\',  $v);
		}

		$this->data['dirs'] = $d;
		$this->data['files'] = $f;
		$this->data['type'] = $type;

		return view('home.browser',$this->data);
	}
	public function assessment()
	{
		if(in_array($this->data['user']['level'],[4,3,2])){
			$this->data['exams'] = Exams::where('status', 1)
				->orderBy('id', 'asc')
				->get();
			return view('home.admin.assessment',$this->data);
		}
		else
			return view('home.assessment',$this->data);
	}

	public function reports()
	{
		if(in_array($this->data['user']['level'],[4,3,2])){
			return view('home.reports',$this->data);
		}
		else
			return back();
	}
	public function interactive($id,Request $request)
	{

		$user = User::find($request->user()->id);
		$exam = Exams::where(['code'=>$id])->firstOrFail();
		$thisassess = $user->assessment()->create([
			'exam_id' => $exam->id,
			'status' => 0
		]);

		$this->data['steps'] = $exam->interactives()->get()->toArray();
		$this->data['code'] = $id;
		shuffle($this->data['steps']);
		return view('home.interactive',$this->data);
	}
	public function interactivepractice($id,Request $request)
	{

		$user = User::find($request->user()->id);
		$exam = Exams::where(['code'=>$id])->firstOrFail();
		$thisassess = $user->assessment()->create([
			'exam_id' => $exam->id,
			'status' => 3
		]);

		$this->data['steps'] = $exam->interactives()->get()->toArray();
		$this->data['code'] = $id;
		shuffle($this->data['steps']);
		return view('home.interactivepractice',$this->data);
	}

	public function ViewModule(){
		$path = Input::get('file');
		$filename = str_replace("/", "\\", $path);
		$file = Storage::disk('local')->get($filename);
		$filepath = storage_path().'\\app\\'.$filename;
		if(in_array(pathinfo($filename,PATHINFO_EXTENSION),['pdf'])){
			return response($file)
				->header('Content-Type', mime_content_type($filepath));
		}else{
			return response()->download($filepath);
		}
	}

	public function exams($type,Request $request)
	{
		$user = User::find($request->user()->id);
		$this->data['type'] = $type;
		$this->data['exams'] = Exams::where([
			'type' => ucwords(strtolower($type)),
		])->orderBy('created_at', 'desc')->get()->toArray();

		foreach($this->data['exams'] as $k=>$v){
			$this->data['exams'][$k]['questions'] = Exams::find($v['id'])->firstOrFail()->questions()->count();
			$this->data['exams'][$k]['trials'] = User::find($user->id)->assessment()->where([
				'exam_id' => $v['id'],
				'status' => 1
			])->count();
			$lastAssessment = User::find($user->id)->assessment()->where([
				'exam_id' => $v['id'],
				'status' => 1
			])->get()->last();
			$this->data['exams'][$k]['score'] = false;
			if($lastAssessment){
				$this->data['exams'][$k]['score'] = $lastAssessment->score;
			}
		}
		return view('home.exams',$this->data);
	}
	public function examsedit($id)
	{
		if(in_array($this->data['user']['level'],[4,3,2])){
			$this->data['info'] = Exams::where('code', $id)->firstOrFail();
			$this->data['questions'] = Question::where('exam',with($this->data['info'])->id)->get();
			return view('home.admin.examsedit',$this->data);
		}else{
			return redirect()->intended('/assessment');
		}
	}
	public function examsdelete($id)
	{
		if(in_array($this->data['user']['level'],[4,3,2])){
			$questions = Exams::where('code', $id)->first()->questions();
			if(count($questions))
				$questions->delete();
			if(count(Exams::where('code', $id)->delete())){
				return redirect()->intended('/assessment');
			}else{
				abort(404);
			}
		}else{
			return redirect()->intended('/assessment');
		}
	}
	public function qadelete($exam,$id)
	{
		if(in_array($this->data['user']['level'],[4,3,2])){
			if(count(Question::findOrFail($id)->delete())){
				return redirect()->intended('/assessment/exams/'.$exam.'/edit');
			}else{
				abort(404);
			}
		}else{
			return redirect()->intended('/assessment');
		}
	}

	public function interactiveResult($id,Request $request)
	{
		$exam = Exams::where(['code' => $id])->firstOrFail();
		$user = User::find($request->user()->id);
		$assessment = User::find($user->id)->assessment()->where([
			'exam_id' => $exam->id,
			'status' => 1
		])->get()->last();

		$this->data['exam'] = $exam;
		$this->data['assessment'] = $assessment;
		$this->data['attempts'] = User::find($user->id)->assessment()->where([
			'exam_id' => $exam->id,
			'status' => 1
		])->get()->count();

		return view('home.interactiveresult',$this->data);
	}

	public function interactiveResultPractice($id,Request $request)
	{
		$exam = Exams::where(['code' => $id])->firstOrFail();
		$user = User::find($request->user()->id);
		$assessment = User::find($user->id)->assessment()->where([
			'exam_id' => $exam->id,
			'status' => 2
		])->get()->last();

		$this->data['exam'] = $exam;
		$this->data['assessment'] = $assessment;
		$this->data['attempts'] = User::find($user->id)->assessment()->where([
			'exam_id' => $exam->id,
			'status' => 2
		])->get()->count();

		$this->data['correct'] = $exam->interactives()->get();

		return view('home.interactiveresultpractice',$this->data);
	}
	public function qa($id,$q,Request $request)
	{
		$user = User::find($request->user()->id);
		$exam = Exams::where(['code'=>$id])->firstOrFail();
		$availableQuestions = $exam->questions()->count();
		if($availableQuestions<$exam->items)
			$exam->items = $availableQuestions;
		$this->data['exam'] = $exam;
		if($q==0){


			$thisactivity = new Activity();
			$thisactivity->createActivity(
				$user,
				'exam',
				'took the Exam : ' . $exam->title,
				0
			);

			$thisassess = $user->assessment()->create([
				'exam_id' => $exam->id,
				'status' => 0
			]);
			$this->data['status'] = "start";
		}else{
			$assesment = User::find($user->id)->assessment()->where([
				'exam_id' => $exam->id
			])->get()->last();
			$questions = $exam->questions()->whereNotExists(function ($query) use ($user,$assesment) {
				$query->select('answers.question_id')
					->from('answers')
					->whereRaw('answers.question_id = questions.id AND answers.exam_id = questions.exam AND answers.user_id = "'.$user->id.'" AND answers.assessment_id = "'.$assesment->id.'"');
			})->get();

			if(count($questions)){
				$question = $questions->random(1)->toArray();
				$this->data['status'] = "exam";
				$question['questionid'] = $q;

				$ac = 0;
				$questionarray = json_decode($question['choices']);
				$question['choices'] = array_map(function($k,$a) {
					$b = [];
					$b['text'] = $a;
					$b['id'] = $k;
					return $b;
				},range(0,count($questionarray)-1),$questionarray);
				shuffle($question['choices']);
				$this->data['assessment'] = $assesment->toArray();
				$this->data['question'] = $question;
			}else{
				$this->data['status'] = "result";
				$correct = Answers::where([
					'exam_id' => $exam->id,
					'assessment_id' => $assesment->id,
					'user_id' => $user->id,
					'answer' => 0
				])->count();
				$answered = Answers::where([
					'exam_id' => $exam->id,
					'assessment_id' => $assesment->id,
					'user_id' => $user->id
				])->count();
				$this->data['score'] = [
					'total' => $exam->items,
					'answered' => $answered,
					'correct' => $correct
				];
				$assessment = $assesment;
				$assessment->status = 1;
				if($exam->items>0)
					$assessment->score = $correct/$exam->items ;
				else
					$assessment->score = 0;
				$assessment->save();
			}
		}

		return view('home.questions',$this->data);
	}

	public function activity(){
		if($this->data['user']['level']>1){
			$this->data['activities'] = Activity::orderBy('created_at','desc')->paginate('10');
		}else{
			$this->data['activities'] = Activity::where('user',$this->data['user']['id'])
														->where('level', 0)->orderBy('created_at','desc')->paginate('10');
		}
		return view('home.activity',$this->data);
	}

}
