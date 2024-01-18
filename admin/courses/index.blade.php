@extends('layouts.admin_layout')

@section('title', 'Список курсов')

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
                        <h3 class="card-title">Список курсов</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th style="width:3%">ID</th>
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th style="width:20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)

                            <tr>
                                <td>{{$course['id']}}</td>
                                <td>{{$course['name']}}</td>
                                <td>{{ Str::limit($course['description'], $limit = 50, $end = '') }}...</td>
                                <td>{{ Str::limit($course['created_at'], $limit = 10, $end = '') }}
                                </td>
                                <td>{{ Str::limit($course['updated_at'], $limit = 10, $end = '') }}
                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-success btn-sm" title="Редактировать" href="{{ route('courses.edit', $course['id']) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('courses.destroy', $course['id']) }}" class="d-inline" method="POST">
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
