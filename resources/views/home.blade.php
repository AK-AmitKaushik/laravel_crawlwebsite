@extends('layouts.app')

@section('content')

<script>
	 jQuery(document).ready(function(){
		 jQuery(".addtowishlist").click(function(){
			 var pid = jQuery(this).attr("pid");
			 jQuery.ajax({
				 url : '/MyFavouriteAppliances/addtowishlist',
				 data : {'pid' : pid},
				 async : true,
				 success : function(response){
					 alert(response);
					 if(response == "Item get added to Wish list"){
						 
						 jQuery("#"+pid).text("Remove item from Wishlist");
						 jQuery("#"+pid).css('background-color', 'red');
					 }
					 else{
						 jQuery("#"+pid).text("Add to Wish list");
						 jQuery("#"+pid).css('background-color', '#5bc0de');
					 }
					},
				 error : function(response){
					 alert(response);
				}
			 })
			 return false;
		   })
	 })
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dish Washers</div>

                <div class="panel-body">
				    @foreach($products as $p)
                    <div class="row">
                                 <div class="col-md-4">
					              <img src = "{{$p->img}}">
								 </div>
                                 <div class="col-md-4">
					              <img src = "{{$p->brand}}"><br/><br/>
								  <span> {{$p->title}} </span><br/><br/>
								  <span> {{$p->description}} </span>
								 </div>
								 <div class="col-md-4">
					              <h5><strike><?php echo $p->{'price-previous'}; ?></strike><h5>
								  <h3><?php echo $p->{'section-title'}; ?></h3><br/><br/>
								  <a href="{{$p->link}}" class="btn btn-info" role="button">BUY</a>
								   @if (in_array($p->pid, $wishlists))
                                     <a style="background-color : red" href="#" id = "{{$p->pid}}" pid = "{{$p->pid}}" class="btn btn-info addtowishlist" role="button">Remove item from Wish list</a>
                                   @else
									 <a href="#" id = "{{$p->pid}}" pid = "{{$p->pid}}" class="btn btn-info addtowishlist" role="button">Add To Wish list</a>
								   @endif
								 </div>
                    </div>
					@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
