@extends ('master')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/ga-embed.css">
    
    <!-- RichTextEditor -->
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
 
@endsection

@section ('content')
<div class="container container-fluid">
    <br>
    <textarea></textarea>
    <div id='edit' style="margin-top: 30px;"></div>
    <br>
    <form action="{{ route('page.save') }}" method="POST">
        {{ csrf_field() }}
        <textarea name="editor_content" id="myEditor"></textarea>
        <button>Submit</button>
    </form>
    
</div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/js/froala_editor.pkgd.min.js"></script>
    
    <script>
        $(function() {
          $('#myEditor').froalaEditor({
            toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 
                                '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 
                                'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertTable', '|', 'emoticons', 
                                'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'spellChecker', 'help', 'html', '|', 'undo', 'redo'],  
            toolbarInline: false})
        });
    </script>
    <script> $(function() { $('textarea').froalaEditor() }); </script>
    <script>
        $ (function(){
            $('#edit').froalaEditor({
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 
                                '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 
                                'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertTable', '|', 'emoticons', 
                                'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'spellChecker', 'help', 'html', '|', 'undo', 'redo'],
                toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline']
            });
        });
</script>
@endsection