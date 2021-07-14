<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Pos;
use App\Sell;
use App\Product;
use App\SellDetails;

class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {
        $product = Product::where('id',$id)->first();

        $check = Pos::where('product_id',$id)->first();
        if($check){
                if($product->product_quantity > $check->product_qty){

                    Pos::where('product_id',$id)->increment('product_qty');

                    $product  = Pos::where('product_id',$id)->first();
                    $subtotal = $product->product_qty * $product->product_price;
                    Pos::where('product_id',$id)->update(['sub_total'=>$subtotal]);
                }else{
                    return response()->json('empty_product');
                }
                
        }else{
            $data = array();
            $data['product_id'] = $id;
            $data['product_name'] = $product->product_name;
            $data['product_qty'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;
            Pos::create($data);
        }
        

    }

    public function getCartProduct()
    {
        $cartProducts = Pos::all();
        return response()->json($cartProducts);
    }

    public function removeCart($id)
    {
        Pos::where('id',$id)->delete();
    }

    public function increment($id)
    {
        Pos::where('id',$id)->increment('product_qty');
        $product  = Pos::where('id',$id)->first();
        $subtotal = $product->product_qty * $product->product_price;
        Pos::where('id',$id)->update(['sub_total'=>$subtotal]);

        return response('Done');
        
    }
    
    public function decrement($id)
    {
        $check = Pos::where('id',$id)->first();
        if($check->product_qty >=1)
        {
            Pos::where('id',$id)->decrement('product_qty');
            $product  = Pos::where('id',$id)->first();
            $subtotal = $product->product_qty * $product->product_price;
            Pos::where('id',$id)->update(['sub_total'=>$subtotal]);

            return response('Done');
        }else{
            return response('Product already Empty');
        }
        
        
    }

    public function orderdone(Request $request)
    {
        

        $data = array();

        $customer = Customer::where('customer_phone',$request->customers)->first();
        if($customer)
        {
            $data['customer_id'] = $customer->id;
        }else{

            $cusdata = array();
            $cusdata['customer_phone'] = $request->customers;
            $customer_id = DB::table('customers')->insertGetId($cusdata);
            $data['customer_id'] = $customer_id;
        }
        
        $data['qty'] = $request->qty;
        $data['subtotal'] = $request->subtotal;
        $data['vat'] = $request->vat;
        $data['total'] = $request->Total;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['payby'] = $request->payby;
        $data['sell_date'] = date('d/m/Y');
        $data['user_id'] = $request->user_id;

        $sell_id = DB::table('sells')->insertGetId($data);

        $contents = Pos::get();

        $odata = array();
        foreach($contents as $content)
        {
            $odata['sales_id'] = $sell_id;
            $odata['product_id'] = $content->product_id;
            $odata['product_qty'] = $content->product_qty;
            $odata['product_price'] = $content->product_price;
            $odata['sub_total'] = $content->sub_total;

            SellDetails::insert($odata);

            DB::table('products')
                    ->where('id',$content->id)
                    ->update(['product_quantity' => DB::raw('product_quantity -'.$content->product_qty)]);
        }

        DB::table('pos')->delete();

        return response('done');


    }

    public function salesList()
    {
        $sales = Sell::join('customers','customers.id','=','sells.customer_id')
        ->select('sells.*','customers.customer_phone')
        ->get();

        return response()->json($sales);
    }

    public function salesDetails($id)
    {
        $salesDetails = Sell::join('customers','customers.id','=','sells.customer_id')
                        ->where('sells.id',$id)
                        ->select('sells.*','customers.customer_name','customers.customer_phone','customers.customer_address')
                        ->first();

        return response()->json($salesDetails);
    }

    public function salesDetailsall($id)
    {
        $salesDetailsall = SellDetails::where('sales_id',$id)
                                        ->join('products','products.id','=','sell_details.product_id')
                                        ->select('sell_details.*','products.*')
                                        ->get();

        return response()->json($salesDetailsall);
    }
}
