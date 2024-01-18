@extends('layouts.admin_layout')

@section('title', 'Список уроков')


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
                        <h3 class="card-title">Список уроков, {{Auth::user()->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th style="width:3%">ID</th>
                                <th>Наименование</th>
                                <th>Курс</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th style="width:20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lessons as $lesson)

                                <tr>
                                    <td>{{$lesson['id']}}</td>
                                    <td>{{$lesson['name']}}</td>
                                    <td>{{$lesson-> courses -> name ?? ''}}</td>
                                    <td>{{ Str::limit($lesson['created_at'], $limit = 10, $end = '') }}
                                    </td>
                                    <td>{{ Str::limit($lesson['updated_at'], $limit = 10, $end = '') }}
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-success btn-sm" href="{{ route('lessons.edit', $lesson['id']) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('lessons.destroy', $lesson['id']) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">
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
                {{ $lessons->links()  }}
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
