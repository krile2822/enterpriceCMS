@extends ('admin::admin.layouts.master')

@section ('css')
<link rel='stylesheet' href='//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css'>
<script src='//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'> </script>
@endsection

@section ('content')
<div class="content">
      <h2>Settings</h2>
  </div>

<div  class='container'>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Content</th>
                <th>Online</th>
                <th>Type</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
    </table>
    <button id="add_setting" data-toggle="modal" data-target="#add_modal">Add new entry</button>
</div>

{{-- editor modal --}}
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ trans('translate.change_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body">
                        <form id="update_settings" action="{{ route('update.settings') }}" method="post">
                            
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                            <label class="control-label">Name: </label>
                                <input type='text' id='name' name="name" class="form-control">
                            </div>
                            
                            <div class="form-group">
                            <label class="control-label">Content: </label>
                            <textarea class="form-control" name="content" id="content"></textarea>
                            </div>
                            
                            <div class="checkbox">
                            <label>
                                <input type='checkbox' name="is_online" id="is_online">Is online?
                            </label>    
                            </div>
                            
                            <label class="control-label">Type:</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="begin_of_head">begin_of_header</option>
                                    <option value="end_of_header">end_of_header</option>
                                    <option value="begin_of_body">begin_of_body</option>
                                    <option value="end_of_body">end_of_body</option>
                                    <option value="meta">meta</option>
                                    <option value="script">script</option>
                                    <option value="other">other</option>
                                </select>
                            
                            <input type="submit" id="hidden_submit">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.cancel') }}</button>
                    <button type="button" id="edit_settings"  class="btn btn-primary">{{ trans('translate.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of editor modal --}}
    
    {{-- add new setting --}}
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ trans('translate.change_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body box-body">
                        <form id="add" action="{{ route('add.settings') }}" method="post">
                            
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label class="control-label">Name: </label>
                                <input type='text' name="name" class="form-control">
                            </div>
                            <div class="form-group">
                            <label class="control-label">Content: </label>
                                <input type='text'name="content" class="form-control">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type='checkbox' name="is_online">Is online?
                                </label>
                            </div>
                            <label class="control-label">Type:</label>
                                <select class="form-control" name="type">
                                    <option value="begin_of_head">begin_of_header</option>
                                    <option value="end_of_header">end_of_header</option>
                                    <option value="begin_of_body">begin_of_body</option>
                                    <option value="end_of_body">end_of_body</option>
                                    <option value="meta">meta</option>
                                    <option value="script">script</option>
                                    <option value="other">other</option>
                                </select>
                            
                            <input type="submit" id="hidden_add" style="display: none">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.cancel') }}</button>
                    <button type="button" id="add_settings"  class="btn btn-primary">{{ trans('translate.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add modal --}}
    
    {{-- add new setting --}}
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ trans('translate.change_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body">
                       Are you sure do you want to delete this setting?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.cancel') }}</button>
                    <button type="button" id="delete_settings"  class="btn btn-danger">{{ trans('translate.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add modal --}}
    
    
    

<script>
$(function() {
    var token = '{{ Session::token() }}';
    
    $('#hidden_submit').hide();
    
    /* Trigger the edit form submit when the modal is "saved" */
    $('#edit_settings').on('click', function() {
        $('#hidden_submit').trigger('click');
    });
    
    /* Trigger the add form submit */
    $('#add_settings').on('click', function() {
        $('#hidden_add').trigger('click');
    });
    
    /* Add data to table */
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('get.setting.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'content', name: 'content' },
            { data: 'online', name: 'online' },
            { data: 'type', name: 'type' },
            {data: 'action', name: 'Edit', orderable: false, searchable: false },
            {data: 'delete', name: 'Delete', orderable: false, searchable: false },
        ]
    });    
    
    /* Add data to modal */
    $('#edit_modal').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).attr('data-id');
        $('#id').attr('value', id);
        
        $.ajax({
           method: 'POST',
           url: '{{ route("get.selected.settings") }}',
           data: {id: id, _token: token}
        }).done(function(msg) {
            $('#name').val(msg['name']);
            $('#content').val(msg['content']);
            $('#type').val(msg['type']);
            if (msg['is_online'] == 1 ) {
                $('#is_online').prop('checked', true);
            } else {
                $('#is_online').prop('checked', false);
            }
        });
    });
    
    $('#delete_modal').on('show.bs.modal', function(event) {
       var id = $(event.relatedTarget).attr('data-id');
       $('#delete_settings').attr('data-id', id);
    });
    
    $('#delete_settings').on('click', function() {
       var id = $(this).attr('data-id');
       
       $.ajax({
           method: 'POST',
           url: '{{ route("delete.settings") }}',
           data: {id: id, _token: token}
       }).done(function(msg) {
           if (msg['status'] == 'success') {
               $('#delete_modal').modal('hide');
               $('.modal-backdrop').remove();
               table.ajax.reload();
           }
       });
    });
    
    /* ajaxForm edit */
    var options = { 
                target:        '',   // target element(s) to be updated with server response 
                beforeSubmit:  showRequest,  // pre-submit callback 
                success:       showResponse,  // post-submit callback 
                type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
                dataType:  'json',       // 'xml', 'script', or 'json' (expected server response type) 
                clearForm: true        // clear all form fields after successful submit 

            }; 

            // bind form using 'ajaxForm' 
        $('#update_settings').ajaxForm(options); 

        // pre-submit callback 
        function showRequest(formData, jqForm, options) {
            return true; 
        } 

        // post-submit callback 
        function showResponse(responseText, statusText, xhr, $form)  { 
            if (responseText['status'] == 'success') {
                $('#edit_modal').modal('hide');
                $('.modal-backdrop').remove();
                table.ajax.reload();
            } else {
                console.log('Something went wrong.')
            }
        } 
        
        
        /* ajaxForm add */
    var options = { 
                target:        '',   // target element(s) to be updated with server response 
                beforeSubmit:  showAddRequest,  // pre-submit callback 
                success:       showAddResponse,  // post-submit callback 
                type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
                dataType:  'json',       // 'xml', 'script', or 'json' (expected server response type) 
                clearForm: true        // clear all form fields after successful submit 

            }; 

            // bind form using 'ajaxForm' 
        $('#add').ajaxForm(options); 

        // pre-submit callback 
        function showAddRequest(formData, jqForm, options) {
            return true; 
        } 

        // post-submit callback 
        function showAddResponse(responseText, statusText, xhr, $form)  { 
            if (responseText['status'] == 'success') {
                $('#add_modal').modal('hide');
                $('.modal-backdrop').remove();
                table.ajax.reload();
            } else {
                console.log('Something went wrong.')
            }
        } 
});
</script>

@endsection