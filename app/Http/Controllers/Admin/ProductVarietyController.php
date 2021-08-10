<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariety;
use App\Models\Product;
use App\Models\Series;
use App\Models\SeriesVariety;
use App\Models\ProductSuitability;

class ProductVarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_varieties = ProductVariety::leftJoin('products', 'products.id', '=', 'product_varieties.product_id')
        ->select('product_varieties.*', 'products.product_name', 'products.type')
        ->orderBy('products.type')
        ->orderBy('products.product_name')
        ->orderBy('product_varieties.no_part_or_material')
        ->get();
        
        $products = Product::orderBy('type')->orderBy('product_name')->get();
        return view('admin.product_variety.index', compact('product_varieties', 'products'));
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
            'product_id' => 'required',
            'no_part_or_material' => 'required|unique:product_varieties,no_part_or_material',
            'price' => 'required|numeric|min:0'
        ]);

        $prv = new ProductVariety;
        $prv->product_id = $request->input('product_id');
        $prv->no_part_or_material = $request->input('no_part_or_material');
        $prv->price = $request->input('price');
        $prv->save();

        return redirect()->route('product-variety.index')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Data has been store in the database.',
            'f_msg' => 'Product part or material successfully added.',
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
        //
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
        $this->validate($request,[
            'product_id' => 'required',
            'no_part_or_material' => 'required',
            'price' => 'required|numeric|min:0'
        ]);

        $prv = ProductVariety::findOrFail($id);
        $prv->product_id = $request->input('product_id');
        $prv->no_part_or_material = $request->input('no_part_or_material');
        $prv->price = $request->input('price');
        $prv->save();

        return redirect()->route('product-variety.index')->with([
            'f_bg' => 'bg-warning',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'Product part or material successfully updated.',
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
        $prv = ProductVariety::findOrFail($id);

        if ($prv->delete()){
            return redirect()->route('product-variety.index')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'Product part or material successfully destroyed.',
            ]);
        }
    }

    public function suitabilities($id)
    {
        $prs = ProductVariety::findOrFail($id);

        $series = Series::orderBy('series_name')->get();

        $series_varieties = SeriesVariety::leftJoin('series', 'series.id', '=', 'series_varieties.series_id')
        ->select('series_varieties.*', 'series.series_name')
        ->orderBy('series.series_name')
        ->orderBy('series_varieties.series_variety_name')
        ->get();

        // $product_suitabilities = ProductSuitability::where('product_variety_id', $prs->id)->get();
        $product_suitabilities = ProductSuitability::where('product_variety_id', $prs->id)->get();
        // dd($product_suitabilities, $product_suitabilities1);

        // dd($product_suitabilities);

        // foreach($series as $sr) {
        //     header('Content-type: text/plain');
        //     print($sr->series_name . PHP_EOL);

        //     foreach($series_varieties as $srv){
        //         if($srv->series_id == $sr->id){
        //             print($srv->series_variety_name . ' ');
        //             foreach($product_suitabilities as $v) {
        //                 $v->
        //             }
        //         }
        //     }
        //     print('-----------------------'. PHP_EOL);
        // }
        // die;
        
        
        return view('admin.product_variety.suitabilities', compact('prs', 'series', 'series_varieties', 'product_suitabilities'));
    }
}
