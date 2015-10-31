@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">修改客户案例</div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" action="{{ URL('internal/companies/'.$company->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="companyName">客户案例名称</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="{{ $company->name }}">
                        </div>
                        <p class="help-block col-sm-offset-2 col-sm-8">格式：公司名_产品名</p>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="companyIndustry">所属行业</label>
                        <div class="col-sm-8">
                            <select id="" class="form-control" name="industry_id">          
                                <option value="1" @if ($company->industry_id == 1) selected @endif>餐饮o2o</option>
                                <option value="2" @if ($company->industry_id == 2) selected @endif>社区</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-default">提交</button>&emsp;
                            <button class="btn btn-danger" onclick="if (!confirm('确认删除操作？硬删除后数据无法恢复！')) return false; $('input[name=_method]').val('DELETE');">删除</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
