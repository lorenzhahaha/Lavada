@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css/freelancer.css') }}">

@section('content')

<div class="container margin-form">
	<div class="row">
		<h1> Product Items </h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th> Product Picture </th>
					<th> Product ID </th>
					<th> Product Name </th>
					<th> Product Quantity </th>
					<th> Product Price </th>
					<th> &nbsp; </th>
				</tr>
			</thead>
			<tbody>		
	
			<div class="alert">
				@if(session()->has('goingCart.level'))
	                <div class="alert alert-{{ session('goingCart.level') }}"> 
	                {{ $product_name }} {!! session('goingCart.content') !!}
	                </div>
	            @endif
            </div>
        	 <script>
	        	setTimeout(function(){
		            $('.alert').slideUp('slow');
			    }, 4000);
            </script>

				@foreach ($products as $product)
				<tr>
					<td> <img src="{{ asset($product -> product_picture) }}"> </td>
					<td> {{ $product -> product_id }} </td>
					<td> {{ $product -> product_name }} </td>
					<td> {{ $product -> product_quantity }} </td>
					<td> ${{ $product -> product_price }} </td>
					<td>
						<form action="/process-cart" method="post" accept-charset="utf-8">
						{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $product -> product_id }}">
							<input type="hidden" name="product_name" value="{{ $product -> product_name }}">
							<input type="hidden" name="product_price" value="{{ $product -> product_price }}">
							<input type="hidden" name="product_picture" value="{{ $product -> product_picture }}">
							<input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
							<button type="submit"> Add to Cart </button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<form action="/show-cart" method="get" accept-charset="utf-8">
        {{ csrf_field() }}
            <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
            <button type="submit"> Show Cart </button>
        </form>
        <h3> {{ $showCount }} </h3>
	</div>
</div>



@endsection