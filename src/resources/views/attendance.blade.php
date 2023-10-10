@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-item">
    <form class="date-search" action="/attendance" method="get">
        @csrf
        <p class="search-text">打刻履歴検索</p>
        <div class="search-item">
            <input class="search-input" type="month" name="month">
            <button class="search-button" type="submit">検索</button>
            <button class="clear-button">
                <a class="clear-link" href="/attendance">クリア</a>
            </button>
        </div>
    </form>
    <table class="attendance-table">
        <tr class="attendance-table-row">
            <th class="attendance-title">勤務日</th>
            <th class="attendance-title">勤務開始</th>
            <th class="attendance-title">勤務終了</th>
            <th class="attendance-title">休憩時間</th>
            <th class="attendance-title">勤務時間</th>
        </tr>
        @foreach($attendance_items as $attendance_item)
        <tr class="attendance-table-row">
            <td class="attendance-contents">
                {{$attendance_item->work_date}}
            </td>
            <td class="attendance-contents">
                {{$attendance_item->start_work_time}}
            </td>
            <td class="attendance-contents">
                {{$attendance_item->end_work_time}}
            </td>
            <td class="attendance-contents">
                {{$attendance_item->total_rest_time}}
            </td>
            <td class="attendance-contents">
                {{$attendance_item->total_work_time}}
            </td>
        </tr>
        @endforeach
    </table>
    <div class="paginate">
        {{$attendance_items->links('vendor.pagination.attendance_item_paginate')}}
    </div>
</div>
@endsection