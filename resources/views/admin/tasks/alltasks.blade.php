@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">مهام الموظفين</span>
                    </div>
                    <div class="actions">


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
                                <th>اسم المهمة</th>
                                <th>الوصف </th>
                                <th>الايام</th>
                                <th>الحالة </th>

                                <th>التقييم</th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <?php
                                    $emp=$task->emp_id;
                                    $empname=DB::table('emps')->where('id','=',$emp)->first();


                                    ?>
                                    <td>{!! $empname->emp_name !!} {!! $empname->second_name !!} {!! $empname->third_name !!} {!! $empname->last_name !!}</td>

                                    <td>{!! $task->task_name !!}</td>
                                    <td>{!! $task->task_desc !!}</td>
                                        <td>{!! $task->days !!}</td>

                                        <td>{!! $task->status !!}</td>



                                        <td>{!! $task->task_rate !!}</td>



                                    <td>{!!  Carbon\Carbon::parse($task->tdate)->format('Y-m') !!}</td>



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
