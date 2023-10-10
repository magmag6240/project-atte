@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <form class="register-form" action="/register" method="post">
        @csrf
        <p class="register-logo">会員登録</p>
        <input class="input-name" name="name" type="text" value="{{ old('name') }}" placeholder="名前">
        @if ($errors->any())
        <div class="register-error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
        @endif
        <input class="input-email" name="email" type="email" value="{{ old('email') }}" placeholder="メールアドレス">
        @if ($errors->any())
        <div class="register-error">
            @error('email')
            {{ $message }}
            @enderror
        </div>
        @endif
        <input class="input-password" name="password" type="password" placeholder="パスワード">
        @if ($errors->any())
        <div class="register-error">
            @error('password')
            {{ $message }}
            @enderror
        </div>
        @endif
        <input class="input-confirm-password" name="password_confirmation" type="password" placeholder="確認用パスワード">
        <button class="register-button" type="submit">会員登録</button>
        <div class="login">
            <p class="login-text">アカウントをお持ちの方はこちらから</p>
            <a class="login-link" href="/login">ログイン</a>
        </div>
    </form>
</div>
@endsection