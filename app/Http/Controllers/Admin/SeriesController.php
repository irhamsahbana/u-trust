<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;
use File;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::orderBy('series_name')->get();
        return view('admin.series.index', compact('series'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'series_name' => 'required|unique:series,series_name',
            'series_photo' => 'required|image|max:2048',
        ]);


        $srs = new Series;
        $srs->series_name = $request->input('series_name');
        $file = $request->file('series_photo');
        if($file != null){
            $filename = time().'_'.$file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file->move(public_path('images\series'), $filename);

            $srs->filename = $filename;
        }
        $srs->save();

        return redirect()->route('admin.series')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Data has been store in the database.',
            'f_msg' => 'Series successfully added.',
        ]);
    }

    public function destroy($id)
    {
        $series = Series::findOrFail($id);

        if ($series->delete()){
            $image_path = public_path('images\series'.'\\'.$series->filename);
            if(File::exists($image_path)) { File::delete($image_path); }

            return redirect()->route('admin.series')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'Series successfully destroyed.',
            ]);
        }
    }

    public function edit(Request $request, $id){
        $series = Series::find($id);

        $this->validate($request,[
            'series_name' => 'required',
            'series_photo' => 'required|image|max:2048',
        ]);

        $series->series_name = $request->series_name;
        $file = $request->file('series_photo');
        $old_file = $request->input('old_series_photo');
        
        if($file != null){
            $image_path = public_path('images\series'.'\\'.$old_file );

            if(File::exists($image_path)) { File::delete($image_path); }
            $filename = time().'_'.$file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file->move(public_path('images\series'), $filename);
            $series->filename = $filename;
        }
        $series->save();
        return redirect()->route('admin.series')->with([
            'f_bg' => 'bg-warning',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'Series successfully updated.',
        ]);
    }
}
