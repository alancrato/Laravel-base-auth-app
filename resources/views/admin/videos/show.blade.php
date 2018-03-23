@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Serie {{$video->name}}</h3>
                @php $iconEdit = Icon::create('pencil'); @endphp
                {!! Button::primary($iconEdit)->asLinkTo(route('admin.videos.edit', ['video' => $video->id])) !!}
                @php $iconDestroy = Icon::create('remove'); @endphp
                {!! Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.videos.destroy', ['video' => $video->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
                !!}
                @php $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['admin.videos.destroy','video' => $video->id],
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]) @endphp
            {!! form($formDelete) !!}
            <br/><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{$video->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{$video->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td>{{$video->description}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Serie</th>
                        <td>{{$video->serie->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Content</th>
                        <td>{{$video->content}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Url</th>
                        <td>{{$video->url}}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection