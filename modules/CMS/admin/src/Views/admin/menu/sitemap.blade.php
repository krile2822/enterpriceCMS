@extends ('admin::admin.layouts.master')

@section ('content')
<div class="content" style="position: relative">
    <h2>Sitemap</h2>
</div>

<div class='row content'>
   
    
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>Sitemap</h3>

            <p>
              <button id="sitemap" type="button" class="btn bg-purple margin" style="background-color: #3c8dbc !important">
                  <span id="create">Create new sitemap</span>
                  <img id="loader" class="hidden" src='/elementy/images/preloaders/5.gif' width='20px'>
              </button> 
            </p>
            <span id="alert" class="hidden" style="margin-left: 10px;color:#073cff">Sitemap created successfully!<i class="fa fa-check"></i></span>
          </div>
          <div class="icon">
            <i class="fa fa-sitemap"></i>
          </div>
          <a href="/sitemap.xml" class="small-box-footer" id="download">
            Download current sitemap <i class="fa fa-arrow-circle-down"></i>
          </a>
        </div>
      </div>

        
</div>

<script>
    $(function() {
        var token = '{{ Session::token() }}';
        
       // $('#sitemap').on('click', function () {
       //     $('#create').hide();
       //     $('#loader').removeClass('hidden');
       //     $.ajax({
       //        method: 'GET',
       //        url: '{{ route("generate.sitemap") }}',
       //        data: {_token: token}
       //     }).done(function(msg) {
       //         if (msg['msg'] = 'success'){
       //             $('#alert').removeClass('hidden');
       //             setTimeout(function() {
       //                 $('#alert').addClass('hidden');
       //             }, 3000);
       //              console.log('Sitemap generated successfully!');
       //         } else {
       //             console.log('Something went wrong!');
       //         }
       //      $('#create').show();
       //      $('#loader').addClass('hidden');
       //     });
       // });

      $('#sitemap').on('click', function(e) {
          e.preventDefault();
          alert('The current PHP version is not compatible with this service!');
      });
      $('#download').click( function(e) { 
          e.preventDefault();
          alert('No sitemap generated yet.');
      })
    });
</script>
@endsection
