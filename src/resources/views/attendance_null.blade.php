@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.null.css') }}">
@endsection

@section('content')
<div class="attendance-null">
    <p class="attendance-text">出勤データが存在しません。</p>
    <div class="timestamp-link">
        <a class="timestamp-link" href="/">打刻ページに戻る</a>
    </div>
</div>

@endsection