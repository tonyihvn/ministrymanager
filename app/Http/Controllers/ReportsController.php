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
    public function show(reports $reports)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function edit(reports $reports)
    {
        $ministries = ministries::select('id', 'name')->get();

        return view('edit-report', compact('reports', 'ministries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatereportsRequest  $request
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatereportsRequest $request, reports $reports)
    {
        $reports->update($request->validated());

        return redirect()->route('reports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy(reports $reports)
    {
        $reports->delete();

        return redirect()->route('reports');
    }
}
