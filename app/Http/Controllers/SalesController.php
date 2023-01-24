<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function view($userId)
    {
        dd($userId);
    }
    public function getSales($id)
    {
        $sale = Sales::find($id);
        return response()->json($sale);
    }
    public function create(Request $request)
    {
        $userId = Auth::user()->id;

        $sale = new Sales();
        $sale->user_id = $userId;
        $sale->total_sales = $request->totalSales;
        $sale->sale_date = $request->saleDate;
        $sale->save();
        return response()->json(['success' => true]);
    }
}
