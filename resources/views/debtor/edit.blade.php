@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Изменение страницы должника</h3>
                    <button class="col-6 card-tools btn-link text-secondary btn" id="show-files">
                        <i class="far fa-fw fa-file-word"></i>
                        <div class="btn" style="padding-left: 0px;">Файлы</div>
                    </button>
                </div>
                <form action="{{route('debtor.update')}}" method=post enctype="multipart/form-data">
                    @csrf
                    {{method_field('put')}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">ФИО должника</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="ФИО должника" value="{{$debtor->name}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iin">ИИН должника</label>
                                    <input type="text" class="form-control" id="iin" name="iin"
                                           placeholder="ИИН должника" value="{{$debtor->iin}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Адрес должника</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Адрес должника" value="{{$debtor->address}}">
                        </div>
                        <div class="form-group">
                            <label for="chsi">Наименование органа (ЧСИ)</label>
                            <input type="text" class="form-control" id="chsi" name="chsi"
                                   placeholder="Наименование органа (ЧСИ)" value="{{$debtor->chsi}}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bin">БИН органа</label>
                                    <input type="text" class="form-control" id="bin" name="bin"
                                           placeholder="БИН органа" value="{{$debtor->bin}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nip">Номер исполнительного производства</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                           placeholder="Номер исполнительного производства" value="{{$debtor->nip}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_date">Дата вступления в силу</label>
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                           placeholder="Дата вступления в силу" value="{{$debtor->start_date}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="debit_sum">Сумма задолженности</label>
                                    <input type="text" class="form-control" id="debit_sum" name="debit_sum"
                                           placeholder="Сумма задолженности" value="{{$debtor->debit_sum}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="account_block_name">Наименование блокировки счета</label>
                                    <input type="text" class="form-control" id="account_block_name"
                                           name="account_block_name" placeholder="Наименование блокировки счета"
                                           value="{{$debtor->account_block_name}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="arrest_to">Арест в пользу</label>
                                    <input type="text" class="form-control" id="arrest_to" name="arrest_to"
                                           placeholder="Арест в пользу" value="{{$debtor->arrest_to}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    <input type='hidden' name="debtor_id" value="{{$debtor->id}}">
                </form>

            </div>

        </div>
    </div>

    <div class="modal fade col-10" id="modal" style="display: none; padding: 15px; padding-left: 30%;"
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
                    <li data-id="{{$file->id}}" class="card-header" style="list-style-type:none">
                        <a class="img-thumbnail w-100" title="preview"
                           href="{{url('storage/'.$file->path)}}">{{$file->path}} </a>
                        <div class="btn  btn-danger btn-sm task-delete card-tools" style="margin-bottom: 10px;"><i class="fas fa-trash "></i></div>
                    </li>

                @endforeach
            </div>

            <div class="modal-footer row justify-content-between" bis_skin_checked="1">
                <form class="custom-file " action="{{route('file.store')}}" method=post enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-default close-modal">Сохранить</button>
                        </div>
                        <div class="col-8">
                            <label class="custom-file-label" for="documents">Выбрать файлы</label>
                            <input type="file" class="custom-file-input" name="documents[]" id="documents" multiple>
                            <input type='hidden' name="debtor_id" value="{{$debtor->id}}">
                        </div>
                    </div>

                </form>

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

        function getCsrfToken(callBack) {
            $.ajax({
                url: '{{route('csrf')}}',
                method: 'get',
                success: callBack
            });
        }

        function removeTask(e) {
            getCsrfToken(function (token) {
                console.log($(e.target));
                let id = $(e.target).parent().data('id');
                if(!id){
                    id = $(e.target).parent().parent().data('id');
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: '{{route('file.delete')}}',
                    method: 'delete',
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        $('li[data-id=' + id + ']').remove();
                    }
                });
            });
        }

        $('.task-delete').click(removeTask);



    </script>

@endsection


