<?php
// example of how to use basic selector to retrieve HTML contents
require('simple_html_dom.php');
 
// get DOM from URL or file
$html = file_get_html('https://www.appliancesdelivered.ie/dishwashers?sort=price_asc');

$products = array();
$j = 0;
// find all span tags with class=gb1
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
			 /*
			 foreach($htm->find('img') as $i){
		      $products['img'] = $htm->src;
			 }
			 foreach($htm->find('img') as $i){
		      $products['img'] = $htm->src;
			 } */
			 $j++;
   }
   
   echo "<pre>";
   print_r($products);
   echo "</pre>";
   die();
   
?>