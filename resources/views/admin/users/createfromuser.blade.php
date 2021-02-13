@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">

								<span class="caption-subject bold uppercase font-dark">

اضافة مستخدم                                </span>
                    </div>
                    <div class="actions">
                        <div class="actions" method="post">

                        <a  href="{{route('users.storefromuser')}}"
                            class="btn btn-circle btn-icon-only btn-default"
                            tooltip="{{trans('admin.show_all')}}"
                            title="{{trans('admin.show_all')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                           href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">

                        {!! Form::open([route('users.storefromuser'),'files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

                        <div class="form-group">
                            {!! Form::label('first_name',trans('admin.first_name'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('first_name',old('first_name'),['class'=>'form-control','placeholder'=>trans('admin.first_name')]) !!}
                            </div>
                        </div>
                        <br><div class="form-group">
                            {!! Form::label('middel_name',trans('admin.middel_name'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('middel_name',old('middel_name'),['class'=>'form-control','placeholder'=>trans('admin.middel_name')]) !!}
                            </div>
                        </div>
                        <br><div class="form-group">
                            {!! Form::label('last_name',trans('admin.last_name'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('last_name',old('last_name'),['class'=>'form-control','placeholder'=>trans('admin.last_name')]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            {!! Form::label('email',trans('admin.email'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            {!! Form::label('password',trans('admin.password'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">

                                {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) !!}
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            {!! Form::label('password_confirmation',trans('admin.password_confirmation'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">

                                {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>trans('admin.password_confirmation')]) !!}
                            </div>
                        </div>
                        <br>


                        <div class="form-group">
                            {!! Form::label('photo_profile',trans('admin.photo_profile'),['class'=>'control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::file('photo_profile',['class'=>'form-control','placeholder'=>trans('admin.photo_profile')]) !!}
                            </div>
                        </div>
                        <br>


                        <div class="form-group">
                            <label for="department">دور المستخدم</label>
                            <?php

                            $roles=DB::table('roles')->get();
                            ?>

                            <select class="form-control select2bs4" name="role" >
                                @foreach($roles as $role)
                                    <option value="{!! $role->id !!}" name="role" >
                                        {!! $role->display_name  !!}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <br>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            {!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


        </div>
    </div>
@stop

