@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Должник</h3>
                    <button class="col-6 card-tools btn-link text-secondary btn" id="show-files">
                        <i class="far fa-fw fa-file-word"></i>
                        <div class="btn" style="padding-left: 0px;">Файлы</div>
                    </button>

                </div>
                <div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ФИО должника</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->name}}</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ИИН должника</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->iin}}</h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Адрес должника</label>
                            <div class="card-header">
                                <h5>{{$debtor->address}}</h5>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Наименование органа (ЧСИ)</label>
                            <div class="card-header">
                                <h5>{{$debtor->chsi}}</h5>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>БИН органа</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->bin}}</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Номер исполнительного производства</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->nip}}</h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Дата вступления в силу</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->start_date}}</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Сумма задолженности</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->debit_sum}}</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Наименование блокировки счета</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->account_block_name}}</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Арест в пользу</label>
                                    <div class="card-header">
                                        <h5>{{$debtor->arrest_to}}</h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{route('debtor.index')}}" class="btn btn-primary">Назад</a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade col-8" id="modal" style="display: none; padding: 15px; padding-left: 30%;"
         aria-modal="true" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Документы</h4>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="card-body">
                @foreach($files as $file)
                    <div class="justify-content-center">
                        <a class="img-thumbnail w-100" title="preview"
                           href="{{url('storage/'.$file->path)}}">{{$file->path}} </a>
                    </div>
                @endforeach

            </div>

            <div class="modal-footer justify-content-between" bis_skin_checked="1">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Закрыть</button>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#show-files').click(showModal)
        $('.close-modal').click(closeModal)

        $(document).on('keyup', function (evt) {
            if (evt.keyCode == 27) {
                if ($("#modal").hasClass('show')) {
                    closeModal();
                }
            }
        });
        function closeModal() {
            $('#modal').removeClass('show');
            $('#modal').css('display', 'none')

        }

        function showModal() {
            $('#modal').addClass('show');
            $('#modal').css('display', 'block')
        }
    </script>

@endsection

