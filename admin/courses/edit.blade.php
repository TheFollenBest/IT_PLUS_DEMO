@extends('layouts.admin_layout')

@section('title', 'Изменение курса')

@push('script')
    <script src="/summernote/summernote-bs4.min.js"></script>
    <script src="/summernote/lang/summernote-ru-RU.min.js"></script>

    <script>

        let inputSubtitleText = $("#inputSubtitleText");
        $(function() {
            inputSubtitleText.summernote({
                lang: 'ru-RU',
                height: 300,

                toolbar: [

                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize', 'fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['misc', ['undo', 'redo']]
                ]
            });


            inputSubtitleText.summernote('code', inputSubtitleText.attr('value'));
        });

        let inputContent = $("#inputContent");
        $(function() {
            inputContent.summernote({
                lang: 'ru-RU',
                height: 300,

                toolbar: [

                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize', 'fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['misc', ['undo', 'redo']]
                ]
            });


            inputContent.summernote('code', inputContent.attr('value'));
        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" href="/summernote/summernote-bs4.min.css">

@endpush

@section('content')

    <!-- Сообщение при успешном редактировании -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form action="{{ route('courses.update', $course['id'])}}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Заголовок -->
                        <div class="card-header">
                            <h3 class="card-title">Изменение курса</h3>
                        </div>

                        <div class="card-body">

                            <!-- Поле наименование -->
                            <div class="form-group">
                                <label for="inputName">Наименование</label>
                                <input value="{{ $course['name']}}" type="text" id="inputName" name="name" class="form-control" required>
                            </div>
                            <!-- Поле описание -->
                            <div class="form-group">
                                <label for="inputDescription">Описание</label>
                                <textarea id="inputDescription" name="description" class="form-control" rows="4" required>{{ $course['description'] }}</textarea>
                            </div>
                            <!-- Поле выбор фото -->
                            <div class="form-group">
                                <label for="exampleInputFile">Фото</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                                        <input type="file" name="img" class="custom-file-input" id="exampleInputFile" accept="image/*" onchange="loadFile(event)" required>
                                    </div>
                                </div>
                                <img id="output" style="width: 300px">
                            </div>
                            <!-- Поле подзаголовок -->
                            <div class="form-group">
                                <label for="inputClientCompany">Подзаголовок</label>
                                <input value="{{ $course['subtitle'] }}" type="text" name="subtitle" id="inputSubtitle" class="form-control" required>
                            </div>
                            <!-- Поле текст подзаголовка -->
                            <div class="form-group">
                                <label for="inputProjectLeader">Текст подзаголовка</label>
                                <textarea name="subtitle_text" class="form-control" id="inputSubtitleText" rows="4" required>{{ $course['subtitle_text'] }}</textarea>
                            </div>
                            <!-- Поле содержание -->
                            <div class="form-group">
                                <label for="inputProjectLeader">Содержание</label>
                                <textarea id="inputContent" name="content_course" class="form-control" rows="4" required>{{ $course['content'] }}</textarea>
                            </div>
                            <!-- Поле выбор цвета карточки-->
                            <div class="form-group">
                                <label for="inputClientCompany">Цвет карточки курса <span style="color:grey">(необязательно)</span></label>
                                <input style="max-width: 100px; height: 100px" type="color" value="{{ $course['card_color'] }}" name="card_color" id="inputCardColor" class="form-control" required>
                            </div>
                            <!-- Поле выбор цвета -->
                            <div class="form-group">
                                <label for="inputClientCompany">Цвет текста курса <span style="color:grey">(необязательно)</span></label>
                                <input style="max-width: 100px; height: 100px" type="color" value="{{ $course['font_color'] }}" name="font_color" id="inputFontColor" class="form-control" required>
                            </div>
                            <!-- Поле выбор фото карточки -->
                            <div class="form-group">
                                <label for="exampleInputFile">Фото</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="card_img">Выберите файл</label>
                                        <input type="file" name="card_img" class="custom-file-input" id="card_img" accept="image/*" onchange="loadFile(event)" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Кнопка изменить -->
                            <div class="col-12">
                                <input type="submit" value="Изменить" class="btn btn-success float-right">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        let loadFile = function (event){
            let output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
