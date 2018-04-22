@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de Perfis PayPal</h3>
            {!! Button::primary('Novo Perfil')->asLinkTo(route('admin.web_profiles.create')) !!}
        </div>

        <div class="row"></div>

        <div class="row">

            {!! Table::withContents($webProfiles->items())->striped()
                ->callback('Ações', function($field, $webProfiles){
                    $linkEdit = route('admin.web_profiles.edit', ['webProfile' => $webProfiles->id]);
                    $linkShow = route('admin.web_profiles.show', ['webProfile' => $webProfiles->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                    Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })
             !!}
        </div>

        {!! $webProfiles->links() !!}

    </div>
@endsection