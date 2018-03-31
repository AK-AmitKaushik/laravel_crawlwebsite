<?php

namespace app\Http\Controllers;

use app\Http\Requests;
use Illuminate\Http\Request;
use app\Product;
use app\Wishlist;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$products = Product::all();
		$userid = Auth::id();
		$wishlists = Wishlist::where('userid' , $userid)->get();
		$pid_array = array();
		
		if(count($wishlists) > 0){
		 foreach($wishlists as $wishlist){
			$pid_array[] = $wishlist->pid;
		 }
		}
		
        if(count($products) > 0){
		    return view('home', ['products' => $products, 'wishlists' => $pid_array]);
		}else{
			return view('welcome');
		}
    }
}
