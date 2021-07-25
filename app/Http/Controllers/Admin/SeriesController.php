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
    		'series_name' => 'required',
    	]);

    	$srs = new Series;
    	$srs->series_name = $request->input('series_name');
    	$srs->save();

    	return redirect()->route('admin.series');
    }

	public function destroy($id)
	{
		$series = Series::findOrFail($id);

		if ($series->delete()){
			return redirect()->route('admin.series');
		}
	}

	public function edit(Request $request,$id){
        $update_barang = Series::find($id);
        $update_barang->series_name = $request->series_name;
        $update_barang->save();
		return redirect()->route('admin.series');	
	}
}
