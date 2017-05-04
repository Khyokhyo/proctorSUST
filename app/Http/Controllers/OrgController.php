<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Redirect;
use Auth;
use App\User;
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


class OrgController extends Controller
{	
	public function getOrgHome()
	{
		$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
		$org_id = $org->id;
		return view('auth.org.home')->with('org', $org);
	}
	public function getOrgNotice()
	{

		$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
		if(!($org->status==1)) {

			return redirect::to('orgHome');

		}
		else{
		
		$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
		$org_id = $org->id;
		$advisors = OrgAdvisor::where('org_id', $org_id)->with('teacher')->get();
		
		$notice_receivers = NoticeReceiver::where('receiver_id',Auth::user()->getAuthIdentifier())->where('status',1)->with('user')->with('notice.attachment')->get();
		$viewNotices = Notice::where('status',1)->where('category','org')->get();

		return view('auth.org.notice')->with('org', $org)->with('notice_receivers', $notice_receivers)->with('viewNotices', $viewNotices)->with('advisors',$advisors);
		}
	}
    
    public function removeAdvisor($id)
	{	
		OrgAdvisor::where('id',$id)->delete();
		return Redirect::to('orgCommittee');
    }
    public function removeMember($id)
	{	
		OrgCom::where('id',$id)->delete();
		return Redirect::to('orgCommittee');
    }

	public function getOrgCommittee()
	{
		//check if id is approved by a proc
		$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
		//if not, stay in homepage
		if(!($org->status==1)) {

			return redirect::to('orgHome');

		}
		//otherwise add advisor and committee member
		else{

			$org_id = $org->id;
			$teachers = Teacher::all();
			$orgComs = OrgCom::where('org_id', $org_id)->where('status', 1)->with('student')->get();
			$advisors = OrgAdvisor::where('org_id', $org_id)->where('status', 1)->with('teacher')->get();
			
			return view('auth.org.committee')->with('org', $org)->with('teachers',$teachers)->with('orgComs', $orgComs)->with('advisors',$advisors);
		}
		
	}

	public function putOrgHome()
	{
		$input = Input::all();
		$i = Auth::user()->getAuthIdentifier();

		$rules = array(
			'username' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();

		if($v->passes())
		{
			$username = $input['username'];
			$name = $input['name'];
			$type = $input['type'];
			$motto = $_GET['motto'];
			$formation_date = $input['formation_date'];

			$same_name_users= User::where('username',$username)->first();

			if((empty($same_name_users))||($same_name_users->id == Auth::user()->getAuthIdentifier()))
			//if the logged in user has the name then update
			{
			
				User::where('id',Auth::user()->getAuthIdentifier())->update(array(
		            'username' => $username
	        	));

				Organization::where('user_id',Auth::user()->getAuthIdentifier())->update(array(
		            'name' => $name,
		            'type' => $type,
		            'motto' => $motto,
		            'formation_date' => $formation_date
	        	));

	        	$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
	        	return redirect::to('orgHome');
	        }
	        else
	        	return redirect::to('orgHome');


        } else {

        	$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
			return redirect::to('orgHome')->withInput()->withErrors($v);
		}

		$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();
		return redirect::to('orgHome');
	}

	public function addOrgCom()
    {
        $input = Input::all();

		$rules = array(
			'reg_no' => 'required',
			'designation' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$student = Student::where('reg_no',$input['reg_no'])->first();
			$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();

			if(!empty($student)){

				$orgCom = new OrgCom();
				$orgCom->org_id = $org->id;
				$orgCom->student_id = $student->id;
				$orgCom->designation = $input['designation'];
				$orgCom->status = 0;
				if($orgCom->save()){

						$change = new ChangeRequest();
						$change->org_id = $org->id;
						$change->type = 1;
						if($change->save())
							return Redirect::to('orgCommittee');
						else
							return Redirect::to('orgCommittee');
					}
				}
				else
					return Redirect::to('orgCommittee'); 

		} else {

				return Redirect::to('orgCommittee')->withInput()->withErrors($v);
		}
    }

    

    public function addAdvisor()
    {
        $input = Input::all();

		$rules = array(
			'teacher_name' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{	
			$teacher = Teacher::where('fullname',$input['teacher_name'])->first();
			$org = Organization::where('user_id',Auth::user()->getAuthIdentifier())->first();

			if(!empty($teacher)){

				$orgAdvisor = new OrgAdvisor();
				$orgAdvisor->org_id = $org->id;
				$orgAdvisor->advisor_id = $teacher->id;
				
				if($orgAdvisor->save()){

					$change = new ChangeRequest();
					$change->org_id = $org->id;
					$change->type = 0;
						
					if($change->save())
						return Redirect::to('orgCommittee');
					else
						return Redirect::to('orgCommittee');
				}
				
			}
			else
				return Redirect::to('orgCommittee'); 

		} 
	else
		return Redirect::to('orgCommittee')->withInput()->withErrors($v);
		
    }


}
