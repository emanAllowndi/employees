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
        <div style="width: 35%; padding-top: 50px;padding-left: 100px; font-size: medium;" class="text-left">

            {!! date('Y-m-d') !!} : التاريخ

        </div>

        <div style="width: 30%" class="text-center">
            <img src="{{asset('nsr.png')}}" style="width:150px;height: 100px;">

        </div>
        <div  style="width: 35%; padding-top: 50px;padding-right: 100px; font-size: medium" >

            الجمهورية اليمنية
            <br>
        وزارة النقل
        </div>


    </div>
    <hr style="color:#000;">
    <div class="card">
        <div class="card-header">
            Quote
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
        </div>
    </div>

    <h3 style="text-underline: #000" class="text-center"> تقرير عن اداء الموظف {!! $emps->emp_name !!} {!! $emps->second_name !!} {!! $emps->third_name !!} {!! $emps->last_name !!} </h3><br>

    <table id="example5" class="table table-bordered table-striped printall" dir="rtl">
        <thead>
        <tr>
            <th>التاريخ</th>
            <th>نسبة انضباط المهام</th>
            <th>نسبة انضباط الدوام</th>
            <th>نسبة انضباط الاجازات</th>
            <th>نسبة انضباط الاذون</th>
            <th>نسبة الانضباط الكلي</th>
            <th>الحافز</th>

        </tr>
        </thead>
        <tbody>
        @foreach($attendances as $attendance)

            <tr>

                <td>
                    {!! Carbon\Carbon::parse($attendance->adate)->format('Y-m')!!}
                </td>
                <td>



                    <?php

                    $emp=$emps->id;


                    $adate=Carbon\Carbon::parse($attendance->adate)->format('Y-m-d');
                    $ratesum = DB::table('tasks')->where('emp_id','=',[$emp])->where('tdate','=',$adate)->where('deleted_at','=',null)->sum('task_rate');
                    $taskcount = DB::table('tasks')->where('emp_id','=',[$emp])->where('tdate','=',$adate)->where('deleted_at','=',null)->count('id');
                    if($taskcount != 0){
                        $taskperformance=$ratesum/$taskcount;}
                    else{
                        $taskperformance='لايوجد مهام';
                        $taskperformance=40;
                    }

                    $taskperformance=round($taskperformance,2);
                    ?>


                    <div class="progress" style="height: 18px;">

                        <div class="progress-bar bg-danger" role="progressbar" style="width:{!! $taskperformance !!}%"  aria-valuenow="{!! $taskperformance !!}%" aria-valuemin="0" aria-valuemax="40">
                            <span>{!! $taskperformance!!}%</span>
                        </div>
                    </div>
                </td>
                <td>
                    <?php

                    $oh = DB::table('official_holidaies')->where('odate','=',$adate)->where('deleted_at','=',null)->sum('off_days');
                    $h = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                    $att=$attendance->att_days;
                    $att=($att+$oh+$h);//هنا لاحتساب عدد ايام الحضور باعتبار  ايام الاجازة والعطل
                    $absent=$attendance->absent_days;
                    $rate=($att/($att+$absent))*40;
                    $rate=round($rate, 2);

                    ?>
                    <div class="progress" style="height: 18px;">

                        <div class="progress-bar bg-danger" role="progressbar" style="width:{!!$rate !!}%"  aria-valuenow="{!!$rate !!}%" aria-valuemin="0" aria-valuemax="40">
                            <span>{!!$rate !!}%</span>
                        </div>
                    </div>


                </td>
                <td>
                    <?php
                    $ratesum = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                    if($ratesum>3){
                        $ratesum=$ratesum-3;
                    }
                    else{

                        $ratesum=0;
                    }


                    $holidaycount = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hdate','=',$adate)->where('deleted_at','=',null)->count('id');
                    $holidaysperformance=10-($ratesum/2);
                    // dd($taskperformance);


                    ?>


                    <div class="progress" style="height: 18px;">

                        <div class="progress-bar bg-danger" role="progressbar" style="width:{!! $holidaysperformance !!}%"  aria-valuenow="{!! $taskperformance !!}%" aria-valuemin="0" aria-valuemax="40">
                            <span>{!! $holidaysperformance!!}%</span>
                        </div>
                    </div>

                </td>



                <td>

                    <?php
                    $emp=$emps->id;


                    $perscount = DB::table('pers')->where('emp_id','=',[$emp])->where('pdate','=',$adate)->where('deleted_at','=',null)->count('id');

                    if($perscount>3){
                        $perscount=$perscount-3;
                    }
                    else{

                        $perscount=0;
                    }



                    $persperformance=10-($perscount/2);
                    // dd($taskperformance);

                    ?>


                    <div class="progress" style="height: 18px;">

                        <div class="progress-bar bg-danger" role="progressbar" style="width:10%"  aria-valuenow="{!! $persperformance !!}%" aria-valuemin="0" aria-valuemax="40">
                            <span>{!! $persperformance!!}%</span>
                        </div>
                    </div>
                </td>
                <td>

                    <?php
                    $total=$taskperformance+$rate+$holidaysperformance+$persperformance;
                    $total=round($total, 2);
                    ?>
                    <div class="progress" style="height: 18px;">

                        <div class="progress-bar bg-danger" role="progressbar" style="width:{!!$total !!}%"  aria-valuenow="{!!$total!!}%" aria-valuemin="0" aria-valuemax="100">
                                                          <span>



                                                              {!!$total !!}%</span>
                        </div>
                    </div>
                </td>
                <td>

                    <?php
                    $motivation=$emps->motivation;
                    $money=($motivation*$total )/100;
                    $money= number_format($money, 2, '.', ',');

                    ?>
                    {!! $money !!} ريال يمني
                </td>

            </tr>
        @endforeach

        </tbody>
        <tfoot>

        </tfoot>
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


