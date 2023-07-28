<?php

namespace App\Http\Controllers;

use App\Models\programmes;
use Illuminate\Http\Request;
use App\Models\ministries;
use App\Models\housefellowhips;

use App\Models\audit;

class ProgrammesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ministries = ministries::select('name')->get();
        $housefellowships = housefellowhips::select('name')->get();

        $programmes = programmes::latest()->paginate(10);

        return view('programmes', compact('programmes','ministries','housefellowships'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'picture'=>'image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        if(!empty($request->file('picture'))){
            // $picture = $request->file('picture')->getClientOriginalName();
            $picture = time().'.'.$request->picture->extension();
            // $path = $request->file('picture')->store('public/images');
            $request->picture->move(\public_path('images'),$picture);
        }else{
            if($request->oldpicture==""){
                $picture = "";
            }else{
                $picture = $request->oldpicture;
            }
        }


        programmes::updateOrCreate(['id'=>$request->id],[
            'title' => $request->title,
            'type' => $request->type,
            'from' => $request->from,
            'to' => $request->to,
            'details' => $request->details,
            'category'=>$request->category,
            'ministry' => $request->ministry,
            'picture'=>$picture,
            'settings_id'=>Auth()->user()->settings_id
        ]);
        $ministries = ministries::select('name')->get();
        $programmes = programmes::paginate(10);
        $housefellowships = housefellowhips::select('name')->get();

        audit::create([
            'action'=>"A Post was Scheduled/modified ".$request->title,
            'description'=>'Create/Update',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);

        $message = "<div class='alert alert-dismissable alert-info'>The post created or modified successfully</div>";

        return view('programmes', compact('programmes','ministries','housefellowships'))->with(['message'=>$message]);
    }

    public function post($id)
    {

        $program = programmes::where('id',$id)->first();
        audit::create([
            'action'=>"A Programme has being Scheduled/modified",
            'description'=>'Create/Modify',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $message = "The Programme has being created/modified successfully";
        return view('post', compact('program','message'));
    }

    public function hfActivities($hfid)
    {
        $hfname = housefellowhips::select('name')->where('id',$hfid)->first()->name;
        $programmes = programmes::where('ministry',$hfname)->get();

        return view('hfactivities', compact('programmes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function show(programmes $programmes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function edit(programmes $programmes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, programmes $programmes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        programmes::findOrFail($id)->delete();
        $message = 'The Post has been deleted!';
        audit::create([
            'action'=>"A post was deleted ",
            'description'=>'Delete',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        return redirect()->route('programmes')->with(['message'=>$message]);
    }

    public function Artisan1($command) {
        $artisan = Artisan::call($command);
        $output = Artisan::output();
        return dd($output);
    }

    public function Artisan2($command, $param) {
        $output = Artisan::call($command.":".$param);
        return dd($output);
    }
}
