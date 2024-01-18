@extends('layouts.admin_layout')

@section('title', 'Список вопросов')

@section('content')
    <!-- Сообщение при успешном добавлении -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список вопросов</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th style="width:3%">ID</th>
                                <th>Курс</th>
                                <th>Вопросы</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th style="width:20%"></th>
                            </tr>
                            </thead>
                            <tbody>

{{--                            @foreach($courses as $course)--}}

{{--                                <tr>--}}
{{--                                    <td rowspan={{$a + 1}}>{{$course['id']}}</td>--}}
{{--                                    <td rowspan={{$a + 1}}>{{$course['name']}}</td>--}}
{{--                                </tr>--}}

{{--                                @foreach($questions as $question)--}}
{{--                                <tr>--}}
{{--                                    <td rowspan={{$a + 1}}>{{$question['name']}}</td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}

{{--                            @endforeach--}}

                            @foreach($questions as $question)

                            <tr>
                                <td>{{$question['id']}}</td>
                                <td>{{ $question->courses()->pluck('name')->implode('name', ' ') }}</td>
                                <td>{{$question['name']}}</td>
                                <td>{{ Str::limit($question['created_at'], $limit = 10, $end = '') }}
                                </td>
                                <td>{{ Str::limit($question['updated_at'], $limit = 10, $end = '') }}
                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-success btn-sm" title="Редактировать" href="{{ route('questions.edit', $question['id']) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('questions.destroy', $question['id']) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Удалить" type="submit">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                    {{ $courses->links()  }}
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
