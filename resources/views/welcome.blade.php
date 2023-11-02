<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat App</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/welcome.css'])
    </head>
    <body>
        <div class="container">
            <h1>Bem-vindo ao Chat App!</h1>
            <p>
                Este projeto foi criado para tornar a comunicação mais simples e eficaz. Se você ainda não possui uma conta, por favor,
                <a href="/register"><strong>registre-se</strong></a>. Caso já seja um membro, faça o seu
                <a href="/login"><strong>login</strong></a>.
            </p>
        </div>
    </body>
</html>
