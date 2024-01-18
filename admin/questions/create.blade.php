@extends('layouts.admin_layout')

@section('title', 'Добавление курса')

@section('content')

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

<!-- Сообщение при успешном добавлении -->
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
                <form action="{{ route('questions.store') }}" accept-charset="UTF-8" method="POST">
                    @csrf

                    <!-- Заголовок -->
                    <div class="card-header">
                        <h3 class="card-title">Добавление вопроса и ответа</h3>
                    </div>

                    <div class="card-body">

                        <!-- Поле наименование -->
                        <div class="form-group">
                            <label for="inputName">Наименование</label>
                            <input type="text" id="inputName" name="name" class="form-control" required>
                        </div>
                        <!-- Поле описание -->
                        <div class="form-group">
                            <label for="inputText">Текст</label>
                            <textarea id="inputText" name="text" class="form-control" rows="4" required></textarea>
                        </div>
                        <!-- Поле выбор курса -->
                        <div class="form-group">
                            <label>Курс</label>
                            <select class="form-control" name="selection_course">
                                @foreach($courses as $course)
                                    <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Кнопка добавить -->
                        <div class="col-12">
                            <input type="submit" value="Добавить" class="btn btn-success float-right" required>
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
