<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Fontswesome -->
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <title>みやげ</title>
  </head>
  <body>
    
    {{-- ナビゲーションバー --}}
    @include('commons.navbar')
    
    <div class="container my-5">
        {{-- エラーメッセージ --}}
        @include('commons.error_messages')
        
        @yield('content')
    </div>
    
    <footer class="bg-light py-4">
      <div class="text-center">
        <a href="{{ url('/') }}">
          <img src="/images/logo.png" class="img-fluid">
        </a>
      </div>
      <ul class="nav justify-content-center">
        @if (Auth::check())
          {{-- お土産を探すページへのリンク --}}
          <li class="nav-item"><a href="{{ url('/') }}#find-souvenirs" class="nav-link">お土産を探す</a></li>
          {{-- お土産を登録するページへのリンク --}}
          <li class="nav-item"><a href="{{ route('souvenirs.create') }}" class="nav-link">お土産を登録する</a></li>
          {{-- お気に入り一覧ページへのリンク --}}
          <li class="nav-item"><a href="{{ route('favorites.index')}}" class="nav-link">お気に入り</a></li>
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
    </footer>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="/js/script.js"></script>
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>