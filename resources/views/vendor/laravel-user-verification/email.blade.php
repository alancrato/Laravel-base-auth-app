<h3>{{config('app.name')}}</h3>
<p>Sua conta na plataforma foi criada.</p>
<p>
    Clique
    <a href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">
        <strong> aqui</strong>
    </a>
    para ativar sua conta:
</p>
<p>
    Não responda esse a-mail, ele é gerado automaticamente.
</p>