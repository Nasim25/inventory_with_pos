<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Purchase;
use App\PurchaseDetails;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getpurchaseproductbyid(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $product_id = $request->id;

        $product = PurchaseDetails::where('product_id',$product_id)
                                ->join('purchases','purchases.id','=','purchase_details.purchase_id')
                                ->join('products','products.id','=','purchase_details.product_id')
                                ->select('purchase_details.*','products.product_name','products.selling_price','purchases.invoice_number','purchases.date')
                                ->orderBy('id', 'DESC')
                                ->get();

        return response()->json($product);
    }

    public function dailyPurchaseReport()
    {
        $today = date('Y-m-d');
        $purchase = Purchase::where('date',$today)
                            ->join('suppliers','suppliers.id','purchases.supplier_id')
                            ->select('purchases.*','suppliers.name')
                            ->get();
        return response()->json($purchase);
    }
}
