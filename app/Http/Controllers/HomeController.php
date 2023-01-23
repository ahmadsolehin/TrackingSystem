<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Auth::user()->role;

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
            return view('userDashboard');
        }
    }
}
