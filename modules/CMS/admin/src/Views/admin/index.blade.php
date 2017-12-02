@extends('admin::admin.layouts.master')

@section('css')
<script src="//cdn.jsdelivr.net/jquery.ui-contextmenu/1/jquery.ui-contextmenu.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="//malsup.github.com/jquery.form.js"></script>
@endsection

@section('content-header')

@endsection

@section ('content')

<div class="content">
    <h2>{{ trans('translate.pages') }}</h2>
</div>

<div class="page-content container-fluid">
    <div class='row'>
        @if (session('status'))
        <div class="row">
            <div class="col-md-offset-5 col-md-2 ">
                <div class="alert alert-success" id="status" style='text-align: center!important;'>
                    <span>{{ session('status') }}</span>
                </div>
            </div>
        </div>
        @endif
        <div id='tree-container' class="col-md-3">
             <!-- style='border: 1px solid #dcdcdc;overflow:hidden;' -->
            <div class="panel panel-default">

                <div class="panel-heading">
                <!-- <h3 class="panel-title"></h3> -->
                <button id='new_page' type='submit' class="btn btn-primary btn-xs">{{ trans('translate.new_page') }}</button>
                </div>
                <div class="panel-body">
                    <div id="tree2" data-source="ajax" style="outline:none !important">
                        <!-- <button id='new_page' type='submit' sty;>{{ trans('translate.new_page') }}</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="response" class=' col-md-9'>
        </div>
        @include ('admin::admin.includes.message-block')
    </div>
</div>

@endsection

<script>


window.onload = function () {


    $(document).on('submit', '#create_page', function (event) {
        $('#create_page').validate();
    });

    $('#new_page').on('click', function (event) {
        event.preventDefault();
        $("#response").load("{{ route('create.page') }}");
    });

    if("{{ session('status') }}") {
        setTimeout(function() {
            $('#status').hide();
        }, 2500);
    }

    var token = '{{ Session::token() }}';

    $('#tree2').fancytree({
        source: {
            url: "{{ route('get.data')}}",
            cache: false
        },
        extensions: ["dnd", "edit", "persist"],
        activate: function (event, data) {
            var type;
            if (data.node.isFolder()) {
                type = 'page';
            } else {
                type = 'article';
            }
            var node_key = data.node['key'];
            var parent = data.node.parent['key'];
            $("#response").load("{{ route('get.page.from.tree') }}", {id: node_key, type: type, _token: token, parent: parent});
        },
        select: function(event, data) {

            var node_key = data.node['key'];
            var parent = data.node.parent['key'];

            if (data.node.isFolder()) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('page.online') }}",
                    data: {id: node_key, _token: token}
                }).done(function(msg){
                    if (msg['message'] == 'OK') {
                        console.log('page online');
                    }
                });

            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('article.publish') }}",
                    data: {id: node_key, parent: parent, _token: token}
                }).done(function(msg){
                    if (msg['message'] == 'OK') {
                        console.log('article published');
                    }
                });

            }
        },
        activeVisible: true, // Make sure, active nodes are visible (expanded).
        aria: false, // Enable WAI-ARIA support.
        autoActivate: false, // Automatically activate a node when it is focused (using keys).
        autoCollapse: false, // Automatically collapse all siblings, when a node is expanded.
        autoScroll: true, // Automatically scroll nodes into visible area.
        clickFolderMode: 1, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
        checkbox: true, // Show checkboxes.
        debugLevel: 2, // 0:quiet, 1:normal, 2:debug

        generateIds: true, // Generate id attributes like <span id='fancytree-id-KEY'>
        idPrefix: "", // Used to generate node id´s like <span id='fancytree-id-<key>'>.
        icon: true, // Display node icons.
        keyboard: true, // Support keyboard navigation.
        keyPathSeparator: "/", // Used by node.getKeyPath() and tree.loadKeyPath().
        minExpandLevel: 1, // 1: root node is not collapsible
        selectMode: 2, // 1:single, 2:multi, 3:multi-hier

        titlesTabbable: false, // Node titles can receive keyboard focus
        //persist: false,
        persist: {
            overrideSource: true,
            expandLazy: false,
            // overrideSource: false, // true: cookie takes precedence over `source` data attributes.
            store: "cookie" // 'cookie', 'local': use localStore, 'session': sessionStore
        },
        filter: {
            autoApply: true,
            autoExpand: true,
            mode: "hide"
        },
        childcounter: {
            deep: true,
            hideZeros: true,
            hideExpanded: true
        },
        dnd: {
            preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
            preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
            autoExpandMS: 400,
            draggable: {
                //zIndex: 1000,
                // appendTo: "body",
                // helper: "clone",
                scroll: false,
                revert: "invalid"
            },
            dragStart: function (node, data) {
                return true;
            },
            dragEnter: function (node, data) {
                if (node.parent.key == data.otherNode.parent.key) {
                    return ["before", "after"];
                }
                if (node.parent !== data.otherNode.parent)
                    return false;
                if (node.isFolder() & data.otherNode.isFolder()) {
                    return ["before", "after"];
                }
            },
            dragOver: function (node, data) {
                //return false;
            },
            dragDrop: function (node, data) {
                /** This function MUST be defined to enable dropping of items on the tree.             */
                data.otherNode.moveTo(node, data.hitMode);
                console.log('dragDrop');
                data.otherNode.moveTo(node, data.hitMode);
                if (node.parent !== data.otherNode.parent) {
                    console.log('EEEEEEEEEEERrror');
                } else {
                    console.log('drop');
                    if (node.isFolder()) {

                        /*  PAGE ORDERING  */

                        var tree = $('#tree2').fancytree('getTree');
                        var root = tree.getRootNode();
                        var nodes = root.children;
                        var array = [];
                        for (var i = 0; i <= nodes.length-1; i++) {
                           array[i] = nodes[i]['key'];
                        }
                        $.ajax({
                            method: "POST",
                            url: "{{route('page.ordering')}}",
                            data: {array: array, _token: token}
                        }).done(function(msg) {
                            console.log(msg['order']);
                        });
                    } else {

                        /*  ARTICLE ORDERING  */

                        var nodes = data.node.parent.children;
                        var array = [];
                        for (var i = 0; i <= nodes.length-1; i++) {
                           array[i] = nodes[i]['key'];
                        }
                        $.ajax({
                            method: "POST",
                            url: "{{route('article.ordering')}}",
                            data: {array: array, _token: token}
                        }).done(function(msg) {
                            console.log(msg['order']);
                        });
                    }
                }
            }
        }
    });

    $("#tree2").contextmenu({
        delegate: "span.fancytree-title",
        menu: [
            {title: "New page", cmd: "new_page", uiIcon: "ui-icon-folder-collapsed"},
            {title: "New article", cmd: "new_article", uiIcon: "ui-icon-document"},
            //{title: "duplicate_article", cmd: "duplicate_article", uiIcon: "ui-icon-newwin"},
        ],
        beforeOpen: function (event, ui) {
            var node = $.ui.fancytree.getNode(ui.target);
            //      node.setFocus();      //  node.setActive();
            var $menu = ui.menu,
                    $target = ui.target,
                    extraData = ui.extraData; // optionally passed when menu was opened by call to open()
            // Optionally return false, to prevent opening the menu
            if (node.isFolder()) {
                $("#tree2").contextmenu("enableEntry", "new_page", true);
                //$("#tree2").contextmenu("enableEntry", "duplicate_article", false);
            } else {
                //return false;
                $("#tree2").contextmenu("enableEntry", "new_page", false);
                //$("#tree2").contextmenu("enableEntry", "duplicate_article", true);
            }
        },
        select: function (event, ui) {
            var node = $.ui.fancytree.getNode(ui.target);
            node.setActive(true);
            //   node.setFocus(false);
            //console.log('menu select '+node.key);
            //   nodedata = node;
            //  alert("select " + ui.cmd + " on " + node);
            switch (ui.cmd) {
                case "new_page":
                    $("#response").load("{{ route('create.page') }}");
                    break;

                case "new_article":
                    if (node.isFolder()) {
                        var id = node.key;
                    } else {
                        var id = node.parent.key;
                    }
                    $("#response").load("{{ route('create.article') }} ", {id: id, _token: token});
                    break;

                // case "duplicate_article":
                //     console.log('duplicate');
                //     break;

                default:
                    console.log('default select');
            }
        }
    });
};
</script>
