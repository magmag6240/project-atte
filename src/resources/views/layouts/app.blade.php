<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <p class="header-logo">Atte</p>
        <nav class="header-nav">
            <ul class="header-nav-list">
                @if(Auth::check())
                <li class="header-nav-item"><a class="list-link" href="/">ホーム</a></li>
                <li class="header-nav-item"><a class="list-link" href="/attendance">日付一覧</a></li>
                @can('admin')
                <li class="header-nav-item"><a class="list-link" href="/admin">管理者ページ</a></li>
                @endcan
                <li class="header-nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        <input class="list-link-input" type="submit" value="ログアウト"></input>
                    </form>
                </li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p class="footer-text">Atte,inc</p>
    </footer>
</body>

</html>