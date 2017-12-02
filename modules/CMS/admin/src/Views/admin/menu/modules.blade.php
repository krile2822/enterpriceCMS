@extends ('admin::admin.layouts.master')

@section ('content')

<div class="content" style="position: relative;">
  	
    <div>
        <h2>Modules</h2>
    </div>
    
    <div id='ajax-loader'>
          <img src='/images/ajax-loader.gif'/>
      </div>

    <div class="row">
        <div id="colOne" class="col-md-3">
            <div id="banners" class="panel panel-default">	
                <div class="panel-heading">
                <h3 class="panel-title">List of Available Modules</h3>
                </div>

                <div class="panel-body">
                    <ul id="slideshow" class="list-group sortable sortable-disabled ui-sortable">
                        
                        @foreach ($modules as $module)
                            <li class="list-group-item sortable-handle ui-sortable-handle">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="cursor"  data-id="{{ $module->id }}">{{ $module->name }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>v {{ $module->version }}</p>
                                    </div>
                                    <div class="col-md-4 pull-right install-module-button">
                                        
                                        @if ($module->is_installed)
                                            <span class="label label-danger install" id="{{ $module->id }}" style="font-size:80%;">Uninstall</span>
                                        @else
                                            <span class="label label-success install" id="{{ $module->id }}" style="font-size:80%;">Install</span>
                                        @endif
                                        
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>	
        
        <div id="colTwo" class="col-md-offset-1 col-md-5 center"></div>
        
    </div>

<div class="modal fade" id="uninstall_confirm_modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id=""></h4>
                  </div>
                  <div class="modal-body">
                      <p>Some page(s) uses this module. If you delete it, the page(s) will be deleted too.
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
                      <button type="button" id="btn_delete_confirm" class="btn btn-danger">{{ trans('translate.delete') }}</button>
                  </div>
              </div>
          </div>
      </div>

</div>	<!-- end of content -->

<script>
    
    $(function() {

        var module;
        var token = '{{Session::token()}}';
       
       $(document).on('click', '.install', function() {
            $('#ajax-loader').show();
            var id = $(this).attr('id');
          
            $.ajax({
                method: 'PUT',
                url: 'install-modules/' + id,
                success: function(data) {
                    if (data['modal']) {
                        $('#uninstall_confirm_modal').modal('show');
                        module = data['modal'];
                    } else {
                        $("#colOne").load(location.href+" #colOne>*");
                        $("#sidebar").load(location.href+" #sidebar>*");
                    }
                    $('#ajax-loader').hide();
                },
                error: function (xhr, status, error) {
                    console.log(xhr + ' ' + status + ' ' + error);  
                    $('#ajax-loader').hide();
                }
            });
        });
        
        $(document).on('click', '.cursor', function() {
            var id = $(this).attr('data-id');
            url = 'get-module-information/' + id;
            $('#colTwo').load(url); 
        });
       
       $(document).on('click', '#btn_delete_confirm', function() {
        var id = module.id;
        $('#uninstall_confirm_modal').modal('hide');
        $('#ajax-loader').show();
            $.ajax({
                method: 'POST',
                url: 'uninstall/module/',
                data: {id: id, _token: token},
                success: function() {
                    $("#colOne").load(location.href+" #colOne>*");
                    $("#sidebar").load(location.href+" #sidebar>*");
                    $('#ajax-loader').hide();
                }, 
                error: function(xhr, status, error) {
                    console.log(xhr + ' ' + status + ' ' + error);  
                    $('#ajax-loader').hide();
                }
            });
       });
    });
    
</script>

@endsection 