@extends ('front::elementy.master')

@section ('static_media')
<!-- STATIC MEDIA IMAGE -->
        <div class="sm-img-bg" style="background-image: url(/elementy/images/concept.jpg)">
          <div class="container sm-content-cont text-center">
            <div class="sm-cont-middle">

            </div>
          </div>
        </div>  

@endsection

@section('page')
	<?php ?>
	@foreach ($page_articles as $article)
		@include ('front::elementy.articles.' . $article->view)
	@endforeach

@endsection