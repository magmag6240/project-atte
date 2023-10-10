@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="login">
    <form class="login-form" action="/login" method="post">
        @csrf
        <p class="login-logo">ログイン</p>
        <input class="input-email" name="email" type="email" value="{{ old('email') }}" placeholder="メールアドレス">
        @if ($errors->any())
        <div class="login-error">
            @error('email')
            {{ $message }}
            @enderror
        </div>
        @endif
        <input class="input-password" name="password" type="password" value="{{ old('password') }}" placeholder="パスワード">
        @if ($errors->any())
        <div class="login-error">
            @error('password')
            {{ $message }}
            @enderror
        </div>
        @endif
        <button class="login-button" type="submit">ログイン</button>
        <div class="registration">
            <p class="registration-text">アカウントをお持ちでない方はこちらから</p>
            <a class="registration-link" href="/register">会員登録</a>
        </div>
    </form>
</div>
@endsection