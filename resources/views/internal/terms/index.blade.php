@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">场景标签</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>场景</th>
                        <th>创建时间</th>
                        <th>活动次数</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($terms as $term)
                        <tr>
                            <th>{{ $term->id }}</th>
                            <td>{{ $term->name }}</td>
                            <td>{{ $term->created_at }}</td>
                            <td>{{ $term->id }}</td>
                            <td>
                                <a href="{{ URL('internal/terms/'.$term->id.'/edit') }}">修改</a>&nbsp;
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
