@extends('layouts.cart')

<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css/freelancer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css/w3.css') }}">
<style type="text/css" media="screen">
	.margin-top {
		margin: 50px;
	}

	.margin-form {
		margin-top: 150px !important;
	}

	.background {
		padding: 0px 30px 10px 30px;
		border: 5px solid #2C3E50;
		border-radius: 30px;
		margin-top: 20px !important;
	}

	.option:hover {
	  	background-color: #f0ad4e !important;
	  	border-color: #eea236 !important;
	  	color: #fff !important;
	}

	.overflow {
		overflow: hidden;
		margin-top: 30px;
	}

</style>

@section('content')

{{-- @if(session()->has('removeInCart.content'))
    <script> alert("{{ $product_name }} {!! session('removeInCart.content') !!}");</script>
@endif
@if(session()->has('editQuantity.content'))
    <script> alert("{{ $product_name }} {!! session('editQuantity.content') !!}");</script>
@endif --}}

<div class="container">
    <div class="row margin-form">
    	<div class="col-lg-12 text-center">
        	<h1> CART ITEMS </h1>
        	<hr class="star-primary">
    	</div>
    </div>

@if($count_cart != 0)
    <?php
    	$x = 1;
    ?>
    <div class="w3-center">
		<div class="w3-section">
			<button class="btn btn-secondary option" onclick="plusDivs(-1)">&#10094; Prev</button>
			<button class="btn btn-secondary option" onclick="plusDivs(1)">Next &#10095;</button>
		</div>

		@foreach ($carts as $cart)
			<button class="btn btn-secondary choices" onclick="currentDiv({{ $x }})">{{ $x }}</button>
			<?php
				$x++;
			?>
		@endforeach
	</div>

	<?php $total_price = 0; ?>
	@foreach ($carts as $cart)
		<?php
			$each_price = $cart -> product_price * $cart -> product_quantity;
			$total_price += $each_price;
		?>
	@endforeach
	<div class="row">
		<div class="col-md-12" style="text-align: center;">
			<h3> TOTAL AMOUNT:
				<i>$<?php echo $total_price; ?></i><br>
			</h3>
			<!-- PAYPAL PAYMENT -->
		    <?php  $cart_products_number = 0; ?>
		    <form>
		        <input type="hidden" name="cmd" value="_cart">
		        <input type="hidden" name="upload" value="1">
		        <!-- The value property holds the business email -->
		        <input type="hidden" name="business" value="lorenzflorentino19@gmail.com">

		        <!-- PRODUCT INFO -->
		        @foreach ($carts as $cart)
		            <?php $cart_products_number ++; ?>
		            <input type="hidden" name="item_name_{{ $cart_products_number }}" value="{{ $cart -> product_name }}">
		            <input type="hidden" name="item_number_{{ $cart_products_number }}" value="{{ $cart -> product_id }}">
		            <input type="hidden" name="amount_{{ $cart_products_number }}" value="{{ $cart -> product_price }}">
		            <input type="hidden" name="quantity_{{ $cart_products_number }}" value="{{ $cart -> product_quantity }}">

		            <!-- SURCHARGES -->
		            <input type="hidden" name="shipping_{{ $cart_products_number }}" value="1.75">
		            <input type="hidden" name="tax_{{ $cart_products_number }}" value="0.12">

		            <input type="hidden" name="return" id="cancel_return" value="http://lavada.shop/home">
		            <input type="hidden" name="cancel_return" id="cancel_return" value="http://lavada.shop/home">
		        @endforeach

		        <!-- To implement in live, remove 'sandbox'. -->
		        <input name="submit" formaction="https://www.sandbox.paypal.com/cgi-bin/webscr" type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/gold-pill-paypalcheckout-34px.png">
		    </form>
		</div>
	</div>

	<?php $quantity_based_price = 0; ?>
	<?php $x=1; ?>
    @foreach($carts as $cart)
	    <section class="background mySlides">
		    <div class="row margin-top">
		    	<div class="col-md-11"></div>
		    	<div class="col-md-1 ml-auto">
					<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmation{{$x}}">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>

				<img src="{{ asset($cart -> product_picture) }}" class="col-md-6">
				<div class="col-md-6">
					<h2> {{ $cart -> product_name }} &nbsp; </h2><br>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p><hr>
					<form action="/add-quantity" method="post" accept-charset="utf-8">
		  			{{ csrf_field() }}
						<div class="input-group col-md-7">
			  				<span class="input-group-addon"> Number of Quantities </span>

			  				<input type="number" min="0" class="form-control size" name="product_quantity" value="{{ $cart -> product_quantity }}">
			  				<span class="input-group-btn">
			  					<input type="hidden" name="customer_id" value="{{ Auth::user()->id  }}">
			  					<input type="hidden" name="product_id" value="{{ $cart -> product_id }}">
			    				<button class="btn btn-warning" type="submit"> UPDATE </button>
			      			</span>
						</div>
					</form><br>
					<table class="table">
						<thead>
							<tr>
								<th><h3 align="center"> ORIGINAL PRICE </h3></th>
								<th><h3 align="center"> QUANTITY-BASED PRICE </h3></th>
							</tr>
						</thead>
						<tbody align="center">
							<tr>
								<td> ${{ $cart -> product_price }} </td>
								<td> $
									<?php
										$product_price = $cart -> product_price;
										$product_quantity = $cart -> product_quantity;

										$each_price = $product_price * $product_quantity;
										echo $each_price;
										$quantity_based_price += $each_price;
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<?php $x++; ?>
	@endforeach

	<!-- MODALS -->
	<?php $y=1; ?>
	@foreach ($carts as $cart)
	<div class="modal fade" id="confirmation{{$y}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"> Delete Confirmation
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<div class="modal-body">
					Are you sure you want to remove this {{ $cart -> product_name }} to cart?
				</div>
				<div class="modal-footer">
					<form action="/remove-cart" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
						<input type="hidden" name="product_id" value="{{ $cart -> product_id }}">
						<input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp; No</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp; Yes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    <?php $y++; ?>
	@endforeach

	<br>
	<div class="w3-center">
		<div class="w3-section">
			<button class="btn btn-secondary option" onclick="plusDivs(-1)">&#10094; Prev</button>
			<button class="btn btn-secondary option" onclick="plusDivs(1)">Next &#10095;</button>
		</div>
	</div>

@else

<div class="overflow">
	<div class="row">
		<span class="col-md-1"></span>
		<img src="{{ asset('empty-cart.jpg') }}" class="col-md-5">
		<div style="line-height: .8; margin-top: 130px !important;">
			<font style="font-size: 70; margin-top: 300px !important;"> ERROR 404 </font>
			<font style="font-size: 20; display: block;"> &nbsp;EMPTY CART FOUND <i class="fa fa-times"></i></font>
			<a style="margin-top: 50px; font-size: 30;" href="/home" type="button" class="btn btn-warning col-md-2"> SHOP NOW </a>
		</div>
	</div>
</div>


@endif
</div>



<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
	showDivs(slideIndex += n);
}

function currentDiv(n) {
	showDivs(slideIndex = n);
}

function showDivs(n) {
var i;
var x = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("choices");
	if (n > x.length) {slideIndex = 1}
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" btn btn-warning", "");
}
	x[slideIndex-1].style.display = "block";
	dots[slideIndex-1].className += " btn btn-warning";
}
</script>

@endsection
