@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Serie {{$series->name}}</h3>
                @php $iconEdit = Icon::create('pencil'); @endphp
                {!! Button::primary($iconEdit)->asLinkTo(route('admin.series.edit', ['series' => $series->id])) !!}
                @php $iconDestroy = Icon::create('remove'); @endphp
                {!! Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.series.destroy', ['series' => $series->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
                !!}
                @php $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['admin.series.destroy','series' => $series->id],
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]) @endphp
            {!! form($formDelete) !!}
            <br/><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{$series->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{$series->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td>{{$series->description}}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection