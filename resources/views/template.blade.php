<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre', 'Album Photo')</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
    <header>
        <a href="/">Album Photo</a>
    </header>

    <main>
        @yield("content")
    </main>
</body>
</html>
