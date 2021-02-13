@extends('admin.index')
@section('header')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
@stop

@section('content')
    <?php
    use App\Model\attendance;use App\Model\behavior;use App\Model\emp;use App\Model\publicAdmin;use App\Model\training;$year = session()->get('year');

    ?>

    <div class="row">
        <div class="col-md-9">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">

                        <?php
                        session_start();
                        session()->forget('publicadmin');
                        session()->forget('from_date');
                        session()->forget('to_date');

                        ?>
                        @if(Request::isMethod('get'))

                            <span class="caption-subject bold uppercase font-dark">تقرير اداء ادارة عامة   </span>

                        @endif
                        @if(Request::isMethod('post'))

                            <?php
                            session()->put('publicadmin', $_POST['publicadmin']);
                            session()->put('from_date', $_POST['from_date']);
                            session()->put('to_date', $_POST['to_date']);

                            $emp=  emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('publicadmin_id','=',$_POST['publicadmin'])->first();
                            $publicadmin=  publicAdmin::with('sector')->where('deleted_at','=',null)->where('id','=',$_POST['publicadmin'])->first();
                            ?>
                            @if(empty($_POST['from_date']) && isset($_POST['publicadmin']))
                                <span class="caption-subject bold uppercase font-dark">تقرير اداء ادارة عامة {!! $publicadmin->publicAdmin  !!} </span>




                            @endif
                            @if(isset($_POST['from_date']) && ($_POST['from_date'] !='') && isset($_POST['publicadmin']))
                                <span class="caption-subject bold uppercase font-dark">تقرير اداء ادارة {!! $publicadmin->publicAdmin !!}
                                                           من {!! $_POST['from_date'] !!} الى {!! $_POST['to_date'] !!}
                                                          </span>

                            @endif
                        @endif
                    </div>
                    <div class="actions">
                        <button type="button" name="ptn" id="ptn" class="btn btn-warning btn-circle"><i class="fa fa-print"></i></button>


                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>




                    </div>

                </div>
                <div class="print" dir="rtl">
                @if(isset($_POST['publicadmin']))


                    <div class="card">
                        <div class="card-header">
تقرير اداء ادارة عامة
                        </div>
                        <div class="card-body col-sm-12"
                             style="
                         padding-bottom: 30px;
                         padding-top: 10px;
                         border-left: 5px darkgray solid;
                         border-right: 5px darkgray solid"
                        >

                            <div class="row col-sm-12">



                                <div class="col-sm-6">
                                    <h5>القطاع :

                                        {!! $publicadmin->sector->sector !!}
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>
                @endif

                <div class="card-body ">

                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>اسم الموظف</th>
                            <th>المسؤول المشرف</th>

                            <th>القسم</th>

                                <th>الادارة</th>
                            @if(empty($_POST['publicadmin']))

                            <th>الادارة العامة</th>

                            <th>القطاع </th>
                            @endif
                            <th>الوظيفة </th>

                            <th>الدوام</th>
                            <th>المهام </th>
                            <th>الاذون </th>
                            <th>الاجازات </th>
                            <th>السلوك </th>
                            <th>الدورات التدريبية </th>
                            <th>نسبة الانضباط </th>
                            <th>الحافز </th>
                            <th>التاريخ</th>



                        </tr>
                        </thead>
                        <tbody>




                        @foreach($allemps as $allemp)

                            @if(empty($_POST['from_date']))

                                <?php
                                $attendances= attendance::with('emp')->where('deleted_at','=',null)->where('emp_id','=',$allemp->id)->where('ayear','=',$year)->get();


                                ?>
                            @else
                                <?php
                                $attendances= attendance::with('emp')->where('deleted_at', '=', null)->where('emp_id','=',$allemp->id)->where('ayear','=',$year)->whereBetween('adate', [$_POST['from_date'], $_POST['to_date']])->get();

                                ?>
                            @endif
                            @foreach($attendances as $attendance)




                                <tr>

                                    <td>

                                        {!! $allemp->emp_name !!} {!! $allemp->second_name !!} {!! $allemp->third_name !!} {!! $allemp->last_name !!}

                                    </td>

                                    <td>

                                        {!! $allemp->user->first_name !!}  {!! $allemp->user->middel_name !!}  {!! $allemp->user->last_name !!}
                                    </td>


                                    <td>

                                        {!! $allemp->department->department_name !!}
                                    </td>

                                        <td>

                                            {!!  $allemp->administration->administration !!}
                                        </td>

                                        <td>

                                            {!! $allemp->publicAdmin->publicAdmin !!}
                                        </td>


                                        <td>

                                            {!!  $allemp->sector->sector !!}
                                        </td>


                                    <td>

                                        {!! $allemp->job->job_name !!}
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

                                    <td>
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
                                        <td>
                                            {!!$taskperformance!!}

                                        </td>

                                    @else
                                        <td>
                                            لايوجد مهام
                                        </td>
                                    @endif
                                    <?php


                                    $perscount = DB::table('pers')->where('emp_id','=',[$allemp->id])->where('pyear','=',$year)->where('pdate','=',$adate)->where('deleted_at','=',null)->count('id');

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
                                    $ratesum = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                                    if($ratesum>3){
                                        $ratesum=$ratesum-3;
                                    }
                                    else{

                                        $ratesum=0;
                                    }


                                    $holidaycount = DB::table('holidaies')->where('emp_id','=',[$allemp->id])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->count('id');
                                    $holidaysperformance=5-($ratesum/2);
                                    $holidaysperformance=round($holidaysperformance,2);
                                    // dd($taskperformance);


                                    ?>
                                    <td>
                                        {!! $holidaysperformance !!}

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
                                    <td>
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

                                            {!! $tranper !!}

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
                        </tbody>
                        <tfoot>


                        </tfoot>

                        @endforeach
                        @endforeach





                    </table>
                </div>
                <!-- /.card-body -->
                </div>

            </div>

        </div>
        <div class="col-lg-3 col-md-4">
            <div class="filter-report clearfix">
                <h3 class="tab-content-title">فرز</h3>

                <form method="post" action="{{route('reports.public')}}">
                    @csrf

                    <div class="form-group">
                        <label for="report-type">نوع التقرير</label>


                        <select name="type" id="report-type" class="custom-select-black" onchange="location = this.value;">

                            <option value="{{route('reports.index')}}" >
                                الكل
                            </option>

                            <option value="{{route('reports.emp')}}" >
                                تقرير اداء موظف
                            </option>

                            <option value="{{route('reports.dep')}}" >
                                تقرير اداء  قسم
                            </option>
                            <option value="{{route('reports.admin')}}" >
                                تقرير اداء  ادارة
                            </option>
                            <option value="{{route('reports.public')}}" selected="">
                                تقرير اداء  ادارة عامة
                            </option>
                            <option value="{{route('reports.sector')}}">
                                تقرير اداء قطاع
                            </option>
                            <option value="{{route('reports.user')}}">
                                تقرير اداء فريق مسؤولي موظف
                            </option>


                        </select>
                    </div>

                    <div class="form-group">
                        <label for="from">تاريخ البدء</label>
                        <input type="date" name="from_date" id="from_date" class="form-control datetime-picker flatpickr-input" data-default-date="" placeholder="من تاريخ" />

                    </div>
                    <div class="form-group">
                        <label for="to">تاريخ الانتهاء</label>
                        <input type="date" name="to_date" id="to_date" class="form-control datetime-picker flatpickr-input" placeholder="الى تاريخ" />

                    </div>
                    <div class="form-group">
                        <label for="publicadmin">اسم الادارة العامة</label>
                        <?php

                        $publicadmins=DB::table('public_admins')->get();

                        ?>

                        <select class="form-control select2bs4" name="publicadmin" >
                            @foreach($publicadmins as $publicadmin)
                                <option value="{!! $publicadmin->id !!}" name="publicadmin" >
                                    {!! $publicadmin->publicAdmin   !!}
                                </option>
                            @endforeach
                        </select>

                    </div>


                    <button type="submit" name="filter" id="filter" class="btn btn-warning">فرز</button>

                </form>
            </div>
        </div>
    </div>






@stop
@section('footer')
    <script >
        $('#ptn').click(function(){
            $('.print').printThis(optionsal);


        });
        var optionsal ={
            printDelay: 2000,

            importCSS: true,
            loadCSS: "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            ,
            header:"<div class='d-flex justify-content-between'><p  style='display: inline;'><img src='http://127.0.0.1:8000/left.png' style=' width:230px;height: 90px ; ' alt='حسبنا الله'/></p><p  style='display: inline;'><img src='http://127.0.0.1:8000/middel.png' style='width:140px;height: 130px; '  alt='حسبنا الله' /></p><p  style='display: inline;'> <img src='http://127.0.0.1:8000/right.png'  style='width:200px;height: 100px;'  alt='حسبنا الله'/></p></div>" +
                "<hr>" +
                "<br>" +
                "<style>@media print { @page {size: auto !important} } td,th{text-align: center;}h5,.card-header{text-align: right;} </style>" +
                "\n",

            footer:"<hr>",


        };

    </script>
@stop
