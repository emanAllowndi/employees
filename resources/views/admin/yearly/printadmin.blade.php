<!DOCTYPE html>
<html lang="en">
<head>
    <title>تقارير</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{url('bootstrap/css')}}/bootstrap-rtl.css" rel="stylesheet" type="text/css" />
    {{--    <link href="{{url('design/admin_panel')}}/assets/global/css/font-awesome-rtl.min.css" rel="stylesheet" type="text/css" />--}}
    {{--    <link href="{{url('design/admin_panel')}}/assets/global/css/ionicons.min.css" rel="stylesheet" type="text/css" />--}}




</head>

<body>
<?php
$year = session()->get('year');

?>

<div id="printpage" class=" container-fluid  text-right printall2 page" style="width:100%;margin-left: 0px !important;margin-right: 0px !important;">

    <div class="row" style="width: 100%">
        <div style="width: 35%; padding-top: 0px;padding-left: 30px; font-size: small;" class="text-left">
            <img src="{{asset('left.png')}}" style="width:230px;height: 90px;">
            <br> <b style="width: 35%; padding-top: 0px;padding-left: 30px; font-size: x-small;" class="text-left">{!! date('Y-m-d') !!} : التاريخ
            </b>

        </div>

        <div style="width: 30%" class="text-center">
            <img src="{{asset('middel.png')}}" style="width:140px;height: 130px;">

        </div>
        <div  style="width: 35%; padding-top: 5px;padding-right:30px; font-size: medium" >

            <img src="{{asset('right.png')}}" style="width:200px;height: 100px;">

        </div>


    </div>
    <hr style="color:#000;">

<?php
    $admin = session()->get('admin');
    $from_date = session()->get('from_date');
    $to_date = session()->get('to_date');

    ?>


    @if(session()->has('admin') && session()->get('from_date') =="" )
        <?php
        $emp=  DB::table('emps')->where('deleted_at','=',null)->where('administration_id','=',$admin)->first();
        $admin=  DB::table('administrations')->where('deleted_at','=',null)->where('id','=',$admin)->first();

        ?>
        <span class="caption-subject bold uppercase font-dark" style="font-size: medium;">تقرير اداء ادارة {!! $admin->administration !!} </span>
    @elseif(!session()->has('admin')  &&  !session()->has('from_date') || $from_date="")
        <span class="caption-subject bold uppercase font-dark" style="font-size: medium;">تقرير اداء ادارة  </span>
    @elseif(session()->has('admin')  &&  session()->has('from_date'))
        <?php


        $emp=  DB::table('emps')->where('deleted_at','=',null)->where('administration_id','=',$admin)->first();
        $admin=  DB::table('administrations')->where('deleted_at','=',null)->where('id','=',$admin)->first();


        ?>

        <span class="caption-subject bold uppercase font-dark" style="font-size: medium;"> تقرير اداء ادارة {!! $admin->administration !!}
        من  {!! $from_date !!} الى {!! $to_date !!}
        </span>


    @endif
    @if(session()->has('admin'))


        <div class="card">
            <div class="card-header">
                تقرير اداء ادارة
            </div>
            <div class="card-body col-sm-12"
                 style="
                         padding-bottom: 30px;
                         padding-top: 10px;
                         border-left: 5px darkgray solid;
                         border-right: 5px darkgray solid";
            >


                <div style=" width: 50%; float:left;">
                    <h5> الادارة العامة :
                        <?php
                        $public_admin=DB::table('public_admins')->where('deleted_at','=',null)->where('id','=',$admin->publicAdmin_id )->first();
                        ?>
                        {!! $public_admin->publicAdmin !!}
                    </h5>
                </div>

                <div style=" width: 50%; float:right;">
                    <h5>القطاع :
                        <?php
                        $sector=DB::table('sectors')->where('deleted_at','=',null)->where('id','=',$public_admin->sector_id)->first();
                        ?>
                        {!! $sector->sector !!}
                    </h5>
                </div>

            </div>
        </div>
        <hr>
    @endif

    <table class="table table-bordered" style="width:100%;margin-left: 0px;margin-right: 0px;" dir="rtl">
        <tr style="border: 2px solid black;">

            <th style="border: 2px solid black; text-align: center; ">اسم الموظف</th>

            <th style="border: 2px solid black; text-align: center; ">المسؤول المشرف</th>

                <th style="border: 2px solid black; text-align: center;">القسم</th>
            @if(!session()->has('admin'))

            <th style="border: 2px solid black; text-align: center;">الادارة</th>
                <th style="border: 2px solid black; text-align: center; ">الادارة العامة</th>
                <th style="border: 2px solid black; text-align: center; width: 3%;">القطاع </th>
            @endif

            <th style="border: 2px solid black; text-align: center; width: 3%;">الوظيفة </th>
            <th  style="border: 2px solid black; text-align: center; width: 3%;">الدوام</th>
            <th  style="border: 2px solid black; text-align: center; width: 3%;">المهام </th>
            <th  style="border: 2px solid black; text-align: center; width: 3%;">الاذون </th>
            <th  style="border: 2px solid black; text-align: center; width: 3%;">الاجازات </th>
            <th style="border: 2px solid black; text-align: center; width: 3%;">نسبة الانضباط </th>

            <th  style="border: 2px solid black; text-align: center; width: 15%;">الحافز </th>
            <th style="border: 2px solid black; text-align: center; width: 10%;">التاريخ</th>



        </tr>
        </thead>
        <tbody>






        @foreach($allemps as $allemp)

            @if(session()->get('from_date') =="")

                <?php
                $attendances=  DB::table('attendances')->where('deleted_at','=',null)->where('emp_id','=',$allemp->id)->where('ayear','=',$year)->get();


                ?>
            @else
                <?php
                $attendances = DB::table('attendances')->where('deleted_at', '=', null)->where('emp_id','=',$allemp->id)->where('ayear','=',$year)->whereBetween('adate', [session()->get('from_date'), session()->get('to_date')])->get();

                ?>
            @endif
            @foreach($attendances as $attendance)


                <tr style="border: 2px solid black;">

                    <td style="border: 2px solid black; text-align: right;">

                        {!! $allemp->emp_name !!} {!! $allemp->second_name !!} {!! $allemp->third_name !!} {!! $allemp->last_name !!}

                    </td>
                    <?php

                    $username=DB::table('users')->select('first_name','middel_name','last_name')->where('id','=',$allemp->user_id)->first();

                    ?>
                    <td style="border: 2px solid black; text-align: right;">

                        {!! $username->first_name !!} {!! $username->middel_name !!} {!! $username->last_name !!}
                    </td>

                        <?php

                        $departmentname=DB::table('departments')->select('department_name')->where('id','=',$allemp->department_id)->first();

                        ?>
                        <td style="border: 2px solid black; text-align: right;">

                            {!! $departmentname->department_name !!}
                        </td>
                    @if(!session()->has('admin'))

                    <?php
                        $departadmin=DB::table('departments')->select('administration_id')->where('id','=',$allemp->department_id)->first();
                        $admin=$departadmin->administration_id;
                        $adminstrationname=DB::table('administrations')->select('administration')->where('id','=',$departadmin->administration_id)->first();
                        ?>
                        <td style="border: 2px solid black; text-align: right;">

                            {!!  $adminstrationname->administration !!}
                        </td>
                        <?php

                        $public=DB::table('public_admins')->select('publicAdmin','id','sector_id')->where('id','=',$admin)->first();
                        ?>
                        <td style="border: 2px solid black; text-align: right;">

                            {!! $public->publicAdmin !!}
                        </td>
                        <?php

                        $sector=DB::table('sectors')->select('sector')->where('id','=',$public->sector_id)->first();

                        ?>
                        <td style="border: 2px solid black; text-align: right;">

                            {!! $sector->sector !!}
                        </td>
                    @endif



                    <?php

                    $jobname=DB::table('jobs')->select('job_name')->where('id','=',$allemp->job_id)->first();

                    ?>
                    <td style="border: 2px solid black; text-align: right;">

                        {!! $jobname->job_name !!}
                    </td>
                    <?php

                    $oh = DB::table('official_holidaies')->where('odate','=',$attendance->adate)->where('oyear','=',$year)->where('deleted_at','=',null)->sum('off_days');
                    $h = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hyear','=',$year)->where('hdate','=',$attendance->adate)->where('deleted_at','=',null)->sum('holidays_days');
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

                    <td style="border: 2px solid black; text-align: right;">

                    {!!$rate!!}

                    </td>
                    <?php
                    $adate=$attendance->adate;
                    $ratesum = DB::table('tasks')->where('emp_id','=',[$allemp->id])->where('tyear','=',$year)->where('tdate','=',$adate)->where('deleted_at','=',null)->sum('task_rate');
                    $taskcount = DB::table('tasks')->where('emp_id','=',[$allemp->id])->where('tyear','=',$year)->where('tdate','=',$adate)->where('deleted_at','=',null)->count('id');

                    if($taskcount != 0){
                        $taskperformance=$ratesum/$taskcount;}
                    else{
                        $taskperformance=40;
                    }

                    $taskperformance=round($taskperformance,2);

                    ?>
                    @if($taskcount != 0)
                        <td style="border: 2px solid black; text-align: right;">

                        {!!$taskperformance!!}

                        </td>

                    @else
                        <td>
                            لايوجد مهام
                        </td>
                    @endif
                    <?php


                    $perscount = DB::table('pers')->where('emp_id','=',[$allemp->id])->where('pyear','=',$year)->where('pdate','=',$adate)->where('deleted_at','=',null)->count('id');

                    if($perscount>3){
                        $perscount=$perscount-3;
                    }
                    else{

                        $perscount=0;
                    }



                    $persperformance=10-($perscount/2);
                    $persperformance=round($persperformance,2)
                    // dd($taskperformance);

                    ?>
                    <td style="border: 2px solid black; text-align: right;">

                    {!! $persperformance !!}

                    </td>

                    <?php
                    $ratesum = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                    if($ratesum>3){
                        $ratesum=$ratesum-3;
                    }
                    else{

                        $ratesum=0;
                    }


                    $holidaycount = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->count('id');
                    $holidaysperformance=10-($ratesum/2);
                    $holidaysperformance=round($holidaysperformance,2);
                    // dd($taskperformance);


                    ?>
                    <td style="border: 2px solid black; text-align: right;">

                    {!! $holidaysperformance !!}

                    </td>

                    <?php
                    $total=$taskperformance+$rate+$holidaysperformance+$persperformance;
                    $total=round($total, 2);
                    ?>
                    <td style="border: 2px solid black; text-align: right;">


                    {!!$total!!}
                    </td>
                    <?php
                    $motivation=$allemp->motivation;
                    $money=($motivation*$total )/100;
                    $money= number_format($money, 2, '.', ',');

                    ?>
                    <td style="border: 2px solid black; text-align: right;">

                    {!! $money !!} ريال يمني

                    </td>
                    <td style="border: 2px solid black; text-align: right;">

                    {!! $attendance->adate !!}

                    </td>




                </tr>
            @endforeach
        @endforeach
        </tbody>

    </table>
</div>
<button type="button" name="printall2" id="printall2" class="btn btn-warning print-btn">عرض</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{--    <script src="{{url('design/admin_panel')}}/assets/global/plugins/printThis.js" type="text/javascript"></script>--}}
{{--    <script src="{{url('design/admin_panel')}}/assets/global/plugins/custom.js" type="text/javascript"></script>--}}
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/printThis.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

</body>
</html>


