@extends('admin.index')
@section('content')
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
            </div>
            <div class="portlet-body">
                {!! Form::open(['url'=>aurl('account'),'id'=>'account','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
                <div class="form-group col-md-6">
                    {!! Form::label('first_name',trans('admin.first_name'),['class'=>'control-label']) !!}
                    <div class="">
                        {!! Form::text('first_name',admin()->user()->first_name,['class'=>'form-control','placeholder'=>trans('admin.first_name')]) !!}
                    </div>
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('middel_name',trans('admin.middel_name'),['class'=>'control-label']) !!}
                    <div class="">
                        {!! Form::text('middel_name',admin()->user()->middel_name,['class'=>'form-control','placeholder'=>trans('admin.middel_name')]) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('last_name',trans('admin.last_name'),['class'=>'control-label']) !!}
                    <div class="">
                        {!! Form::text('last_name',admin()->user()->last_name,['class'=>'form-control','placeholder'=>trans('admin.last_name')]) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
                    <div class="">
                        {!! Form::text('email',admin()->user()->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('photo_profile',trans('admin.photo_profile'),['class'=>'control-label']) !!}
                            <div class="">
                                {!! Form::file('photo_profile',['class'=>'form-control','placeholder'=>trans('admin.photo_profile')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if(!empty(admin()->user()->photo_profile))
                            <img src="{{ it()->url(admin()->user()->photo_profile) }}" style="width:50px;height:50px;" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-6">
                    {!! Form::label('password',trans('admin.password'),['class'=>'control-label']) !!}
                    <div class="">
                        {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('password_confirmation',trans('admin.password_confirmation'),['class'=>' control-label']) !!}
                    <div class="">
                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>trans('admin.password_confirmation')]) !!}
                    </div>
                </div>
                <DIV class="clearfix"></DIV>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    {!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
@endsection
