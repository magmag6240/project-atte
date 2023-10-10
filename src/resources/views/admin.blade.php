@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="user-list-item">
    <div class="user-search">
        <form class="user-search" action="/admin" method="get">
            @csrf
            <input class="search-input" type="search" name="keyword" placeholder="Search" value="{{ $keyword }}">
            <button class="search-submit" type="submit">会員検索</button>
            <button class="search-clear-button">
                <a class="search-clear-link" href="/admin">クリア</a>
            </button>
        </form>
    </div>
    <table class="user-list-table">
        <tr class="user-list-table-row">
            <th class="user-list-title">id</th>
            <th class="user-list-title">名前</th>
            <th class="user-list-title">メールアドレス</th>
            <th class="user-list-title">ユーザーカテゴリー</th>
        </tr>
        @foreach($user_data as $user_detail)
        <tr class="user-list-table-row">
            <td class="user-list-contents">
                {{$user_detail->id}}
            </td>
            <td class="user-list-contents">
                {{$user_detail->name}}
            </td>
            <td class="user-list-contents">
                {{$user_detail->email}}
            </td>
            <form method="post" action="{{route('admin.update',['id' =>$user_detail->id])}}">
                @method('patch')
                @csrf
                <td class="user-list-contents">
                    <input class="update-role-input" name="role" type="text" value="{{$user_detail->role}}">
                </td>
                <td class="user-list-contents">
                    <button class="update-button" type="submit">更新</button>
                </td>
            </form>
            <form method="post" action="{{route('admin.delete',['id' =>$user_detail->id])}}">
                @csrf
                <td class="user-list-contents">
                    <button class="delete-button" type="submit">削除</button>
                </td>
            </form>
            <td class="user-detail-link">
                <a class="user-detail-link" href="{{route('admin.show',['id'=>$user_detail->id])}}">出勤履歴</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="user-paginate">
        {{$user_data->appends(request()->query())->links('vendor.pagination.attendance_item_paginate')}}
    </div>
</div>
@endsection