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



class AdminController extends Controller
{
    public function getAdminHome()
	{
		return view('auth.admin.home');
	}

	public function getAdminCommittee()
	{
		$activeProcComs = Proc::where('status', 1)->get();

		foreach ($activeProcComs as $activeProcCom) {
			if(!empty($activeProcCom->end_date)){
				if($activeProcCom->end_date < date('Y-m-d'))
					{
						Proc::where('user_id',$activeProcCom->user_id)->update(array(
			            'status' => 2
		        		));
					}
			}
		}

		$procs = Proc::where('designation', 'Proctor')->where('status', 1)->with('teacher')->get();
		$assProcs = Proc::where('designation', 'Assistant Proctor')->where('status', 1)->with('teacher')->get();

		return view('auth.admin.committee')->with('procs', $procs)->with('assProcs',$assProcs);
	}

	public function getAdminProcList()
	{
		$activeProcComs = Proc::where('status', 1)->get();

		foreach ($activeProcComs as $activeProcCom) {
			if(!empty($activeProcCom->end_date)){
				if($activeProcCom->end_date < date('Y-m-d'))
					{
						Proc::where('user_id',$activeProcCom->user_id)->update(array(
			            'status' => 2
		        		));
					}
			}
		}

		$procs = Proc::where('designation', 'Proctor')->where('status', 2)->with('teacher')->paginate(6);
		$assProcs = Proc::where('designation', 'Assistant Proctor')->where('status', 2)->with('teacher')->paginate(6);
		
		return view('auth.admin.procList')->with('procs', $procs)->with('assProcs',$assProcs);
	}

	public function getAdminApproval()
	{
		$inactiveProcComs = Proc::where('status', 0)->get();

		foreach ($inactiveProcComs as $inactiveProcCom) {
			if(!empty($inactiveProcCom->start_date)){
				if($inactiveProcCom->start_date < date('Y-m-d'))
					{
						Proc::where('user_id',$inactiveProcCom->user_id)->update(array(
			            'status' => 1
		        		));
					}
			}
		}

		$procs = Proc::where('status', 0)->with('teacher')->get();
		return view('auth.admin.approval')->with('procs', $procs);
	}

	public function getAdminPolicy()
	{
		$policies = Policy::paginate(3);
		return view('auth.admin.policy')->with('policies', $policies);
	}

	public function putAdminCommittee()
    {
    	
        $input = Input::all();

		$rules = array(
			'start_date' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{	
			$start_date = $input['start_date'];
			$end_date = $input['end_date'];
			$proc_userId=$input['proc_userId'];

			if(empty($end_date)){

				//no end date provided, only start date will be updated
				Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date
	        	));
				
			}
			else
			{
				//update both startdate and end date
				//if end date is in past, put status as retired
				if($end_date < date('Y-m-d'))
				{
					Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date,
		            'end_date'=> $end_date,
		            'status' => 2
	        		));
				}
				else
				{
					Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date,
		            'end_date'=> $end_date
	        		));
				
				}
				

			}
			return redirect::to('adminCommittee');

		} else {

				return Redirect::to('adminCommittee')->withInput()->withErrors($v);
		}
    }

    public function putAdminApproval()
    {
    	
        $input = Input::all();

		$rules = array(
			'start_date' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{	
			$start_date = $input['start_date'];
			$end_date = $input['end_date'];
			$proc_userId=$input['proc_userId'];

			//no end date provided, only start date will be updated
			if(empty($end_date)){

				//if start date is in past, put status as active
				if($start_date <= date('Y-m-d'))
				{
					Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date,
		            'status' => 1
	        		));
				}
				else
				{
					Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date
	        		));
				
				}
				
			}
			else
			{
				//update both startdate and end date
				//if end date is in past, put status as retired
				if($end_date < date('Y-m-d'))
				{
					Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date,
		            'end_date'=> $end_date,
		            'status' => 2
	        		));
				}
				else
				{
					Proc::where('user_id',$proc_userId)->update(array(
		            'start_date' => $start_date,
		            'end_date'=> $end_date
	        		));
				
				}
				

			}
			return redirect::to('adminApproval');

		} else {

				return Redirect::to('adminApproval')->withInput()->withErrors($v);
		}
    }

    public function deleteAdminApproval($id)
    {
    	$proc = Proc::where('id', $id)->first();	
        User::where('id', $proc->user_id)->delete();
		return Redirect::to('adminApproval');

    }

    public function putAdminPolicy()
    {
    	
        $input = Input::all();

		$rules = array(
			'code' => 'required',
			'content' => 'required'
			);
		
		$v = Validator::make($input, $rules);
			
		if($v->passes())
		{	
			$code = $input['code'];
			$content = $input['content'];
			$policy_id =$input['policy_id'];

			Policy::where('id',$policy_id)->update(array(
		        'number' => $code,
		        'content' => $content
	        ));
			
			return redirect::to('adminPolicy');

		} else {

				return Redirect::to('adminPolicy')->withInput()->withErrors($v);
		}
    }

    public function addAdminPolicy()
    {
    	
        $input = Input::all();

		$rules = array(
			'code' => 'required',
			'content' => 'required'
			);
		
		$v = Validator::make($input, $rules);
			
		if($v->passes())
		{
			$policy = new Policy();
			$policy->number=$input['code'];
			$policy->content=$input['content'];
			$policy->save();
			
			return redirect::to('adminPolicy');

		} else {

			return Redirect::to('adminPolicy')->withInput()->withErrors($v);
		}
    }

    public function deleteAdminPolicy($id)
    {	
        Policy::where('id', $id)->delete();
		return Redirect::to('adminPolicy');
    }
}
