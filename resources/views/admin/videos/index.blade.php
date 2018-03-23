@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Series</h3>
            {!! Button::primary('Novo Video')->asLinkTo(route('admin.videos.create')) !!}
        </div>
        <div class="row">
            {!! Table::withContents($videos->items())
             ->callback('Ações', function ($field,$videos){
                    $linkEdit = route('admin.videos.edit',['videos' => $videos->id]);
                    $linkShow = route('admin.videos.show',['videos' => $videos->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).' | '.
                           Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })

            !!}
        </div>
    </div>
@endsection