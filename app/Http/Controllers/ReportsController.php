<?php

namespace App\Http\Controllers;

use App\Models\reports;
use App\Http\Requests\StorereportsRequest;
use App\Http\Requests\UpdatereportsRequest;
use Illuminate\Http\Request;
use App\Models\ministries;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = reports::all();
        return view('reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ministries = ministries::select('id', 'name')->get();

        return view('add-report', compact('ministries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorereportsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        reports::create($request->all());

        return redirect()->route('reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function show($rid)
    {
        $report = reports::find($rid);
        $ministries = ministries::select('id', 'name')->get();

        return view('view-report', compact('report', 'ministries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function edit($rid)
    {
        $report = reports::find($rid);
        $ministries = ministries::select('id', 'name')->get();

        return view('edit-report', compact('report', 'ministries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatereportsRequest  $request
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $report = reports::find($request->id);
        $report->update($request->all());

        return redirect()->route('reports');
    }

    // create function for addremark make it to add more text under every exiting remarks
    public function addremark(Request $request)
    {
        $report = reports::find($request->report_id);
        if($report->remarks == null) {
            $report->remarks = $request->remarks. "<br><i> Written By: ".Auth()->user()->name. " on ".date('Y-m-d H:i:s')."</i><hr>";
        }else {
            $report->remarks = $report->remarks . "\n" . $request->remarks. "<br><i> Written By: ".Auth()->user()->name. " on ".date('Y-m-d H:i:s')."</i><hr>";
        }
        $report->save();

        return redirect()->route('view-report', $request->report_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy($rid)
    {
        reports::find($rid)->delete();

        return redirect()->route('reports');
    }
}
