@extends('layouts.master')
@section('content')
    <script src="{{ url('/js/side/auth.js?x=1') }}"></script>
    <h1>使用者系統權限管理</h1>
    <div class="row">
        <div class="col-md-12">
             <div class="panel panel-default">
                <div class="panel-body row">
                    <div class="col-xs-9 col-lg-6">
                        <div class="input-group">
                            <input type="hidden" id="userID" name="userID">
                            <input type="text" class="form-control" id="userName" placeholder="請輸入查詢使用者">
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            </ul>  
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="doSave()">儲存</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td></td>
                        <td>系統名稱</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sideList as $side)
                        @php
                            $json = $side->toJson();
                        @endphp
                        <tr>
                            <td class="col-md-1 text-center">
                                <input type="checkbox" id="{{ $side->ID }}" name="side" value="{{ $side->ID }}">
                            </td>
                            <td>{{ $side->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection