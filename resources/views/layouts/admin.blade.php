<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css')}} " rel="stylesheet">
    <link rel="icon" type="image/png" href="https://utils.organizze.com.br/favicons/favicon-32x32.png" sizes="32x32">
</head>
<body>
    <div id="app">

        @php
            $navbar = Navbar::withBrand(config('app.name'),url('/admin/dashboard'))->inverse();
            if(Auth::check()){
                $arrayList = [
                    ['link' => route('admin.dashboard'), 'title' => 'Dashboard'],
                    ['link' => route('admin.users.index'), 'title' => 'Users']
                ];
                $menus = Navigation::links($arrayList);
                $logout = Navigation::links([[
                    Auth::user()->name,
                    [
                        [
                            'link' => route('admin.logout'),
                            'title' => 'logout',
                            'linkAttributes' => [
                                'onclick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                            ]
                        ],
                    ]
                ]])->right();
                $navbar->withContent($menus)->withContent($logout);
            }
        @endphp
        {!! $navbar !!}

        @php $formLogout = FormBuilder::plain([
                    'id' => 'form-logout',
                    'route' => ['admin.logout'],
                    'method' => 'POST',
                    'style' => 'display:none'
                ]) @endphp
        {!! form($formLogout) !!}


        @if(Session::has('message'))
            <div class="container">
                {!! Alert::success(Session::get('message'))->close() !!}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
