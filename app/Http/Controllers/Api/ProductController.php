<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function getProductForPurchase(){
        $products = Product::select('products.id','products.product_name')->get();
        return response()->json($products);
    }

    public function categorywiseproduct($id){
        $categoryProduct = Product::where('category_id',$id)->get();
        return response()->json($categoryProduct);
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
        $request->validate([
            'category_id'          => 'required',
            'product_name'         => 'required|unique:products|max:255',
            'product_code'         => 'required|unique:products|max:255',
            'selling_price'        => 'required',
            'product_image'        => 'required',
            'product_quantity'     => 'required',
        ]);

        if($request->product_image){
            $position = strpos($request->product_image, ';');
            $sub = substr($request->product_image, 0 , $position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->product_image)->resize(240,200);
            $upload_path = 'backend/products/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $product = new Product();
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->selling_price = $request->selling_price;
            $product->product_quantity = $request->product_quantity;
            $product->product_image = $image_url;
            $product->root = $request->root;
            $product->save();
        }else{
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->selling_price = $request->selling_price;
            $product->product_quantity = $request->product_quantity;
            $product->product_image = "defaultImage/default.png";
            $product->root = $request->root;
            $product->save();
        }

        
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

    public function stockoutproduct()
    {
        $stockoutproduct = Product::where('product_quantity','<=','0')->orderBy('product_name')->get();
        return \response()->json($stockoutproduct);
    }
}
