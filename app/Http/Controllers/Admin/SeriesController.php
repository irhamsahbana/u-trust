<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::all();
        return view('admin.series.index', compact('series'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'series_name' => 'required|unique:series,series_name',
        ]);

        $srs = new Series;
        $srs->series_name = $request->input('series_name');
        $srs->save();

        return redirect()->route('admin.series')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Data has been store in the database.',
            'f_msg' => 'series name successfully added.',
        ]);
    }

    public function destroy($id)
    {
        $series = Series::findOrFail($id);

        if ($series->delete()){
            return redirect()->route('admin.series')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'series name successfully destroyed.',
            ]);
        }
    }

    public function edit(Request $request, $id){
        $series = Series::find($id);

        $this->validate($request,[
            'series_name' => 'required|unique:series,series_name',
        ]);

        $series->series_name = $request->series_name;
        $series->save();
        return redirect()->route('admin.series')->with([
            'f_bg' => 'bg-warning',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'series name successfully updated.',
        ]);;	
    }
}
