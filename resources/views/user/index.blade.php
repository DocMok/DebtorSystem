@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Список пользователей</h1>
                </div>
                <div class="col-sm-3 breadcrumb float-sm-right">
                    <a href = "{{route('user.create')}}"  type="button" class="btn btn-block btn-primary">Добавить пользователя</a>
                </div>
            </div>
        </div>

@stop

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 40%">Имя</th>
            <th style="width: 25%">Почта</th>
            <th style="width: 35%">действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>

                <form class='card-title' method=get
                      action="{{route('user.edit', $user->id)}}" style="margin:2px;">
                    @csrf
                    <button class=" btn btn-block btn-dark btn-sm" type="submit">
                        <i class="fas fa-pencil-alt mr-1"></i>
                    </button>
                    <input type='hidden' name="user_id" value="{{$user->id}}">
                </form>

                <form class='card-title' method=post
                      action="{{route('user.delete', $user->id)}}" style="margin:2px;">
                    {{method_field('delete')}}
                    @csrf
                    <button class="btn btn-block btn-danger btn-sm" type="submit">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                </td>
        @endforeach


        </tbody>
    </table>
@endsection
