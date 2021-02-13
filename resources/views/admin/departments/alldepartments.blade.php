@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">الاقسام</span>
                    </div>
                    <div class="actions">


                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>




                    </div>
                </div>



                <div class="card">
                    @if(auth()->guard('admin')->user()->hasPermission('create_users') )

                        <a href="{{route('departments.create')}}"  class="btn btn-success">اضافة</a>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>القسم </th>
                                <th>الادارة </th>

                                <th>ادارة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>

                                    <td>{!! $department->department_name  !!}</td>

<!--                                    --><?php
//                                    $ad=DB::table('administrations')->where('id','=',$department->administration_id )->first();
//                                    ?>


                                    <td>{!! $department->administration->administration  !!}</td>

                                    <td style="width: 350px;">
                                        @if(auth()->guard('admin')->user()->hasPermission('create_users'))


                                            <a  href="{{aurl('/departments/'.$department->id)}}" type="submit" class="btn btn-info">عرض</a>
                                        @endif
                                        @if(auth()->guard('admin')->user()->hasPermission('create_users') )

                                            <a href="{{route('departments.edit',$department->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                        @endif
                                        @if(auth()->guard('admin')->user()->hasPermission('create_users') )

                                            <a data-toggle="modal" data-target="#delete_record{{$department->id}}" href="#" type="button" class="btn btn-danger">حذف</a>
                                        @endif
                                    </td>
                                    <div class="modal fade" id="delete_record{{$department->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" data-dismiss="modal">x</button>
                                                    <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$department->id}}) ؟
                                                </div>
                                                <div class="modal-footer">
                                                    {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['departments.destroy', $department->id]
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
