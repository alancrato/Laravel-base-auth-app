@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de Perfis PayPal</h3>
            {!! Button::primary('Listar')->asLinkTo(route('admin.web_profiles.index')) !!}
        </div>

        <div class="row">
            <h3>Ver Perfil</h3>

            <?php $iconEdit = Icon::create('pencil'); ?>
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.web_profiles.edit', ['web_profile' => $web_profile->id])) !!}
            <?php $iconDestroy = Icon::create('remove'); ?>
            {!! Button::danger($iconDestroy)
                ->asLinkTo(route('admin.web_profiles.destroy', ['webProfile' => $web_profile->id]))
                ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
             !!}
            <?php $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'route' => ['admin.web_profiles.destroy','webProfile' => $web_profile->id],
                'method' => 'DELETE',
                'style' => 'display:none'
            ])?>
            {!! form($formDelete) !!}

            <br/><br/>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">Id</th>
                    <td>{{ $web_profile->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{ $web_profile->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Logo Url</th>
                    <td>{{ $web_profile->logo_url }}</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection