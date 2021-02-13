<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{url('bootstrap/css')}}/bootstrap-rtl.css" rel="stylesheet" type="text/css" />
{{--    <link href="{{url('design/admin_panel')}}/assets/global/css/font-awesome-rtl.min.css" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{url('design/admin_panel')}}/assets/global/css/ionicons.min.css" rel="stylesheet" type="text/css" />--}}




</head>

<body>


<div id="printpage" class=" container-fluid  text-right printall2 page" style="width:100%;margin-left: 0px !important;margin-right: 0px !important;">
<div class="row" style="width: 100%">
    <div style="width: 35%; padding-top: 50px;padding-left: 100px;" class="text-left">التاريخ</div>

    <div style="width: 30%" class="text-center">
           <img src="{{asset('nsr.png')}}" style="width:150px;height: 100px;">

       </div>
    <div style="width: 35%; padding-top: 50px;padding-right: 100px;" >الجمهورية اليمنية</div>

</div>
    <hr style="color:#000;">
    <h3 style="text-underline: #000" class="text-center"> تقرير عن اداء الموظفين للفترة </h3><br>

    <table class="table table-bordered" style="width:100%;margin-left: 0px;margin-right: 0px;" dir="rtl">
        <tr style="border: 2px solid black;">
            <th style="border: 2px solid black; text-align: center;width:20%">اسم الموظف</th>
            <th  style="border: 1px solid black; text-align: center; width: 20%;">المسؤول المشرف</th>
            <th  style="border: 2px solid black; text-align: center; width: 10%;">القسم</th>

            <th  style="border: 2px solid black; text-align: center; width: 10%;">الوظيفة </th>

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




        @foreach($attendances as $attendance)
            <?php

            $allemps=DB::table('emps')->where('id','=',$attendance->emp_id)->where('deleted_at','=',null)->get();
            // dd($empatts);

            ?>
            @foreach($allemps as $allemp)



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

                    <?php

                    $jobname=DB::table('jobs')->select('job_name')->where('id','=',$allemp->job_id)->first();

                    ?>
                    <td style="border: 2px solid black; text-align: right;">

                        {!! $jobname->job_name !!}
                    </td>
                    <?php

                    $oh = DB::table('official_holidaies')->where('odate','=',$attendance->adate)->where('deleted_at','=',null)->sum('off_days');
                    $h = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hdate','=',$attendance->adate)->where('deleted_at','=',null)->sum('holidays_days');
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
                    $ratesum = DB::table('tasks')->where('emp_id','=',[$allemp->id])->where('tdate','=',$adate)->where('deleted_at','=',null)->sum('task_rate');
                    $taskcount = DB::table('tasks')->where('emp_id','=',[$allemp->id])->where('tdate','=',$adate)->where('deleted_at','=',null)->count('id');

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
                        <td style="border: 2px solid black; text-align: right;">
                            لايوجد مهام
                        </td>
                    @endif

                    <?php


                    $perscount = DB::table('pers')->where('emp_id','=',[$allemp->id])->where('pdate','=',$adate)->where('deleted_at','=',null)->count('id');

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
                    $ratesum = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                    if($ratesum>3){
                        $ratesum=$ratesum-3;
                    }
                    else{

                        $ratesum=0;
                    }


                    $holidaycount = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hdate','=',$adate)->where('deleted_at','=',null)->count('id');
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


