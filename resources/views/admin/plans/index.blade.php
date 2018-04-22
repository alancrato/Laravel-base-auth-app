@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de Planos</h3>
            {!! Button::primary('Novo Plano')->asLinkTo(route('admin.plans.create')) !!}
        </div>

        <div class="row"></div>

        <div class="row">

                {!! Table::withContents($plans->items())->striped()
                ->callback('Ações', function($field, $plans){
                    $linkEdit = route('admin.plans.edit', ['user' => $plans->id]);
                    $linkShow = route('admin.plans.show', ['user' => $plans->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                    Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })
             !!}
        </div>

        {!! $plans->links() !!}

        </div>
@endsection