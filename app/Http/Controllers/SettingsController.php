<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function settingsPublic(request $request){

        $settings_id = settings::updateOrCreate(['id'=>$request->id],[
            'ministry_name' => $request->ministry_name,
            'motto' => $request->motto,
            'address' => $request->address,
            'mode'=>$request->mode,
            'ministrygroup_id'=>$request->ministrygroup_id,
            'user_id'=>1
        ]);

        audit::create([
          'action'=>"New Ministry Created !".$request->ministry_name,
          'description'=>'Update!',
          'doneby'=>1,
          'settings_id'=>$settings_id,
        ]);
        $message = "The Ministry and User Account has been created please wait while we verify it updated!";
        return redirect()->back()->with(['message'=>$message]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(settings $settings)
    {
        //
    }
}
