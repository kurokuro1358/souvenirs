<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/logo.png" class="img-fluid" width="150" alt="brand-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-bar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav ml-auto">
                @if (Auth::check())
                    {{-- お土産を探すページへのリンク --}}
                    <li class="nav-item"><a href="{{ url('/') }}#find-souvenirs" class="nav-link">お土産を探す</a></li>
                    {{-- お土産を登録するページへのリンク --}}
                    <li class="nav-item"><a href="{{ route('souvenirs.create') }}" class="nav-link">お土産を登録する</a></li>
                    {{-- お気に入り一覧ページへのリンク --}}
                    <li class="nav-item"><a href="{{ route('favorites.index')}}" class="nav-link">お気に入り</a></li>
                    {{-- その他の機能 --}}
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">その他</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{-- ユーザ詳細ページへのリンク --}}
                        <li class="dropdown-item"><a href="{{ route('users.index') }}">ユーザ詳細</a></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                    </ul>
                @else
                    {{-- お土産を探すページへのリンク --}}
                    <li class="nav-item"><a href="{{ url('/') }}#find-souvenirs" class="nav-link">お土産を探す</a></li>
                    {{-- お土産を登録するページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'お土産を登録する', [], ['class' => 'nav-link']) !!}</li>
                    {{-- 会員登録ページへのリンク --}}
                     <li class="nav-item">{!! link_to_route('signup.get', '会員登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>