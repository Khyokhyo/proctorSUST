<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Validator,Hash, DB;
use Redirect;
use Auth;
use App\User, App\BlockList;
use App\Notice;
use App\Attachment;
use App\Organization;
use App\OrgCom;
use App\OrgAdvisor;
use App\Student;
use App\Teacher;
use App\Proc;
use App\School;
use App\Department;
use App\Policy;
use App\ChangeRequest;
use App\NoticeReceiver;



class ProcController extends Controller
{

	public function getProcHome()
	{
		$proc = Proc::where('user_id', Auth::user()->getAuthIdentifier())->with('teacher')->first();
    	return view('auth.proc.home')->with('proc', $proc);
	}
    
    public function getProcNotice()
	{
		$id = Proc::where('user_id', Auth::user()->getAuthIdentifier())->first();

		$viewNotices = Notice::where('category','member')->get();
		$receivers = NoticeReceiver::where('receiver_id', Auth::user()->getAuthIdentifier())->with('notice')->get();

    	return view('auth.proc.notice')->with('viewNotices',$viewNotices)->with('receivers', $receivers);
	}
	public function getProcByNotice()
	{
		$id = Proc::where('user_id', Auth::user()->getAuthIdentifier())->first();

		$upDeleteNotices = Notice::where('sender_id', $id->id)->with('attachment')->paginate(3);
		$orgs= Organization::where('status', 1)->orwhere('status',2)->get();
		$procs= Proc::where('status', 1)->get();
		
    	return view('auth.proc.noticeByProc')->with('upDeleteNotices',$upDeleteNotices)->with('orgs', $orgs)->with('procs',$procs)->with('id', $id);
	}
	public function getProcOrganizations()
	{
		$orgs= Organization::where('status', 1)->orwhere('status',2)->get();
		return view('auth.proc.organizations')->with('orgs', $orgs);
	}

	public function getProcTeachers()
	{
		$schools = School::all();
    	return view('auth.proc.schools')->with('schools', $schools);
	}

	public function getDepartments()
	{
		$departments = Department::all();
		//where('school_id', $id)->get();
    	return view('auth.proc.departments')->with('departments', $departments);
	}
	public function getTeachers($id)
	{
		$teachers = Teacher::where('dept_id', $id)->get();
    	return view('auth.proc.teachers')->with('teachers', $teachers);
	}
	/*
	public function getViewChangeRequest($org_id)
	{
		return $advisors=OrgAdvisor::where('org_id', $org_id)->where('status',0)->with('teacher.dept')->get();
		$committee=OrgCom::where('org_id', $org_id)->where('status',0)->with('student')->get();
		return view('auth.proc.viewChangeRequest')->with('advisors', $advisors)->with('committee', $committee);
	}
	*/
	public function getProcApprovals()
	{
		$orgs= Organization::where('status', 0)->get();

		$changeRequests = ChangeRequest::groupBy('org_id')->with('organization.orgAdvisor.teacher.dept')->get();


		return view('auth.proc.approvals')->with('orgs', $orgs)->with('changeRequests', $changeRequests);
    }
    public function approveOrg($id)
	{	
		Organization::where('id',$id)->update(array('status' => 1));
		return Redirect::to('procApprovals');
    }
    public function approveAdvisor($id)
	{	
		$orgAdvisorRow= OrgAdvisor::where('id',$id)->first();
		$org_id=$orgAdvisorRow->org_id;
		$changeRequestRow = ChangeRequest::where('org_id', $org_id)->where('type',0)->first();

		ChangeRequest::where('id', $changeRequestRow->id)->delete();
		OrgAdvisor::where('id',$id)->update(array('status' => 1));
		return redirect()->back();
    }
    public function approveOrgCom($id)
	{	
		$orgComRow= OrgCom::where('id',$id)->first();
		$org_id=$orgComRow->org_id;
		$changeRequestRow = ChangeRequest::where('org_id', $org_id)->where('type',1)->first();

		ChangeRequest::where('id', $changeRequestRow->id)->delete();
		OrgCom::where('id',$id)->update(array('status' => 1));
		return redirect()->back();
    }
    public function denyOrg($id)
	{	
		$org= Organization::where('id',$id)->first();
		$orgUserId=$org->user_id;
		Organization::where('id',$id)->delete();
		User::where('id', $orgUserId)->delete();
		return Redirect::to('procApprovals');
    }
    public function denyAdvisor($id)
	{	
		$orgAdvisorRow= OrgAdvisor::where('id',$id)->first();
		$org_id=$orgAdvisorRow->org_id;
		$changeRequestRow = ChangeRequest::where('org_id', $org_id)->where('type',0)->first();

		ChangeRequest::where('id', $changeRequestRow->id)->delete();
		OrgAdvisor::where('id',$id)->delete();
		
		return redirect()->back();
    }
    public function denyOrgCom($id)
	{	
		$orgComRow= OrgCom::where('id',$id)->first();
		$org_id=$orgComRow->org_id;
		$changeRequestRow = ChangeRequest::where('org_id', $org_id)->where('type',1)->first();

		ChangeRequest::where('id', $changeRequestRow->id)->delete();
		OrgCom::where('id',$id)->delete();
		
		return redirect()->back();
    }
    public function getApproveAll($id)
	{
		$org= Organization::where('id',$id)->first();
		$approveComs = OrgCom::where('org_id', $id)->where('status', 0)->with('student.dept')->get();
		$approveAdvisors = OrgAdvisor::where('org_id', $id)->where('status', 0)->with('teacher.dept')->get();
    	return view('auth.proc.approveAll')->with('approveAdvisors', $approveAdvisors)->with('org', $org)->with('approveComs', $approveComs);
	}
	

	/*public function postTest()
	{
		//$current_view= "upload";
    
        $file=Input::file('myfile');
        
        $destinationPath = 'profile_pic';
        $extension = $file->getClientOriginalExtension();

        $filename =Auth::user()->name.rand(11111,99999).'.'.$extension;
        
        $upload_success = $file->move($destinationPath, $filename);
        
        $attachment = new Attachment();
        $attachment->notice_id = 1;
        $attachment->link = $destinationPath.'/'.$filename;
      	$attachment->save();
      	return Redirect::to('procHome');

	}*/

	//postNotice this method is called when any proc posts a notice
	public function postTest()
    {
    	
        $input = Input::all();
        if(!empty($input['procs']))
        $procs = $input['procs'];
    	if(!empty($input['orgs']))
        $orgs = $input['orgs'];

		$id = Proc::where('user_id', Auth::user()->getAuthIdentifier())->first();
		//$content = $_GET['content'];

		$rules = array(
			'subject' => 'required',
			'category' => 'required',
			'dop'=> 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$notice = new Notice();
			$notice->sender_id = $id->id;
			$notice->subject = $input['subject'];
			$notice->category = $input['category'];
			$notice->content = $input['content'];
			$notice->dop = $input['dop'];
			if($id->designation == 'Proctor')
				$notice->status = 1;
			
			if($notice->save()){
				//save the file if there is any

				$file=Input::file('myfile');
				if(!empty($file))
				{
					$destinationPath = 'attachments';
			        $extension = $file->getClientOriginalExtension();

			        $filename =Auth::user()->name.rand(11111,99999).'.'.$extension;
			        
			        $upload_success = $file->move($destinationPath, $filename);
			        
			        $attachment = new Attachment();
			        $attachment->notice_id = $notice->id;
			        $attachment->name = $filename;
			        $attachment->link = $destinationPath.'/'.$filename;
			      	$attachment->save();
				}
				
       			//if not public then set recepients
				if($notice->category == 'custom'){
					
					if(!empty($procs)){

						foreach ($procs as $proc) {
							$receiverProc = new NoticeReceiver();
							$receiverProc->notice_id = $notice->id;
							$receiverProc->receiver_id = $proc;
							if($id->designation == 'Proctor')
								$receiverProc->status = 1;
							$receiverProc->save();
						}
					}
				

					if(!empty($orgs)){

						foreach ($orgs as $org) {
							$receiverOrg = new NoticeReceiver();
							$receiverOrg->notice_id = $notice->id;
							$receiverOrg->receiver_id = $org;
							if($id->designation == 'Proctor')
								$receiverOrg->status = 1;
							$receiverOrg->save();
						}
					}
				}

				return redirect()->back();
			}

			else
				return redirect()->back();


		} else {

				return redirect()->back()->withInput()->withErrors($v);
		}
    }

    public function getApproveNotice()
	{
		$notices = Notice::where('status', 0)->get();
		
    	return view('auth.proc.approveNotice')->with('proc.teacher')->with('notices',$notices);
	}

	public function appNotice($id)
	{	
		Notice::where('id',$id)->update(array('status' => 1));
		return Redirect::to('approveNotice');
    }

    public function denyNotice($id)
	{	
		Notice::where('id',$id)->delete();
		return Redirect::to('approveNotice');
    }

    public function deleteProcNotice($id)
	{	
		Notice::where('id',$id)->delete();
		return Redirect::to('procByNotice');
    }

    public function viewProcNotice($id)
	{
		$notice = Notice::where('id',$id)->first();
		return view('auth.proc.viewNotice')->with('notice',$notice);
    }

    public function postBlockOrg($id)
	{
		$blockList = new BlockList();
		$blockList->org_id = $id;
		$blockList->start_date = date('Y-m-d');
		if($blockList->save())
		{
			Organization::where('id',$id)->update(array('status' => 2));
			return redirect()->back();
		}
		else
			return redirect()->back();
	}
	public function postUnblockOrg($id)
	{
		BlockList::where('org_id',$id)->update(array('status' => 0, 'end_date'=> date('Y-m-d')));
		Organization::where('id',$id)->update(array('status' => 1));
			
		return redirect()->back();
	}

}
