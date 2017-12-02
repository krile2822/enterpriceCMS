<!DOCTYPE html>
<html>
	<head>
            <meta name="csrf-token" content="{{ csrf_token() }}">
		@include ('admin::admin.layouts.head')
	  <script type="text/javascript" src="/admin/jquery/dist/jquery.min.js"></script>

	  <!-- jQuery Core -->
	  <!-- <script src="https://code.jquery.com/jquery-2.2.4.js"
	  	integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	  <meta name="viewport" content="width=device-width, initial-scale=1"> -->

	  <!-- jQuery UI -->
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
	        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>



    	<!-- Bootstrap 3.3.7 -->
	<script src="/admin/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Bootstrap-Confirmation -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.js"></script>

		  @yield ('css')
	</head>

	<body class="hold-transition skin-blue sidebar-mini sidebar-collapse fixed">
            
            <?php $modules = CMS\admin\Module::getInstalled(); ?> 
            
		<div class="wrapper">

			@include('admin::admin.layouts.header')

			@include ('admin::admin.layouts.sidebar')

			<div class="content-wrapper">
				@yield ('content-header')
				@yield ('content')
			</div>

			<footer class="main-footer">
				@include ('admin::admin.layouts.footer')
			</footer>

		</div>
<script>
    $(function() {
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   });
</script>
{{-- jQueryValidation --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<!-- Sparkline -->
<script src="/admin/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admin/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/js/demo.js"></script>
<!-- JQueryForm -->
<script src="http://malsup.github.com/jquery.form.js"></script>
<!-- FancyTree -->
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.fancytree/2.22.4/jquery.fancytree-all.min.js"></script>
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.23.0/jquery.fancytree-all-deps.min.js">
</script>
	</body>
</html>
