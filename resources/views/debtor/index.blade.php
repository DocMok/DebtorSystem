@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Список должников</h1>
            </div>
            <div class="col-sm-3 breadcrumb float-sm-right">
                <a href="{{route('debtor.create')}}" type="button" class="btn btn-block btn-primary">Добавить
                    должника</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 ">
            <form action="{{route("debtor.search")}}" method=get>
                @csrf
                <div class="input-group">
                    <input type="search" class="form-control form-control-md" name="search" placeholder="Поиск должника">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-md btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 ">
            <form action="simple-results.html">
                <div class="input-group">
                    <input type="search" class="form-control form-control-md" placeholder="Type your keywords here">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-md btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 40%">ФИО</th>
            <th style="width: 25%">Долг</th>
            <th style="width: 35%">действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach($debtors as $debtor)
            <tr>
                <td>{{$debtor->id}}</td>
                <td>{{$debtor->name}}</td>
                <td>{{$debtor->debit_sum}}</td>
                <td>
                    <form class='card-title' method=get
                          action="{{route('debtor.show', $debtor->id)}}" style="margin:2px;">
                        @csrf
                        <button class="btn btn-info btn-sm" type="submit">
                            <i class="fas fa-eye"></i>
                        </button>
                    </form>


                    <form class='card-title' method=get
                          action="{{route('debtor.edit', $debtor->id)}}" style="margin:2px;">
                        @csrf
                        <button class=" btn btn-block btn-dark btn-sm" type="submit">
                            <i class="fas fa-pencil-alt mr-1"></i>
                        </button>
                    </form>

                    <form class='card-title' method=post
                          action="{{route('debtor.delete', $debtor->id)}}" style="margin:2px;">
                        {{method_field('delete')}}
                        @csrf
                        <button class="btn btn-block btn-danger btn-sm" type="submit">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                    <form class='card-title' method=get
                          action="{{route('debtor.edit', $debtor->id)}}" style="margin:2px;">
                        @csrf
                        <button class="btn btn-block btn-warning btn-flat btn-sm" type="submit">
                            <i class="far fa-fw fa-file-word"></i>
                        </button>
                    </form>

                </td>
        @endforeach


        </tbody>
    </table>
@endsection
