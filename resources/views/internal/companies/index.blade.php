@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">客户案例</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>公司_产品名</th>
                        <th>所属行业</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <th>{{ $company->id }}</th>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->industry_id }}</td>
                            <td>{{ $company->created_at }}</td>
                            <td>
                                <a href="{{ URL('internal/companies/'.$company->id.'/edit') }}">修改</a>&nbsp;
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
