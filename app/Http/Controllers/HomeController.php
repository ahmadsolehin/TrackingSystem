<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;

        if($role == "Manager")
        {
            $totalUsers = User::where('role', '!=', 'Manager')->count();
            $totalSales = Sales::sum('total_sales');

            return view('backend.layouts.dashboard', ['totalUsers' => $totalUsers, 'totalSales' => $totalSales]);
        }else{
            return view('userDashboard');
        }
    }
}
