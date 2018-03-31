<?php

namespace app\Http\Controllers;

use app\Http\Requests;
use Illuminate\Http\Request;
use app\Product;
use app\User;
use app\Wishlist;
use Auth;	

class ProdutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('admin', ['except' => 'addtowishlist']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function ProductImportOption(){
	   return view('importproduct');
	}		
	 
	 
    public function ImportDiswashersProduct()
    {
		include(app_path() . '\library\simple_html_dom.php');
		// get DOM from URL or file
        $html = file_get_html('https://www.appliancesdelivered.ie/dishwashers?sort=price_asc');

        $products = array();
        $j = 0;
        
         foreach($html->find('div.search-results-product') as $e){
              $htm = str_get_html($e->outertext);
			  foreach($htm->find('div.product-image a div img') as $i){
		      $products[$j]['img'] = $i->src;
			  }
			  foreach($htm->find('div.product-description div div a img') as $i){
		      $products[$j]['brand'] = $i->src;
			  }
			  foreach($htm->find('div.product-description div div h4 a') as $i){
		      $products[$j]['link'] = $i->href;
			  $products[$j]['title'] = $i->innertext;
			  }
			  foreach($htm->find('ul.result-list-item-desc-list li') as $i){
		      $products[$j]['description'][] = $i->innertext;
			  }
			  foreach($htm->find('h5.price-previous') as $i){
		      $products[$j]['price-previous'] = $i->innertext;
			  }
			  foreach($htm->find('h3.section-title') as $i){
		      $products[$j]['section-title'] = $i->innertext;
			  }
			 $j++;
           }
		   
		   
		foreach ($products as $product)
        {
		  if(isset($product['img'])){ 
          $result[] = ['img' => $product['img'],
          'brand' => $product['brand'],
          'link' => $product['link'],
		  'title' => $product['title'],
		  'description' => implode(',' , $product['description']),
		  'price-previous' => $product['price-previous'],
		  'ptype' => 'dishwasher',
		  'section-title' => $product['section-title']]; 
         }
		}
		if(Product::insert($result)){
		 echo "<script>alert('Products Sync Successfully')</script>";
		 return redirect()->to('/importproduct');
		}
	}
		
	public function importSmallAppliances(){
	
       return response('Coming Soon.', 401);
 	
	}	

    public function addtowishlist(Request $request) {
		$pid = $request->pid;
		$item = Wishlist::where('pid', $pid)->get();
		$userid = Auth::id();
		if(count($item) < 1){
			Wishlist::create(['pid' => $pid, 'userid' => $userid]);
			die("Item get added to Wish list");
		}else{
			Wishlist::where('pid', $pid)->delete();
			die("Item has been remove from Wish list");
		}
	}		
		
}