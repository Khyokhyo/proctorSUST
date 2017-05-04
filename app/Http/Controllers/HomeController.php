<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Redirect;
use Auth, App\User;
use App\Notice;
use App\Organization;
use App\OrgCom;
use App\OrgAdvisor;
use App\Student;
use App\Teacher;
use App\Proc;
use App\Policy;
use App\ChangeRequest;
use App\NoticeReceiver;



class HomeController extends Controller
{
	public function getWelcome()
	{
		$procs = Proc::where('designation', 'Proctor')->where('status', 1)->with('teacher')->get();
		$assProcs = Proc::where('designation', 'Assistant Proctor')->where('status', 1)->with('teacher')->get();

		$policies= Policy::paginate(3);

		return view('welcome')->with('procs',$procs)->with('assProcs',$assProcs)->with('policies', $policies);
	}

	public function getPolicy()
	{
		$policies= Policy::all();
		
		return view('policy')->with('policies', $policies);
	}

	public function getNotice()
	{
		$notices= Notice::where('category', 'public')->where('status',1)->paginate(3);
		return view('notice')->with('notices',$notices);
	}

	public function getTeam()
	{
		return view('team');
	}

	public function getOffice()
	{
		$procs = Proc::where('designation', 'Proctor')->where('status', 1)->with('teacher')->get();
		$assProcs = Proc::where('designation', 'Assistant Proctor')->where('status', 1)->with('teacher')->get();

		return view('office')->with('procs',$procs)->with('assProcs',$assProcs);
	}

    public function postRegisterProc()
    {
        $input = Input::all();

		$rules = array(
			'username' => 'required|unique:users',
			'designation' => 'required',
			'email'=> 'required',
			'password' => 'required|confirmed'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$teacher = Teacher::where('email', $input['email'])->first();

			if(!empty($teacher)){
				$password = $input['password'];
				$password = Hash::make($password);

				$user = new User();
				$user->username = $input['username'];
				$user->user_type = 2;
				$user->password = $password;
				if($user->save()){

					$proc = new Proc();

					$proc->user_id = $user->id;
					$proc->teacher_id= $teacher->id;
					$proc->designation=$input['designation'];
					$proc->save();

					return Redirect::to('/');
				}
			}
			else
				return Redirect::to('/'); 

		} else {

				\Session::set('procStatus', true);
				return redirect()->back()->withInput()->withErrors($v);
		}
    }

    public function postRegisterOrg()
    {
		$input = Input::all();

		$rules = array(
			'username' => 'required|unique:users',
			'name' => 'required',
			'password' => 'required|confirmed'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);

			$user = new User();
			$user->username = $input['username'];
			$user->user_type = 1;
			$user->password = $password;
			if($user->save()){

				$organization = new Organization();

				$organization->name = $input['name'];
				$organization->user_id = $user->id;
				$organization->formation_date= date('Y-m-d');
				$organization->save();

				return Redirect::to('/');
			}

		} else {
			\Session::set('orgStatus', true);

			return redirect()->back()->withInput()->withErrors($v);
		}
	}

    
	public function postLogin()
	{
		$input = Input::all();

		$rules = array('username' => 'required', 'password' => 'required');
		
		$v = Validator::make($input, $rules);

		if($v->fails())
		{

			return Redirect::to('login')->withErrors($v);

		} else {

			$credentials = array('username' => $input['username'], 'password' => $input['password']);
			$user = User::where('username', $input['username'])->with('proc')->with('organization')->first();
			if(!empty($user)){
				if($user->user_type==0){
					if(Auth::attempt($credentials))
					{
						return Redirect::to('adminHome');
					} else {
						return Redirect::to('login');
					}
				}

				else if($user->user_type==2){
					$status = $user->proc->status;
					if($status == 1){
						if(Auth::attempt($credentials))
						{
							return Redirect::to('procHome');
						} else {
							return Redirect::to('login');
						}
					}
					else {
						return Redirect::to('login');
					}
				}
				
				else if($user->user_type==1){
					$status = $user->organization->status;
						if(Auth::attempt($credentials))
						{
							return Redirect::to('orgHome');
						} else {
							return Redirect::to('login');
						}
				}
				else
				return Redirect::to('login');
			}

			else
				return Redirect::to('login');
		}
	}

	public function putEditPassword()
	{
		$input = Input::all();

		$i = Auth::user()->getAuthIdentifier();

		$rules = array(
			'current' => 'required',
            'password' => 'required|confirmed'
			);
		
		$v = Validator::make($input, $rules);

		$user = User::where('id',Auth::user()->getAuthIdentifier())->first();

		if($v->passes())
		{
			$credentials = array('id' => Auth::user()->getAuthIdentifier(), 'password' => $input['current']);

			if(Auth::attempt($credentials)){

				$password = $input['password'];
				$password = Hash::make($password);

				User::where('id',Auth::user()->getAuthIdentifier())->update(array(
		            'password' => $password
	        	));

				return redirect()->back();
			}

	        else {

				return redirect()->back();

        	}

		} else {

			\Session::set('passEditStatus', true);
			return redirect()->back()->withInput()->withErrors($v);

		}
		
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}


}
