<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use Illuminate\Http\Request;
use App\Models\audit;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = attendance::where('settings_id',Auth()->user()->settings_id)->paginate(50);

        return view('attendance', compact('attendance'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        attendance::updateOrCreate(['id'=>$request->id],[
            'date' => $request->date,
            'activity' => $request->activity,
            'women' => $request->women,
            'men'=>$request->men,
            'children' => $request->children,
            'total'=>$request->women+$request->men+$request->children,
            'remarks'=>$request->remarks."(".$request->stayedback." Workers)",
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $attendance = attendance::paginate(50);
        audit::create([
            'action'=>"A new Attendance record was entered".$request->title,
            'description'=>'A new Attendance record was entered',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        $message='A new Attendance record was entered';
        return view('attendance', compact('attendance','message'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        attendance::findOrFail($id)->delete();
        $message = 'The Attendance Record has been deleted!';
        audit::create([
            'action'=>"An Attendance was Deleted",
            'description'=>'An Attendance record was Deleted',
            'doneby'=>Auth()->user()->id,
            'settings_id'=>Auth()->user()->settings_id,
        ]);
        return redirect()->route('attendance')->with(['message'=>$message]);

    }
}
