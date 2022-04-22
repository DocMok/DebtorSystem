@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Список должников</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card" bis_skin_checked="1">
                <div class="card-header" bis_skin_checked="1">
                    <h3 class="card-title">Bordered Table</h3>
                </div>

                <div class="card-body" bis_skin_checked="1">
                    @if(Auth::user() && Auth::user()->is_admin)
                        <div class="row mb-4">
                            <div class="col-2">
                                <a href="{{route('debtor.create')}}" class="btn btn-block btn-primary">Добавить должника</a>
                            </div>
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                                <div class="progress progress-xs" bis_skin_checked="1">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%" bis_skin_checked="1"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                                <div class="progress progress-xs" bis_skin_checked="1">
                                    <div class="progress-bar bg-warning" style="width: 70%" bis_skin_checked="1"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                                <div class="progress progress-xs progress-striped active" bis_skin_checked="1">
                                    <div class="progress-bar bg-primary" style="width: 30%" bis_skin_checked="1"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">30%</span></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                                <div class="progress progress-xs progress-striped active" bis_skin_checked="1">
                                    <div class="progress-bar bg-success" style="width: 90%" bis_skin_checked="1"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-success">90%</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix" bis_skin_checked="1">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
