<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Auth::user()->role;
        $userId = Auth::user()->id;

        if($role == "Manager")
        {
            $totalUsers = User::where('role', '!=', 'Manager')->count();

            $totalSales = Sales::whereHas('user', function($query) {
                $query->where('role', '!=', 'Manager');
            })->sum('total_sales');
            
            $users = User::where('role', '!=', 'Manager')->get();
            $userSales = [];
            foreach ($users as $user) {
                $userSales[$user->id] = Sales::where('user_id', $user->id)->sum('total_sales');
            }            

            return view('backend.layouts.dashboard', 
            [
                'totalUsers' => $totalUsers, 
                'totalSales' => $totalSales, 
                'userSales' => $userSales,
                'users'=>$users,
            ]);

        }else{
            $days = array();
            $prices = array();

            $salesData = Sales::where('user_id',$userId)->get();
            
            $sales = Sales::select(DB::raw("DATE_FORMAT(sale_date, '%d') as day"),
            DB::raw("SUM(total_sales) as total_sales"))
            ->where('user_id', $userId)
            ->groupBy('day')
            ->orderByRaw("DATE_FORMAT(sale_date, '%d')")
            ->get();
            
            foreach($sales as $sale) {
                $days[] = $sale->day;
                $prices[] = $sale->total_sales;
            }
            
            return view('userDashboard',
            [
                'labels' => $days, 
                'prices' => $prices,
                'sales'=>$salesData,
            ]);
            
        }
    }
}
