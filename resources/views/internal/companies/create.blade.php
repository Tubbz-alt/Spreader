@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">创建公司</div>
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

                <form class="form-horizontal" action="{{ URL('internal/companies') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="companyName" class="col-md-2 control-label">客户案例名称</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <p class="help-block col-md-offset-2 col-md-8">格式：公司名_产品名</p>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="companyIndustry">所属行业</label>
                        <div class="col-md-8">
                            <select id="" name="industry_id" class="form-control">
                                <option value="1" @if (old('industry_id') == 1) selected @endif>餐饮o2o</option>
                                <option value="2" @if (old('industry_id') == 2) selected @endif>社区</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button class="btn btn-default">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
