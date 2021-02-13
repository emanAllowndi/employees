@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">حضور الموظفين</span>
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
                                <th>عدد ايام الحضور</th>
                                <th>عدد ايام الغياب </th>
                                <th>عدد ايام العطل  </th>
                                <th>عدد ايام الاجازات </th>

                                <th>ملاحظات </th>
                                <th>الانضباط في الدوام </th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances as $attendance)
                                <tr>

                                    <td>{!! $attendance->emp->emp_name !!} {!! $attendance->emp->second_name !!} {!! $attendance->emp->third_name !!} {!! $attendance->emp->last_name !!}</td>

                                    <td>{!! $attendance->att_days !!}</td>
                                    <td>{!! $attendance->absent_days !!}</td>
                                    <td>


                                        <?php
                                        $adate=$attendance->adate;
                                        $oh = DB::table('official_holidaies')->where('odate','=',$adate)->where('deleted_at','=',null)->sum('off_days');
                                        //dd($s);

                                        ?>
                                        {!! $oh !!}


                                    </td>
                                    <td>

                                        <?php


                                        $adate=$attendance->adate;
                                        $emp=$attendance->emp->id;

                                        $h = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');

                                        ?>
                                        {!! $h !!}

                                    </td>


                                    <td>{!! $attendance->note !!}</td>
                                    <?php
                                    $att=$attendance->att_days;
                                    // dd($att);
                                    $att=($att+$oh+$h);//هنا لاحتساب عدد ايام الحضور باعتبار  ايام الاجازة والعطل
                                    $absent=$attendance->absent_days;
                                    if(($att+$absent) != 0){
                                        $rate=($att/($att+$absent))*40;}
                                    else{
                                        $rate=0;
                                    }
                                    $rate=round($rate, 2);

                                    ?>
                                    <td>{!!$rate !!}  </td>


                                    <td>
                                    {!! Carbon\Carbon::parse( $attendance->adate)->format('Y-m')  !!}

                                    </td>


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
