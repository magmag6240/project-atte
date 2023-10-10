@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.detail.css') }}">
@endsection

@section('content')
<div class="user-detail-item">
    <p class="user-detail-text">出勤・退勤履歴</p>
    <table class="user-detail-table">
        <tr class="user-detail-table-row">
            <th class="user-detail-title">勤務日</th>
            <th class="user-detail-title">勤務開始</th>
            <th class="user-detail-title">勤務終了</th>
            <th class="user-detail-title">休憩時間</th>
            <th class="user-detail-title">勤務時間</th>
        </tr>
        @foreach($admin_user_details as $admin_user_detail)
        <tr class="user-detail-table-row">
            <td class="user-detail-contents">
                {{$admin_user_detail->work_date}}
            </td>
            <td class="user-detail-contents">
                {{$admin_user_detail->start_work_time}}
            </td>
            <td class="user-detail-contents">
                {{$admin_user_detail->end_work_time}}
            </td>
            <td class="user-detail-contents">
                {{$admin_user_detail->total_rest_time}}
            </td>
            <td class="user-detail-contents">
                {{$admin_user_detail->total_work_time}}
            </td>
        </tr>
        @endforeach
    </table>
    <div class="timestamp-paginate">
        {{$admin_user_details->links('vendor.pagination.attendance_item_paginate')}}
    </div>
    <div class="user-list-link">
        <a class="user-list-link" href="/admin">ユーザー一覧に戻る</a>
    </div>
</div>
@endsection