@extends ('master')

@section('css')
<link rel="stylesheet" type="text/css" href="/css/ga-embed.css">
@endsection

@section ('content')
<div style='margin-left:10px;'>
    <a href="{{ route ('page.create') }}" class="btn btn-success">Create new page</a>
</div>
<div class="page-content container-fluid" style="max-width: 1200px;">
    <div>
        <table class="table" style="width:85%">
            <thead>
                <tr>
                    <th>title</th>
                    <th>author</th>
                    <th>status</th>
                    <th>slug</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->title_en }}</td>
                    <td>{{ $page->author_id }}</td>
                    <td>{{ $page->online }}</td>
                    <td>{{ $page->url_en }} </td>
                    <td style="text-align:right">
                        <a style="text-decoration:none;margin:5px" href="#" class="btn btn-warning">Edit</a>
                        <a style="text-decoration:none;margin:5px" href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
