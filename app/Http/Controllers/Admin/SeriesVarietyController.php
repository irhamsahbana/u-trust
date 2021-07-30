<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SeriesVariety;
use App\Models\Series;

class SeriesVarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seriesvariety = SeriesVariety::all();
        $series = Series::all();
        return view('admin.series_variety.index', compact('seriesvariety', 'series'));
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
        $this->validate($request,[
            'series_id' => 'required',
            'series_variety_name' => 'required|unique:series_varieties,series_variety_name',
        ]);

        $srv = new SeriesVariety;
        $srv->series_id = $request->input('series_id');
        $srv->series_variety_name = $request->input('series_variety_name');
        $srv->save();

        return redirect()->route('series-variety.index')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Data has been store in the database.',
            'f_msg' => 'series variety name successfully added.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $seriesvariety = SeriesVariety::find($series_id);
        // return view('admin.series_variety.index', ['seriesvariety' => $seriesvariety]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $seriesvariety = SeriesVariety::find($id);

        $this->validate($request,[
            'series_id' => 'required',
            'series_variety_name' => 'required|unique:series_varieties,series_variety_name',
        ]);

        $seriesvariety->series_variety_name = $request->series_variety_name;
        $seriesvariety->series_id = $request->series_id;
        $seriesvariety->save();
        return redirect()->route('series-variety.index')->with([
            'f_bg' => 'bg-warning',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'series variety name successfully updated.',
        ]);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seriesvariety = SeriesVariety::findOrFail($id);

        if ($seriesvariety->delete()){
            return redirect()->route('series-variety.index')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'series variety name successfully destroyed.',
            ]);
        }
    }
}
