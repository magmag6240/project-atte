@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-email-result">
    <p class="verify-email-title">新規会員仮登録完了</p>
    <p class="verify-email-text">メールアドレス認証用の確認メールを送信いたしました。</p>
    <p class="verify-email-text">メール内の<span class="verify-email-span">認証する</span>ボタンをクリックして、登録を完了してください。</p>
    <p class="verify-email-alarm">※回線の混雑状況によっては、メールが届かない場合もございます。</p>
    <form method="post" action="/email/verification-notification">
        @csrf
        <button class="verify-email-resent" type="submit">メールが届かない場合はこちらをクリック</button>
    </form>
    <form method="post" action="/logout">
        @csrf
        <button class="verify-email-logout" type="submit">ログイン画面に戻る</button>
    </form>
</div>
@endsection