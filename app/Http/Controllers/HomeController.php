<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\audit;
use App\Models\housefellowhips;
use App\Models\ministries;
use App\Models\attendance;
use App\Models\tasks;
use App\Models\followups;
use App\Models\programmes;
use App\Models\settings;
use App\Models\admintable;
use App\Models\ministrymembers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset($settings_id)){
            $role = admintable::select('role')->where('user_id',Auth()->user()->id)->where('settings_id',$settings_id)->first()->role;
        }else{
            $role = admintable::select('role')->where('user_id',Auth()->user()->id)->where('settings_id',Auth()->user()->settings_id)->first();
            if(isset($role->role)){
              $role = $role->role;
            }
        }
        if(($role=="Admin") || (Auth()->user()->role=="Super")){
            $attendance = attendance::where('activity','Sunday Service')->where('settings_id',Auth()->user()->settings_id)->offset(0)->take(10)->get();

            $midweekquery = attendance::where('activity','Midweek Services')->where('settings_id',Auth()->user()->settings_id)->offset(0)->take(10)->get();

            $uprogrammes = programmes::latest()->where('category','Upcoming')->where('settings_id',Auth()->user()->settings_id)->select('id','title','from','to','ministry')->paginate(5);

            $dates = ''; $totals = ''; $midweek = ''; $midweektotals = '';

            if($attendance->count()>0){
                foreach($attendance as $key=>$att){

                    $dates.= "'".$att->date."',";
                    $totals.= $att->total.",";
                }
            }
            if($midweekquery->count()>0){
                foreach($midweekquery as $key=>$mw){
                    $midweek.= $mw->date.",";
                    $midweektotals.= $mw->total.",";
                }
            }
            /*
                $dates = "'".$attendance[0]->date."','".$attendance[1]->date."','".$attendance[2]->date."','".$attendance[3]->date."','".$attendance[4]->date."','".$attendance[5]->date."','".$attendance[6]->date."','".$attendance[7]->date."','".$attendance[8]->date."','".$attendance[9]->date."'";

                $totals = $attendance[0]->total.",".$attendance[1]->total.",".$attendance[2]->total.",".$attendance[3]->total.",".$attendance[4]->total.",".$attendance[5]->total.",".$attendance[6]->total.",".$attendance[7]->total.",".$attendance[8]->total.",".$attendance[9]->total;

                $midweek = $midweek[0]->men.",".$midweek[1]->men.",".$midweek[2]->men.",".$midweek[3]->men.",".$midweek[4]->men.",".$midweek[5]->men.",".$midweek[6]->men.",".$midweek[7]->men.",".$midweek[8]->men.",".$midweek[9]->men;
            */


            return view('home', compact('dates','midweek','totals','uprogrammes','midweektotals'))->with('message','Role is :'.$role);
        }else{
            $programmes = programmes::latest()->paginate(10);
            return view('member_home',compact('programmes'));
        }

     }

    public function logout()
    {
      Auth()->logout();

      return redirect('/');
    }

    public function members()

    {
      $members = User::all()->where('settings_id',Auth::user()->settings_id)->orderBy('id','desc');
      return view('members', compact('members'));
    }

    public function membersSearch(request $request)
    {
      $members = User::where('name', $request->keyword)->orWhere('name', 'like', '%' . $request->keyword . '%')->get();
      return view('members', compact('members'));
    }

    public function member($id)
    {
      $member = User::where('id',$id)->first();
      $tasks = tasks::where('assigned_to',$id)->get();
      $followups = followups::where('member',$id)->get();

      return view('member', compact('member','tasks','followups'));
    }

    public function addNew()
    {
      $house_fellowships = housefellowhips::select('name','id')->where('settings_id',Auth()->user()->settings_id)->get();
      $ministries = ministries::select('name','id')->where('settings_id',Auth()->user()->settings_id)->get();
      return view('add-new', compact('ministries','house_fellowships'));

    }

    protected function create(request $request)
    {

        if($request->email==""){

            $email = "guest@crmfct2.org";
            $password = Hash::make("prayer22");
        }else{
            $email = $request->email;
        }

        if($request->password!=""){
            $password = Hash::make($request->password);
        }else{
            $password = $request->oldpassword;
        }

        $user = User::updateOrCreate(['id'=>$request->id],[
            'name' => $request->name,
            'email' => $email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'age_group'=>$request->age_group,
            'phone_number'=>$request->phone_number,
            'password' => $password,
            'about' => $request->date_recieved."<br>".$request->about,
            'address' => $request->address,
            'location' => $request->location,
            'house_fellowship' => $request->house_fellowship,
            'invited_by' => $request->invited_by,
            'assigned_to' => $request->assigned_to,
            // 'ministry' => $request->ministry,
            'role'=>$request->role,
            'status'=>$request->status,
            'settings_id'=>Auth()->user()->settings_id

        ]);

        $mainmin = "";
        if(isset($request->ministry)){
            // $mainmin = $request->ministry[0];
            foreach($request->ministry as $key=>$mins){
                ministrymembers::updateOrCreate([
                    'member_id'=>$user->id,
                    'ministry_id'=>$mins
                ],[
                    'member_id'=>$user->id,
                    'ministry_id'=>$mins
                ]);

                $mainmin.=$mins.",";

            }
        }

        $cleaned_mainmin = rtrim($mainmin, ",");

        $user->ministry = $cleaned_mainmin;
        $user->save();



        admintable::updateOrCreate([
            'user_id'=>$user->id,
            'settings_id'=>Auth()->user()->settings_id,
        ],[
            'user_id'=>$user->id,
            'settings_id'=>Auth()->user()->settings_id,
            'role'=>$request->role,
        ]);


        $members = User::all();
        $users = User::select('name','id')->get();

        audit::create([
            'action'=>"A New member was Created by ".$request->name,
            'description'=>'Create',
            'doneby'=>Auth()->user()->name,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $message='A New member was Created';
        return view('members', compact('members','users','message'));

    }

    public function editMember($id)
    {
      $user = User::where('id',$id)->first();
      $house_fellowships = housefellowhips::select('name','id')->where('settings_id',Auth()->user()->settings_id)->get();
      $ministries = ministries::select('name','id')->where('settings_id',Auth()->user()->settings_id)->get();
      return view('edit-member', compact('user','ministries','house_fellowships'));

    }

    public function deleteMember($id)
    {
      $user = User::where('id',$id)->delete();

      $message = 'The member has been deleted!';

      audit::create([
        'action'=>"A member was deleted",
        'description'=>'Delete',
        'doneby'=>Auth()->user()->id,
        'settings_id'=>Auth()->user()->settings_id,
      ]);
      return redirect()->route('members')->with(['message'=>$message]);

    }

    public function communications()
    {
      $response = null;
      // system("ping -c 1 google.com", $response);
      if(!checkdnsrr('google.com'))
      {
          return redirect()->back()->with(['message'=>'Please connect your internect before going to communications page <a href="/communications">Retry</a>']);
      }else{



        $session = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=login&owneremail=gcictng@gmail.com&subacct=CRMAPP&subacctpwd=@@prayer22");
        $sessionid = ltrim(substr($session,3),' ');

        \Cookie::queue('sessionidd', $sessionid, 30);

        $cbal = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=querybalance&sessionid=".$sessionid);

        $creditbalance = ltrim(substr($cbal,3),' ');

        $members = User::select('name','status','ministry','phone_number')->where('settings_id',Auth()->user()->settings_id)->get();
        $allnumbers = "";
        $lastrecord = end($members);

        // $lastkey = key($lastrecord);

        foreach($members as $key => $mnumber){
          $number = $mnumber->phone_number;
          if($number==""){
            continue;
          }

          if(substr($number,0,1)=="0"){
            $number="234".ltrim($number,'0');
          }

          $allnumbers.=$number.",";
          /*
          if($key !== $lastkey){
            $allnumbers.=$number.",";
          }else{
            $allnumbers.=$number;
          }
          */

        }
        $allnumbers = substr($allnumbers,0,-1);

        audit::create([
            'action'=>"A message was sent to ".$number,
            'description'=>'Send message',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $message='The message has been sent';
        return view('communications', compact('members','allnumbers','creditbalance'));
      }
    }

    public function sendSMS(request $request){

      // 2 Jan 2008 6:30 PM   sendtime - date format for scheduling
      if(\Cookie::get('sessionidd')){
        $sessionid = \Cookie::get('sessionidd');
      }else{
        $session = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=login&owneremail=gcictng@gmail.com&subacct=CRMAPP&subacctpwd=@@prayer22");
        $sessionid = ltrim(substr($session,3),' ');
      }

      $sessionid = \Cookie::get('sessionidd');
      $recipients = $request->recipients;
      $body = $request->body;


      $message = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=sendmsg&sessionid=".$sessionid."&message=".urlencode($body)."&sender=CHURCH&sendto=".$recipients."&msgtype=0");


      // v20ylRY3Gp6jYEAvpaDtOQQTqwoCqc1n4CUG3IBboIMTciDeVk	  -  Token for smartsms solutions

      $members = User::select('name','status','ministry','phone_number')->where('settings_id',Auth()->user()->settings_id)->get();
      $allnumbers = "";
      $lastrecord = end($members);
      $lastkey = key($lastrecord);

      foreach($members as $key => $mnumber){
        $number = $mnumber->phone_number;
        if($number=="")
          continue;

        if(substr($number,0,1)=="0")
          $number="234".ltrim($number,'0');

        $allnumbers.=$number.",";
        /*
        if($key !== $lastkey){
          $allnumbers.=$number.",";
        }else{
          $allnumbers.=$number;
        }
        */

      }
      // GET CREDIT BALANCE
      $cbal = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=querybalance&sessionid=".$sessionid);

      $creditbalance = ltrim(substr($cbal,3),' ');

      $allnumbers = substr($allnumbers,0,-1);

      // ADD AUDIT HERE
      audit::create([
        'action'=>"Message where sent to members",
        'description'=>'Sent Information',
        'doneby'=>Auth()->user()->id,
        'settings_id'=>Auth()->user()->settings_id,
      ]);
      return view('communications', compact('members','allnumbers','message','creditbalance'));


    }

    public function sentSMS(request $request){

      if(\Cookie::get('sessionidd')){
        $sessionid = \Cookie::get('sessionidd');
      }else{
        $session = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=login&owneremail=gcictng@gmail.com&subacct=CRMAPP&subacctpwd=@@prayer22");
        $sessionid = ltrim(substr($session,3),' ');
      }

      $sentmessages = file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=getsentmsgs&sessionid=".$sessionid."&pagesize=200&pagenumber=1&begindate=".urlencode('06 Sep 2021')."&enddate=".urlencode('08 Sep 2021')."&sender=CHURCH");
      error_log("All SENT: ".$sentmessages);
      return view('sentmessages', compact('sentmessages'));
    }

    public function settings(request $request){
      $validateData = $request->validate([
          'logo'=>'image|mimes:jpg,png,jpeg,gif,svg',
          'background'=>'image|mimes:jpg,png,jpeg,gif,svg'
      ]);

      if(!empty($request->file('logo'))){

          $logo = time().'.'.$request->logo->extension();

          $request->logo->move(\public_path('images'),$logo);
      }else{
          $logo = $request->oldlogo;
      }

      if(!empty($request->file('background'))){

          $background = time().'.'.$request->background->extension();

          $request->background->move(\public_path('images'),$background);
      }else{
          $background = $request->oldbackground;
      }


      settings::updateOrCreate(['id'=>$request->id],[
          'ministry_name' => $request->ministry_name,
          'motto' => $request->motto,
          'logo' => $logo,
          'address' => $request->address,
          'background' => $background,
          'mode'=>$request->mode,
          'color'=>$request->color,
          'ministrygroup_id'=>$request->ministrygroup_id,
          'user_id'=>$request->user_id
      ]);

      audit::create([
        'action'=>"Settings update!".$request->ministry_name,
        'description'=>'Update!',
        'doneby'=>Auth()->user()->id,
        'settings_id'=>Auth()->user()->settings_id,
      ]);
      $message = "The settings has been updated!";
      return redirect()->back()->with(['message'=>$message]);
    }

    public function switchministry(request $request){


        if(Auth()->user()->role=="Super"){
            $admininfo = admintable::select('role','settings_id')->where('settings_id',$request->settings_id)->first();

            User::where('id',Auth()->user()->id)->update([
                'settings_id'=>$request->settings_id,
            ]);
        }else{
            $admininfo = admintable::select('role','settings_id')->where('settings_id',$request->settings_id)->where('user_id',Auth()->user()->id)->first();

            User::where('id',Auth()->user()->id)->update([
                'settings_id'=>$request->settings_id,
                'role'=>$admininfo->role
            ]);

        }

        $ministry_name = settings::where('id',$request->settings_id)->first()->ministry_name;
        $message = "You have been switch to ".$ministry_name;
        return redirect()->route('home')->with(['message'=>$message,'settings_id'=>$admininfo->settings_id]);
    }

    public function audits()
    {
      $audits = audit::where('settings_id',Auth()->user()->settings_id)->orderBy('id', 'DESC')->paginate(10);
      return view('audits', compact('audits'));
    }

    public function delAudit($id)
    {
      $audit = audit::where('id',$id)->delete();

      $message = 'The Audit record has been deleted!';

      return redirect()->route('audits')->with(['message'=>$message]);

    }

}
