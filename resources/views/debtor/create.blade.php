@extends('adminlte::page')

@section('title', 'Dashboard')

{{--@section('content_header')--}}
{{--    <h1>Добавление должника</h1>--}}
{{--@stop--}}

@section('content')
    <div class="row pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Добавление должника</h3>
                </div>
                <form action="{{route('debtor.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">ФИО должника</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="ФИО должника">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iin">ИИН должника</label>
                                    <input type="text" class="form-control" id="iin" name="iin"
                                           placeholder="ИИН должника">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Адрес должника</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Адрес должника">
                        </div>
                        <div class="form-group">
                            <label for="chsi">Наименование органа (ЧСИ)</label>
                            <input type="text" class="form-control" id="chsi" name="chsi"
                                   placeholder="Наименование органа (ЧСИ)">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bin">БИН органа</label>
                                    <input type="text" class="form-control" id="bin" name="bin"
                                           placeholder="БИН органа">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iin">Номер исполнительного производства</label>
                                    <input type="text" class="form-control" id="iin" name="iin"
                                           placeholder="Номер исполнительного производства">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="documents[]" id="documents" multiple>
                                        <label class="custom-file-label" for="documents">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_date">Дата вступления в силу</label>
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                           placeholder="Дата вступления в силу">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="debit_sum">Сумма задолженности</label>
                                    <input type="text" class="form-control" id="debit_sum" name="debit_sum"
                                           placeholder="Сумма задолженности">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="account_block_name">Наименование блокировки счета</label>
                                    <input type="text" class="form-control" id="account_block_name"
                                           name="account_block_name"
                                           placeholder="Наименование блокировки счета">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="arrest_to">Арест в пользу</label>
                                    <input type="text" class="form-control" id="arrest_to" name="arrest_to"
                                           placeholder="Арест в пользу">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
