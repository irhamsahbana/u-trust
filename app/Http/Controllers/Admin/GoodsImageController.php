<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsImage;
use App\Models\Product;
use File;

class GoodsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_images = GoodsImage::with('product')->get();
        $goods_products = Product::where('type', 'goods')->get();
        return view('admin.goods_image.index', compact('goods_images', 'goods_products'));
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
            'goods_photo' => 'required|image|max:2048',
        ]);

        $gi = new GoodsImage;
        $gi->product_id = $request->input('product_id');
        $file = $request->file('goods_photo');

        if($file != null){
            $filename = time().'_'.$file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file->move(public_path('images\products\more'), $filename);

            $gi->image_name = $filename;
        }

        $gi->save();

        return redirect()->route('goods-image.index')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Data has been store in the database.',
            'f_msg' => 'Goods image successfully added.',
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
            'goods_photo' => 'required|image|max:2048',
        ]);
        
        $gi = GoodsImage::findOrFail($id);
        $file = $request->file('goods_photo');
        $old_file = $request->input('old_goods_photo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gi = GoodsImage::findOrFail($id);

        if ($gi->delete()){
            $image_path = public_path('images\products\more'.'\\'.$gi->image_name);
            if(File::exists($image_path)) { File::delete($image_path); }
            
            return redirect()->route('goods-image.index')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'Goods image successfully destroyed.',
            ]);
        }
    }
}
