@extends('layouts.admin_layout')

@section('title', 'Добавление урока')

@push('script')
    <script src="/summernote/summernote-bs4.min.js"></script>
    <script src="/summernote/lang/summernote-ru-RU.min.js"></script>

    <script>

        let inputSubtitleText = $("#inputText");
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

        let inputContent = $("#inputManual");
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
                    <form action="{{ route('lessons.store') }}" method="POST">
                    @csrf

                    <!-- Заголовок -->
                        <div class="card-header">
                            <h3 class="card-title">Добавление урока</h3>
                        </div>

                        <div class="card-body">

                            <!-- Поле наименование -->
                            <div class="form-group">
                                <label for="inputName">Наименование</label>
                                <input type="text" id="inputName" name="name" class="form-control" required>
                            </div>
                            <!-- Поле описание -->
                            <div class="form-group">
                                <label for="inputDescription">Текст задания</label>
                                <textarea id="inputDescription" name="text" class="form-control" rows="4" required></textarea>
                            </div>
                            <!-- Поле код HTML -->
                            <div class="form-group">
                                <label for="editor">Код HTML <span style="color:grey">(необязательно)</span></label>
                                <textarea id="editor_html" name="code_html" class="form-control" rows="4"></textarea>

                                <label for="editor_html_answer">Код HTML <span style="color:grey">(ответ)</span></label>
                                <textarea id="editor_html_answer" name="answer_code_html" class="form-control" rows="4"></textarea>
                            </div>
                            <!-- Поле код CSS -->
                            <div class="form-group">
                                <label for="editor">Код CSS <span style="color:grey">(необязательно)</span></label>
                                <textarea id="editor_css" name="code_css" class="form-control" rows="4"></textarea>

                                <label for="editor_css_answer">Код CSS <span style="color:grey">(ответ)</span></label>
                                <textarea id="editor_css_answer" name="answer_code_css" class="form-control" rows="4"></textarea>
                            </div>
                            <!-- Поле код JS -->
                            <div class="form-group">
                                <label for="editor">Код JS <span style="color:grey">(необязательно)</span></label>
                                <textarea id="editor_js" name="code_js" class="form-control" rows="4"></textarea>

                                <label for="editor_js_answer">Код JS <span style="color:grey">(ответ)</span></label>
                                <textarea id="editor_js_answer" name="answer_code_js" class="form-control" rows="4"></textarea>
                            </div>
                            <!-- Поле другой код -->
                            <div class="form-group">
                                <label for="editor">Другой код <span style="color:grey">(необязательно)</span></label>
                                <textarea id="editor_other" name="code_other" class="form-control" rows="4"></textarea>

                                <label for="editor_other_answer">Другой код <span style="color:grey">(ответ)</span></label>
                                <textarea id="editor_other_answer" name="answer_code_other" class="form-control" rows="4"></textarea>
                            </div>
                            <!-- Поле методичка -->
                            <div class="form-group">
                                <label for="inputProjectLeader">Методический материал  <span style="color:grey">(необязательно)</span></label>
                                <textarea id="inputManual" name="manual" class="form-control" rows="4"></textarea>
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
        let editor_html = CodeMirror.fromTextArea
        (document.getElementById('editor_html'), {
            mode: "xml",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });

        let editor_html_answer = CodeMirror.fromTextArea
        (document.getElementById('editor_html_answer'), {
            mode: "xml",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });


        let editor_css = CodeMirror.fromTextArea
        (document.getElementById('editor_css'), {
            mode: "css",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });

        let editor_css_answer = CodeMirror.fromTextArea
        (document.getElementById('editor_css_answer'), {
            mode: "xml",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });


        let editor_js = CodeMirror.fromTextArea
        (document.getElementById('editor_js'), {
            mode: "javascript",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });

        let editor_js_answer = CodeMirror.fromTextArea
        (document.getElementById('editor_js_answer'), {
            mode: "xml",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });


        let editor_other = CodeMirror.fromTextArea
        (document.getElementById('editor_other'), {
            mode: "",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });

        let editor_other_answer = CodeMirror.fromTextArea
        (document.getElementById('editor_other_answer'), {
            mode: "xml",
            theme: "dracula",
            lineNumbers: "true",
            autoCloseTags: "true"
        });

    </script>
@endsection
