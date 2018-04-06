@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Atualizar minha senha:</h3>
        </div>
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        @php
            $icon = Icon::create('floppy-disk')
        @endphp
        <div class="row">
            {!! form($form->add('salve','submit', [
                [
                    'attr' => ['class' => 'btn btn-primary btn-block'], 'label' => $icon
                ]
            ])) !!}
        </div>
    </div>
@endsection