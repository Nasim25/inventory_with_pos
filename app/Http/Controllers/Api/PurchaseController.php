<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Purchase;
use App\PurchaseDetails;
use App\VertualPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class PurchaseController extends Controller
{
    public function saveproduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'unit_price'=> 'required',
            'qty'=> 'required',
        ]);

        $oldProduct = VertualPurchase::where('product_id',$request->product_id)->first();
        if(!$oldProduct)
        {
            $data = new VertualPurchase();
            $data->product_id = $request->product_id;
            $price = $data->unit_price = $request->unit_price;
            $qty = $data->qty = $request->qty;
            $data->total = $price * $qty;
            $data->save();

            return response()->json('Done');

        }else{
            
            return response()->json('empty_product');
            
        }
        
    }

    public function getvertualproduct()
    {
        $vertualPurchase = VertualPurchase::join('products','products.id','=','vertual_purchases.product_id')
                                            ->select('vertual_purchases.*','products.product_name')
                                            ->get();
        return response()->json($vertualPurchase);
    }

    public function clearproduct()
    {
        VertualPurchase::truncate();
        return response('delete all');
    }

    public function storepurchase(Request $request)
    {
       
        $request->validate([
            'invoice_number' => 'required|unique:purchases|max:255',
            'supplier_id' => 'required',
            'date' => 'required',
        ]);

        $data = array();
        $data['user_id'] = $request->user_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['invoice_number'] = $request->invoice_number;
        $data['other'] = $request->other;
        $data['paid'] = $request->paid;
        $data['g_total'] = $request->gtotal;
        $data['due'] = $request->due;
        $data['date'] = $request->date;
        $data['payment_method'] = $request->payment_method;
        $data['posted_date'] = date('d/m/Y');

        $purchase_id = DB::table('purchases')->insertGetId($data);

        $purchases = VertualPurchase::get();

        
        $pdata = array();
        foreach($purchases as $purchase)
        {
            $pdata['purchase_id'] = $purchase_id;
            $pdata['product_id'] = $purchase->product_id;
            $pdata['unit_price'] = $purchase->unit_price;
            $pdata['qty'] = $purchase->qty;
            $pdata['total'] = $purchase->total;

            PurchaseDetails::insert($pdata);

            DB::table('products')
                    ->where('id',$purchase->product_id)
                    ->update(['product_quantity' => DB::raw('product_quantity +'.$purchase->qty)]);
        }

        DB::table('vertual_purchases')->delete();

        return response('done');
    }

    public function vproductdelete($id)
    {
        
        VertualPurchase::where('id',$id)->delete();
        return response()->json('delete successfully');
    }

    public function allPurchase(){
        $purchase = Purchase::all();
        return response()->json($purchase);
    }

    public function purchasedetails($id)
    {
        $purchases =Purchase::where('purchases.id',$id)->join('suppliers','suppliers.id','=','purchases.supplier_id')
                    ->select('purchases.*','suppliers.name')
                    ->first();
        return response()->json($purchases);
    }

    public function purchasedetailsproduct($id)
    {
        $purchasedetails = PurchaseDetails::where('purchase_details.id',$id)
                            ->join('products','products.id','=','purchase_details.id')
                            ->select('purchase_details.*','products.product_name')
                            ->get();
        return response()->json($purchasedetails);
    }
}
