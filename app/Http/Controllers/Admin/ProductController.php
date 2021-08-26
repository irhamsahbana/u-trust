<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\GoodsImage;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('type')->orderBy('product_name')->get();
        return view('admin.product.index', compact('product'));
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
            'product_name' => 'required|unique:products,product_name',
            'type' => 'required',
            'yt_video_id' => 'required_if:type,service',
            'goods_photo' => 'required_if:type,goods|image|max:2048',
            'description' => 'required_if:type,goods'

        ]);

        $pr = new Product;
        $pr->product_name = $request->input('product_name');
        $pr->type = $request->input('type');
        $pr->yt_video_id = $request->input('yt_video_id');

        $file = $request->file('goods_photo');
        if($file != null){
            $filename = time().'_'.$file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file->move(public_path('images\products'), $filename);

            $pr->filename = $filename;
            $pr->description = $request->input('description');
        }

        $pr->save();
        //another way to store data into database
        //Product::create($request->all());

        return redirect()->route('product.index')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Data has been store in the database.',
            'f_msg' => 'Product successfully added.',
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
            'product_name' => 'required',
            'type' => 'required',
            'yt_video_id' => 'required_if:type,service',
            'goods_photo' => 'image|max:2048',
            'description' => 'required_if:type,goods'
        ]);

        $pr = Product::findOrFail($id);
        $pr->product_name = $request->input('product_name');
        $pr->type = $request->input('type');

        $pr->yt_video_id = $request->input('yt_video_id');
        $file = $request->file('goods_photo');
        $old_file = $request->input('old_goods_photo');
        
        if($file != null){
            $image_path = public_path('images\products'.'\\'.$old_file );

            if(File::exists($image_path)) { File::delete($image_path); }
            $filename = time().'_'.$file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file->move(public_path('images\products'), $filename);
            $pr->filename = $filename;
        }

        $pr->description = $request->input('description');
        $pr->save();

        return redirect()->route('product.index')->with([
            'f_bg' => 'bg-warning',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'Product successfully updated.',
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
        $product = Product::findOrFail($id);
        $goods_product_image = GoodsImage::where('product_id', $id)->get();

        if ($product->delete()){

            $image_path = public_path('images\products'.'\\'.$product->filename);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            //delete the images stored in your filesystem one by one 
            foreach($goods_product_image as $gpi){
                $goods_image_path = public_path('\images\products\more'.'\\'.$gpi->image_name);
                if(File::exists($goods_image_path)) {
                    File::delete($goods_image_path);
                }
            }
        
            return redirect()->route('product.index')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Data has been destroy from the database.',
                'f_msg' => 'Product successfully destroyed.',
            ]);
        }
    }
}
