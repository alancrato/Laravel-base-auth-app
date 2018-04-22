@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Planos</h3>
            {!! Button::primary('Listar')->asLinkTo(route('admin.plans.index')) !!}
        </div>
        <div class="row">
            <h3>Novp Plano</h3>
            <?php $icon = Icon::create('floppy-disk'); ?>
            {!!
               form($form->add('salve', 'submit',[
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => $icon
               ]))
            !!}
        </div>
    </div>
@endsection