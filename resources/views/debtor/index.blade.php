@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Список должников</h1>
            </div>
            <div class="col-sm-3 breadcrumb float-sm-right">
                <a href = "{{route('debtor.create')}}"  type="button" class="btn btn-block btn-primary">Добавить должника</a>
            </div>
        </div>
    </div>
@stop

@section('content')
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
                          action="{{route('debtor.show', $debtor->id)}}">
                        @csrf
                        <button class="btn btn-info btn-sm" type="submit">
                            <i class="fas fa-eye"></i>
                        </button>
                    </form>

                    <a href="#" class="btn btn-tool">

                    </a>
                    <a href="#" class="btn btn-tool">
                        <i class="fas fa-pencil-alt mr-1"></i>
                    </a>
                    <a href="#" class="btn btn-tool">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a href="#" class="btn btn-tool">
                        <i class="far fa-fw fa-file-word"></i>
                    </a>
                </td>
        @endforeach


        </tbody>
    </table>
@endsection
