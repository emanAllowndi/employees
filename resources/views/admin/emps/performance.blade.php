@extends('admin.index')
@section('header')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
@stop

@section('content')

    <?php
    use App\Model\behavior;use App\Model\training;$year = session()->get('year');

    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">بيانات الموظفين   </span>
                    </div>
                    <div class="actions">


                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>




                    </div>
                </div>







                    <!-- /.card-header -->
                    <div class="card-body printall">

                        <table id="example9" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>المسؤول المشرف</th>
                                <th>القسم</th>
                                <th>الادارة</th>
                                <th>الادارة العامة</th>
                                <th>القطاع </th>
                                <th>الوظيفة </th>

                                <th>الدوام</th>
                                <th>المهام </th>
                                <th>الاذون </th>
                                <th>السلوك </th>
                                <th>عدد الدورات </th>
                                <th>الاجازات </th>
                                <th>نسبة الانضباط </th>
                                <th>الحافز </th>
                                <th>التاريخ</th>



                            </tr>
                            </thead>
                            <tbody>




                            @foreach($attendances as $attendance)
                                <?php
                                $allemps=DB::table('emps')->where('id','=',$attendance->emp_id)->where('deleted_at','=',null)->get();
                                // dd($empatts);

                                ?>
                                @foreach($allemps as $allemp)



                                    <tr>

                                        <td>

                                            {!! $allemp->emp_name !!} {!! $allemp->second_name !!} {!! $allemp->third_name !!} {!! $allemp->last_name !!}

                                        </td>

                                            <?php

                                            $username=DB::table('users')->select('first_name')->where('id','=',$allemp->user_id)->first();

                                            ?>
                                            @if($username===null)
                                                <td>  لا يوجد مسؤول مشرف </td>
                                            @else
                                                <td>

                                                    {!! $username->first_name !!}
                                                </td>
                                            @endif
                                            <?php

                                            $departmentname=DB::table('departments')->select('department_name')->where('id','=',$allemp->department_id)->first();

                                            ?>
                                            @if($departmentname===null)
                                                <td> لا يوجد قسم </td>
                                            @else
                                                <td>

                                                    {!! $departmentname->department_name !!}
                                                </td>
                                            <?php
                                        $departadmin=DB::table('departments')->select('administration_id')->where('id','=',$allemp->department_id)->first();
                                        $admin=$departadmin->administration_id;
                                        $adminstrationname=DB::table('administrations')->select('administration')->where('id','=',$departadmin->administration_id)->first();
                                        ?>
                                        @endif
                                        @if($departmentname===null)
                                            <td> لا يوجد ادارة</td>
                                        @else
                                        <td>

                                            {!!  $adminstrationname->administration !!}
                                        </td>

                                        <?php

                                        $public=DB::table('public_admins')->select('publicAdmin','id','sector_id')->where('id','=',$admin)->first();
                                        ?>
                                        @endif
                                        @if($departmentname===null)
                                            <td>  لا يوجد ادارة عامة</td>
                                        @else
                                        <td>

                                            {!! $public->publicAdmin !!}
                                        </td>

                                        <?php

                                        $sector=DB::table('sectors')->select('sector')->where('id','=',$public->sector_id)->first();

                                        ?>
                                        @endif
                                        @if($departmentname===null)
                                            <td> لا يوجد قطاع </td>
                                        @else
                                        <td>

                                            {!! $sector->sector !!}
                                        </td>
                                        @endif


                                        <?php

                                        $jobname=DB::table('jobs')->select('job_name')->where('id','=',$allemp->job_id)->first();

                                        ?>
                                        @if($jobname===null)
                                            <td> لا يوجد وظيفة</td>
                                        @else
                                        <td>

                                            {!! $jobname->job_name !!}
                                        </td>
                                        @endif
                                        <?php

                                        $oh = DB::table('official_holidaies')->where('odate','=',$attendance->adate)->where('deleted_at','=',null)->where('oyear','=',$year)->sum('off_days');
                                        $h = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hdate','=',$attendance->adate)->where('hyear','=',$year)->where('deleted_at','=',null)->sum('holidays_days');
                                        $att=$attendance->att_days;
                                        $att=($att+$oh+$h);//هنا لاحتساب عدد ايام الحضور باعتبار  ايام الاجازة والعطل
                                        $absent=$attendance->absent_days;
                                        if(($att+$absent) != 0){
                                            $rate=($att/($att+$absent))*40;}
                                        else{
                                            $rate=0;
                                        }
                                        $rate=round($rate, 2);

                                        ?>

                                        <td>
                                            {!!$rate!!}

                                        </td>
                                        <?php
                                        $adate=$attendance->adate;
                                        $ratesum = DB::table('tasks')->where('emp_id','=',[$allemp->id])->where('tdate','=',$adate)->where('tyear','=',$year)->where('deleted_at','=',null)->where('tyear','=',$year)->sum('task_rate');
                                        $taskcount = DB::table('tasks')->where('emp_id','=',[$allemp->id])->where('tdate','=',$adate)->where('tyear','=',$year)->where('deleted_at','=',null)->where('tyear','=',$year)->count('id');

                                        if($taskcount != 0){
                                            $taskperformance=$ratesum/$taskcount;}
                                        else{
                                            $taskperformance=40;
                                        }

                                        $taskperformance=round($taskperformance,2);

                                        ?>
                                        @if($taskcount != 0)
                                            <td>
                                                {!!$taskperformance!!}

                                            </td>

                                        @else
                                            <td>
                                                لايوجد مهام
                                            </td>
                                        @endif

                                        <?php


                                        $perscount = DB::table('pers')->where('emp_id','=',[$allemp->id])->where('pdate','=',$adate)->where('pyear','=',$year)->where('deleted_at','=',null)->count('id');

                                        if($perscount>2){
                                            $perscount=$perscount-2;
                                        }
                                        else{

                                            $perscount=0;
                                        }



                                        $persperformance=5-($perscount/2);
                                        $persperformance=round($persperformance,2)
                                        // dd($taskperformance);

                                        ?>
                                        <td>
                                            {!! $persperformance !!}

                                        </td>
                                        <?php


                                        $behaviors=behavior::with('emp')->where('emp_id','=',[$allemp->id])->where('beyear','=',$year)->where('bedate','=',$adate)->where('deleted_at','=',null)->first();
                                        $de=0;
                                        ?>
                                        @if($behaviors !=null)

                                            @php
                                                $de=$behaviors->behavior;
                                            @endphp
                                        @endif



                                        <td>


                                            {!! $de!!}

                                        </td>
                                        <?php
                                        $trainings=training::with('emp')->where('emp_id','=',[$allemp->id])->where('trayear','=',$year)->where('tradate','=',$adate)->where('deleted_at','=',null)->first();
                                        if($trainings != null){
                                            if($trainings->coursenum > 0)
                                                $tranper=5;
                                            else{
                                                $tranper=0;

                                            }
                                        }
                                        else{
                                            $tranper=0;

                                        }


                                        ?>
                                        <td>


                                            {!! $tranper!!}
                                        </td>

                                        <?php
                                        $ratesum = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hdate','=',$adate)->where('hyear','=',$year)->where('deleted_at','=',null)->sum('holidays_days');
                                        if($ratesum>3){
                                            $ratesum=$ratesum-3;
                                        }
                                        else{

                                            $ratesum=0;
                                        }


                                        $holidaycount = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hdate','=',$adate)->where('hyear','=',$year)->where('deleted_at','=',null)->count('id');
                                        $holidaysperformance=5-($ratesum/2);
                                        $holidaysperformance=round($holidaysperformance,2);
                                        // dd($taskperformance);


                                        ?>
                                        <td>
                                            {!! $holidaysperformance !!}

                                        </td>

                                        <?php
                                        $total=$taskperformance+$rate+$holidaysperformance+$persperformance+$de+$tranper;
                                        $total=round($total, 2);
                                        ?>
                                        <td>

                                            {!!$total!!}
                                        </td>
                                        <?php
                                        $motivation=$allemp->motivation;
                                        $money=($motivation*$total )/100;
                                        $money= number_format($money, 2, '.', ',');

                                        ?>
                                        <td>
                                            {!! $money !!} ريال يمني

                                        </td>
                                        <td>

                                            {!! Carbon\Carbon::parse( $attendance->adate)->format('Y-m')  !!}


                                        </td>




                                    </tr>
                            <tfoot>


                            </tfoot>

                                @endforeach
                            @endforeach



                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>


@stop
