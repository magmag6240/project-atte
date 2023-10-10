@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/timestamp.css') }}">
@endsection

@section('content')
<div class="stamp">
    <p class="greeting">{{ Auth::user()->name }}さんお疲れ様です！</p>
    <table class="attendance-table">
        <tr class="attendance-table-tr">
            <td class="attendance-table-td">
                <form class="attendance-form" action="/timestamp" method="post" id="start_work">
                    @csrf
                    <button class="stamp-button" type="submit" name="start_work" disabled>勤務開始</button>
                </form>
            </td>
            <td class="attendance-table-td">
                <form class="attendance-form" action="/timestamp/update" method="post" id="end_work">
                    @csrf
                    @method('patch')
                    <button class="stamp-button" type="submit" name="end_work">勤務終了</button>
                </form>
            </td>
        </tr>
        <tr class="attendance-table-tr">
            <td class="attendance-table-td">
                <form class="attendance-form" action="/timestamp_rests" method="post" id="start_rest">
                    @csrf
                    <button class="stamp-button" type="submit" name="start_rest" disabled>休憩開始</button>
                </form>
            </td>
            <td class="attendance-table-td">
                <form class="attendance-form" action="/timestamp_rests/update" method="post" id="end_rest">
                    @csrf
                    @method('patch')
                    <button class="stamp-button" type="submit" name="end_work">休憩終了</button>
                </form>
            </td>
        </tr>
    </table>
</div>
@endsection