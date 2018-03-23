@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Novo Usuário')->asLinkTo(route('admin.categories.create')) !!}
        </div>
        <div class="row">
            {!! Table::withContents($categories->items())
             ->callback('Ações', function ($field,$categories){
                    $linkEdit = route('admin.categories.edit',['categories' => $categories->id]);
                    $linkShow = route('admin.categories.show',['categories' => $categories->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).' | '.
                           Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })

            !!}
        </div>
    </div>
@endsection