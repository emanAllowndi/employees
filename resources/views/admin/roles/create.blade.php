@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">انشاء دور</span>
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

                        {!! Form::open(['url'=>aurl('/roles'),'id'=>'roles','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="form-group">
                            {!! Form::label('role',trans('admin.role'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('role',old('role'),['class'=>'form-control','placeholder'=>trans('admin.role')]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            {!! Form::label('role_desc',trans('admin.role_desc'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('role_desc',old('role_desc'),['class'=>'form-control','placeholder'=>trans('admin.role_desc')]) !!}
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

                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#USER" data-toggle="tab">المستخدمين</a></li>
                                    <li><a href="#emps" data-toggle="tab">الموظفين</a></li>
                                    <li><a href="#deps" data-toggle="tab">الاقسام</a></li>
                                    <li><a href="#jobs" data-toggle="tab">الوظائف</a></li>
                                    <li><a href="#oholidays" data-toggle="tab">العطل</a></li>
                                    <li><a href="#holidays" data-toggle="tab">الاجازات</a></li>
                                    <li><a href="#attendance" data-toggle="tab">الدوام</a></li>
                                    <li><a href="#tasks" data-toggle="tab">المهام</a></li>
                                    <li><a href="#pers" data-toggle="tab">الاذون</a></li>

                                </ul>

                                <div class="tab-content" style="padding:10px;">
                                    <div id="USER" class="tab-pane active">

                                        <div class="form-check">






                                            <input type="checkbox" name ="permissions[]" value="create_users" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_users" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_users"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_users" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>


                                    </div>


                                    <div id="emps" class="tab-pane">



                                        <div class="form-check">

                                            <input type="checkbox" name ="permissions[]" value="create_emps" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_emps" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_emps"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_emps" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>

                                    </div>
                                    <div id="deps" class="tab-pane">


                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_departments" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_departments" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_departments"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_departments" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>

                                    </div>
                                    <div id="jobs" class="tab-pane">

                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_jobs" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_jobs" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_jobs"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_jobs" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>

                                    </div>
                                    <div id="oholidays" class="tab-pane">



                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_official_holidaies" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_official_holidaies" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_official_holidaies"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_official_holidaies" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>

                                    </div>
                                    <div id="holidays" class="tab-pane">



                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_holidaies" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_holidaies" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_holidaies"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_holidaies" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>

                                    </div>
                                    <div id="attendance" class="tab-pane">


                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_attendances" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_attendances" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_attendances"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_attendances" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>
                                    </div>
                                    <div id="tasks" class="tab-pane">

                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_tasks" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_tasks" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_tasks"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_tasks" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>
                                    </div>
                                    <div id="pers" class="tab-pane">

                                        <div class="form-check">
                                            <input type="checkbox" name ="permissions[]" value="create_pers" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.create')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="read_pers" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.read')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="update_pers"  class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.update')}}</label>
                                            <br>
                                            <input type="checkbox" name ="permissions[]" value="delete_pers" class="form-check-input">
                                            <label class="form-check-label" for="exampleCheck1"> {{trans('admin.delete')}}</label>
                                            <br>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <!-- /.card -->
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

