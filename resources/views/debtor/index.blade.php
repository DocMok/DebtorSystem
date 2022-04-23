@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.daterangepicker', true)

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
        <div class="col-md-4 ">
            <form action="{{route("debtor.search")}}" method=get>
                @csrf
                <div class="input-group">
                    <input type="search" class="form-control form-control-md" name="search"
                           placeholder="Поиск должника">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-md btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6 row offset-2">
            <a id="filter" class="btn btn-sm " href="{{route('debtor.exportByDate')}}?">export</a>
            <div class="form-group">
                <div class="input-group offset-1">
                    <div id="reportrange"
                         style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                        <a id="exportByDate" href="{{route('debtor.filter')}}?" class="btn btn-sm ">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                          action="{{route('debtor.export', $debtor->id)}}" style="margin:2px;">
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
@section('js')
    <script type="text/javascript">
        $(function () {

            var start = moment().subtract(29, 'days');
            var end = moment();
            addDataRangesToURL(start, end);

            function cb(start, end) {
                $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                    'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
                    'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                addDataRangesToURL(picker.startDate, picker.endDate);
            });

            function addDataRangesToURL(start, end) {
                let href = $('#filter');
                let hrefExport = $('#exportByDate')
                let oldUrl = href.attr("href"); // Get current url
                let oldUrlExport = hrefExport.attr("href");
                let newUrl = oldUrl.replace(/\?.*/, "?start_date="+start.format('YYYY-MM-DD')+"&end_date="+end.format('YYYY-MM-DD')); // Create new url
                let newUrlExport = oldUrlExport.replace(/\?.*/, "?start_date="+start.format('YYYY-MM-DD')+"&end_date="+end.format('YYYY-MM-DD')); // Create new url

                href.attr("href", newUrl); // Set href value
                hrefExport.attr("href", newUrlExport);
            }
        });

    </script>
@endsection
