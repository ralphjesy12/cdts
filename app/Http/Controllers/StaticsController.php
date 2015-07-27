<?php namespace App\Http\Controllers;
use Input;
use Response;
use Storage;

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
	public function browser($type)
	{
		$path = Input::get('folder');
		if(empty($path))
			$path = '';
		else
			$path = DIRECTORY_SEPARATOR.$path;

		$d = Storage::directories('training'.DIRECTORY_SEPARATOR.$type.$path);
		$f = Storage::files('training'.DIRECTORY_SEPARATOR.$type.$path);

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
		if(in_array($this->data['user']['level'],[0])){
			$this->data['exams'] = Exams::where('status', 1)
               ->orderBy('id', 'asc')
               ->get();
			return view('home.admin.assessment',$this->data);
		}
		else
			return view('home.assessment',$this->data);
	}
	public function interactive()
	{
		return view('home.interactive',$this->data);
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
	public function exams($type)
	{
		$this->data['type'] = $type;
		return view('home.exams',$this->data);
	}
	public function qa($id,$q)
	{
		return view('home.questions',$this->data);
	}

}
