@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">تعديل دور</span>
                    </div>
                    <div class="actions">
                        <a  href="{{aurl('roles')}}"
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
                <div class="portlet-body form">
                    <div class="col-md-12">
                        {!! Form::open(['url'=>aurl('/roles/'.$roles->id),'method'=>'put','id'=>'departments','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}


                        <div class="form-group">
                            {!! Form::label('role',trans('admin.role'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('role',$roles->display_name,['class'=>'form-control','placeholder'=>trans('admin.role')]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            {!! Form::label('role_desc',trans('admin.role_desc'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('role_desc',$roles->description,['class'=>'form-control','placeholder'=>trans('admin.role_desc')]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                    {{trans('admin.permissions')}}
                                </h3>
                            </div>
                            <div class="card-body">
                                <h4>تحديد صلاحيات المستخدمين</h4>


                                @php
                                    $models=['users','departments', 'jobs','tasks','pers','emps','attendances','holidaytypes'];
                                    $maps=['create','read','update','delete'];
                                @endphp
                                <ul class="nav nav-tabs">
                                    @foreach($models as $index=>$model)
                                        <li class="{{$index ==0? 'active' :''}}"><a href="#{{$model}}" data-toggle="tab"{{$model}}>{{trans('admin.'. $model)}}</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content" style="padding:10px;">
                                    @foreach($models as $index=>$model)




                                        <div class="tab-pane {{$index == 0 ? 'active' :''}}" id="{{ $model }}" >



                                            <div class="form-check">
                                                @foreach($maps as $map)

                                                    <input type="checkbox" name ="permissions[]" {{$roles->hasPermission($map.'_'.$model) ?'checked':''}} value="{{$map.'_'.$model}}" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1"> {{trans('admin.'. $map)}}</label>
                                                    <br>

                                                @endforeach
                                            </div>

                                        </div>

                                    @endforeach

                                </div>


                            </div>
                            <!-- /.card -->

                        </div>
                        <br>

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

