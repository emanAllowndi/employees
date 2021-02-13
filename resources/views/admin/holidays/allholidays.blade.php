@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">اجازات الموظفين</span>
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
                                <th>نوع الاجازة</th>
                                <th>الوصف</th>
                                <th>عدد ايام الاجازة  </th>
                               <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($holidays as $holiday)
                                <tr>
                                    <?php
                                    $emp=$holiday->emp_id;
                                    $empname=DB::table('emps')->where('id','=',$emp)->first();


                                    ?>

                                        <td>{!! $empname->emp_name !!} {!! $empname->second_name !!} {!! $empname->third_name !!} {!! $empname->last_name !!}</td>
                                        <?php
                                        $type=$holiday->holidaytype_id;
                                        $typename=DB::table('holidaytypes')->where('id','=',$type)->first();
                                                 ?>
                                    <td>{!! $typename->holidaytype !!}</td>
                                    <td>{!! $holiday->holiday_desc  !!}</td>
                                        <td>{!! $holiday->holidays_days !!}</td>



                                    <td>{!! $holiday->hdate !!}</td>



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
