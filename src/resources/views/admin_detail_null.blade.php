@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.null.css') }}">
@endsection

@section('content')
<div class="admin-detail-null">
    <p class="admin-detail-text">出勤データが存在しません。</p>
    <div class="user-list-link">
        <a class="user-list-link" href="/admin">ユーザー一覧に戻る</a>
    </div>
</div>

@endsection