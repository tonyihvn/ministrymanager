<?php

namespace App\Http\Controllers;

use App\Models\ministries;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\audit;

class MinistriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ministries = ministries::paginate(50);
        $users = User::select('id','name')->get();

        return view('ministries', compact('ministries','users'));
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
        ministries::updateOrCreate(['id'=>$request->id],[
            'name' => $request->name,
            'details' => $request->details,
            'leader' => $request->leader,
            'activities'=>$request->activities,
            'settings_id'=>Auth()->user()->settings_id
        ]);
        $ministries = ministries::paginate(50);
        $users = User::select('id','name');
        audit::create([
            'action'=>"A Ministry was created/modified".$request->name,
            'description'=>'Create/modify',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id
        ]);
        $message='A Ministry was created/modified';
        return view('ministries', compact('ministries','users','message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ministries  $ministries
     * @return \Illuminate\Http\Response
     */
    public function show(ministries $ministries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ministries  $ministries
     * @return \Illuminate\Http\Response
     */
    public function edit(ministries $ministries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ministries  $ministries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ministries $ministries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ministries  $ministries
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ministries::findOrFail($id)->delete();
        $message = 'The ministry has been deleted!';
        audit::create([
            'action'=>"A Ministry was deleted",
            'description'=>'Delete',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        return redirect()->route('ministries')->with(['message'=>$message]);
    }
}
