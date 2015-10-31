@extends('layout.internal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">创建项目</div>
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

                <form class="form-horizontal" action="{{ URL('internal/projects') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="company">客户案例</label>
                        <div class="col-md-8">
                            <select id="" class="form-control" name="company_id">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id}}" @if (old('company_id') == $company->id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="projectName">项目名</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="promotionLink">推广链接</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="promotion_link" value="{{ old('promotion_link') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="projectType">项目类型</label>
                        <div class="col-md-8">
                            <select id="" class="form-control" name="type">
                                <option value="1" @if (old('type') == 1) selected @endif>派单</option>
                                <option value="2" @if (old('type') == 2) selected @endif>扫码送礼</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="projectDescription">项目描述</label>
                        <div class="col-md-8">
                            <textarea id="" class="form-control" name="description" cols="30" rows="5">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="projectRemark">项目备注</label>
                        <div class="col-md-8">
                            <textarea id="" class="form-control" name="remark" cols="30" rows="5">{{ old('remark') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="projectStatus">项目状态</label>
                        <div class="col-md-8">
                            <select id="" name="status" class="form-control">
                                <option value="0">待定（与客户谈判中）</option>
                                <option value="1">开始（开始项目，生成按天任务）</option>
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
