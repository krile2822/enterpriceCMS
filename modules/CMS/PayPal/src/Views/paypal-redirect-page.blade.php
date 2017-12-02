@extends('front::elementy.master')

@section('page')
<div class="container p-160-cont">
	<div class="text-center" >
		<h1 class="error404-numb2">Thank You!</h1>
		@if (Session::has('message'))
			<h3 class="error404-text2">{{Session::get('message')}}</h3>
		@endif
		<a class="button medium rounded gray" href="/home">BACK TO HOMEPAGE</a>
	</div>
</div>

@endsection