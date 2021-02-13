@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">المستخدمين</span>
                    </div>
                    <div class="actions">
                        @if(auth()->guard('admin')->user()->hasPermission('create_users') )


{{--                            <a class="btn btn-warning btn-circle"  href="{{route('users.createfromuser')}}"--}}
{{--                               data-toggle="tooltip" title=" اضافة مستخدم" style="background-color: #459102; border: #459102;">--}}
{{--                                <i class="fa fa-user-plus"></i>--}}

{{--                            </a>--}}
                        @endif

                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>




                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th> البريد الالكتروني</th>
                                <th> دور المستخدم</th>



                                <th>ادارة</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>

                                    <td>{!! $user->first_name !!} {!! $user->middel_name !!} {!! $user->last_name !!} </td>

                                    <td>{!! $user->email !!}</td>
                                    @php
                                    $id=DB::table('role_user')->where('user_id','=',$user->id)->first();
                                    $role=DB::table('roles')->where('id','=',$id->role_id)->first();
                                    @endphp
                                    <td>{!! $role->display_name !!}</td>



                                    <td style="width: 270px;">
                                        @if(auth()->guard('admin')->user()->hasPermission('read_users'))


                                        <a  class="btn btn-info btn-circle"  href="{{aurl('/users/show/'.$user->id)}}"
                                            data-toggle="tooltip" title="عرض المستخدم">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @endif
                                            @if(auth()->guard('admin')->user()->hasPermission('update_users') )


                                            <a class="btn btn-warning btn-circle"  href="{{route('users.edit',$user->id)}}"
                                           data-toggle="tooltip" title="تعديل المستخدم">
                                            <i class="fa fa-pencil"></i>

                                        </a>
                                            @endif
                                            @if(auth()->guard('admin')->user()->hasPermission('delete_users'))


                                            <a  class="btn btn-danger btn-circle"
                                                data-toggle="modal" data-target="#delete_record{{$user->id}}" href="#" type="button"

                                                title="حذف المستخدم">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                                @endif

                                    </td>

                                    <div class="modal fade" id="delete_record{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" data-dismiss="modal">x</button>
                                                    <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$user->id}}) ؟
                                                </div>
                                                <div class="modal-footer">
                                                    {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['users.destroy', $user->id]
                                                    ]) !!}
                                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>


@stop
