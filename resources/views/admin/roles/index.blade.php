@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">الادوار</span>
                    </div>
                    <div class="actions">

                                            <a class="btn btn-warning btn-circle"  href="{{route('roles.create')}}"
                                                    data-toggle="tooltip" title=" اضافة دور" style="background-color: #459102; border: #459102;">
                                                       <i class="fa fa-user-plus"></i>

                                          </a>

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
                                <th> الوصف</th>



                                <th>ادارة</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>

                                    <td>{!! $role->display_name !!} </td>

                                    <td>{!! $role->description !!}</td>




                                    <td style="width: 270px;">
                                        @if(auth()->guard('admin')->user()->hasPermission('read_users'))


                                            <a  class="btn btn-info btn-circle"  href="{{aurl('/roles/'.$role->id)}}"
                                                data-toggle="tooltip" title="عرض الدور">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endif
                                        @if(auth()->guard('admin')->user()->hasPermission('update_users') )


                                            <a class="btn btn-warning btn-circle"  href="{{route('roles.edit',$role->id)}}"
                                               data-toggle="tooltip" title="تعديل الدور">
                                                <i class="fa fa-pencil"></i>

                                            </a>
                                        @endif
                                        @if(auth()->guard('admin')->user()->hasPermission('delete_users'))


                                            <a  class="btn btn-danger btn-circle"
                                                data-toggle="modal" data-target="#delete_record{{$role->id}}" href="#" type="button"

                                                title="حذف الدور">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif

                                    </td>

                                    <div class="modal fade" id="delete_record{{$role->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" data-dismiss="modal">x</button>
                                                    <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$role->id}}) ؟
                                                </div>
                                                <div class="modal-footer">
                                                    {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['roles.destroy', $role->id]
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
