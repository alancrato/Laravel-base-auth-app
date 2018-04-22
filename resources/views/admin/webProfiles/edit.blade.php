@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Perfis PayPal</h3>
            {!! Button::primary('Listar')->asLinkTo(route('admin.web_profiles.index')) !!}
        </div>
        <div class="row">
            <h3>Editar Perfil</h3>
            <?php $icon = Icon::create('pencil'); ?>
            {!!
               form($form->add('salve', 'submit',[
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => $icon
               ]))
            !!}
        </div>
    </div>
@endsection