@extends('admin.index')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('roles/create')}}"
                           data-toggle="tooltip" title="{{trans('admin.departments')}}">
                            <i class="fa fa-plus"></i>
                        </a>

                       <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/roles')}}"
                           data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.roles')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <b>{{trans('admin.id')}} :</b> {{$roles->id}}
                        </div>
                        <div class="clearfix"></div>
                        <hr />



                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>اسم الدور :</b>
                            {!! $roles->display_name !!}
                        </div>


                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>الوصف  :</b>
                            {!! $roles->description !!}
                        </div>

                    </div>


                    <div class="col-md-12">
                    <div class="col-md-4 col-lg-4 col-xs-4">

                        <br>

                        <b>   صلاحيات الدور  :</b>
                        <br>
                        <br>

                       @php
                       $pers=DB::table('permission_role')->where('role_id','=',$roles->id)->get();

                       @endphp
                        @foreach($pers as $per)
                            <?php
                            $pername=DB::table('permissions')->where('id','=',$per->permission_id)->first();

                            ?>
                            {!! $pername->display_name !!}
                            <br>
                       @endforeach
                    </div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>
@stop
