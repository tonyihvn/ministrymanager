<?php

namespace App\Http\Controllers;

use App\Models\housefellowhips;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\audit;


class HousefellowhipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $housefellowships = housefellowhips::paginate(50);
        $users = User::select('id','name')->get();

        return view('housefellowships', compact('housefellowships','users'));
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
        housefellowhips::updateOrCreate(['id'=>$request->id],[
            'name' => $request->name,
            'location' => $request->location,
            'address' => $request->address,
            'about' => $request->about,
            'leader' => $request->leader,
            'activities'=>$request->activities,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $housefellowships = housefellowhips::paginate(50);
        $users = User::select('id','name');

        audit::create([
            'action'=>"A House fellowship has been created ".$request->name,
            'description'=>'Create',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $message='A House fellowship has been created';
        return view('housefellowships', compact('housefellowships','users','message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\housefellowhips  $housefellowhips
     * @return \Illuminate\Http\Response
     */
    public function show(housefellowhips $housefellowhips)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\housefellowhips  $housefellowhips
     * @return \Illuminate\Http\Response
     */
    public function edit(housefellowhips $housefellowhips)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\housefellowhips  $housefellowhips
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, housefellowhips $housefellowhips)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\housefellowhips  $housefellowhips
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        housefellowhips::findOrFail($id)->delete();
        $message = 'The House Fellowship has been deleted!';

        audit::create([
            'action'=>"A House fellowship has been remove from the ministry",
            'description'=>'Removed',
            'doneby'=> Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        return redirect()->route('housefellowships')->with(['message'=>$message]);
    }
}
