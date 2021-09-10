<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariety;
use App\Models\Product;
use App\Models\Series;
use App\Models\SeriesVariety;
use App\Models\ProductSuitability;
use App\Models\GoodsImage;
use App\Models\ServiceState;
use DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::all();
        return view('admin.service.index', compact('series'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $series = Series::findOrFail($id);
        $product_variety = ProductVariety::all();
        $product = Product::orderBy('type')->orderBy('id')->get();
        $goods_image = GoodsImage::all();
        $service_state = ServiceState::where(['user_id' => \Auth::user()->id, 'series_id' => $id])->get()->toArray();
        $service_state = collect($service_state);

        return view('admin.service.show', compact('series','product_variety', 'product', 'goods_image', 'service_state'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_invoice()
    {
        return view('admin.service.print-invoice');
    }

    public function save_state(Request $request , $user_id, $series_id)
    {
        DB::beginTransaction();
        ServiceState::where(['user_id' => $user_id, 'series_id' => $series_id])->delete();
        $total = count($request->product_variety_id);

        try {

            for($i=0; $i < $total; $i++){
                $item = $request->product_variety_id[$i];
                if($item != 0) {
                    $prv_id = (int) substr($item, strpos($item, "bridge") + 6);
                    
                    $state = ServiceState::Create(
                        ['user_id' => $user_id, 'series_id' => $series_id, 'product_variety_id' => $prv_id]
                    );
                }
            }

            DB::commit();

            return redirect()->route('service.show', $series_id)->with([
                'f_bg' => 'bg-success',
                'f_title' => 'Data has been store in the database.',
                'f_msg' => 'Service State successfully saved.',
            ]);

        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();

            return redirect()->route('service.show', $series_id)->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'Product part or material suitability successfully destroyed.',
            ]);
        }

    }
}
