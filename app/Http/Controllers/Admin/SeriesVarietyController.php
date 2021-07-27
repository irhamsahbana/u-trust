<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeriesVariety;
use Illuminate\Http\Request;

class SeriesVarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seriesvariety = SeriesVariety::paginate(10);
        return view('admin.series_variety.index', compact('seriesvariety'));
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
            'series_variety_name' => 'required',
        ]);

        $srs = new SeriesVariety;
        $srs->series_id = $request->input('series_id');
        $srs->series_variety_name = $request->input('series_variety_name');
        $srs->save();

        return redirect()->route('admin.seriesVariety.index');
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
            'series_variety_name' => 'required',
        ]);

        $seriesvariety->series_variety_name = $request->series_variety_name;
        $seriesvariety->series_id = $request->series_id;
        $seriesvariety->save();
        return redirect()->route('admin.seriesVariety.index');   
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
            return redirect()->route('admin.seriesVariety.index');
        }
    }
}
