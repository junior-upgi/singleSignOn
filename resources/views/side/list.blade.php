@extends('layouts.master')
@section('content')
    <script src="{{ url('/js/side/list.js?x=2') }}"></script>
    <h1>系統清單管理</h1>
    <div class="row">
        <div class="col-md-12">
             <div class="panel panel-default">
                <div class="panel-body">
                    <button class="btn btn-default" onclick="doAdd()">新增</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>系統名稱</td>
                        <td></td>
                    </tr>
                </thead>
                @foreach($sideList as $side)
                    @php
                        $json = $side->toJson();
                    @endphp
                    <tr>
                        <td>{{ $side->name }}</td>
                        <td class="col-md-2">
                            <button class="btn btn-default" onclick="doAdd('{{ $json }}')">編輯</button>
                            <button class="btn btn-danger" onclick="doDelete('{{ $side->ID }}')">刪除  </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@include('side.add')
@endsection