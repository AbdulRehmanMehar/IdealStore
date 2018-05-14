<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Product;
use App\Order;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('preventBackHistory');
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = [
        'categories' => Category::all(),
        'products' => Product::all(),
        'orders' => Order::where('buyer_email', Auth::user()->email)->get()
      ];
      return view('client.home')->with($data);
    }

    public function updateProfile(Request $request){
      Auth::user()->name = $request->input('u_username');
      Auth::user()->address = $request->input('u_address');
      Auth::user()->phone = $request->input('u_phone');
      Auth::user()->save();
      return redirect('/home');
    }
}
