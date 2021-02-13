@extends('admin.index')
@section('content')


<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <?php
    session_start();
    $year = session()->get('year');
    ?>
    <?php
    $allusers = DB::table('users')->count('id');
    $allemps = DB::table('emps')->count('id');
    $alldep = DB::table('departments')->count('id');
    $alltasks = DB::table('tasks')->count('id');
    $alltaskst = DB::table('tasks')->where('status','نجاح')->sum('task_rate');
    $alltaskscount = DB::table('tasks')->count('id');


    // dd($tasksrates);

    ?>




    @if(auth()->guard('admin')->user()->hasPermission('create_users'))

        <a href="{{ url('admin/users') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">



                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="7800">{!! $allusers !!}</span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <small>عدد المستخدمين</small>
                        </div>

                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>

                </div>
            </div>
        </a>
    @endif
    @if(auth()->guard('admin')->user()->hasPermission('create_emps'))
        <a href="{{ url('admin/emps') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup" data-value="1349">{!! $allemps !!}</span>
                            </h3>
                            <small>عدد الموظفين</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>

                </div>
            </div>
        </a>
    @endif
    @if(auth()->guard('admin')->user()->hasPermission('create_departments'))
        <a href="{{ url('admin/departments') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup" data-value="1349">{!! $alldep !!}</span>
                            </h3>
                            <small>عدد الاقسام</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comments"></i>
                        </div>
                    </div>

                </div>
            </div>
        </a>
    @endif
    @if(auth()->guard('admin')->user()->hasPermission('create_tasks'))
        <a href="{{ url('admin/tasks') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup" data-value="1349">{!! $alltasks !!}</span>
                            </h3>
                            <small>اجمالي عدد المهام</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                    </div>

                </div>
            </div>
        </a>
    @endif

        <div class="row col-md-12 text-center">
            <?php
            $year= session()->get('year');
            ?>
            <?php
            $years=DB::table('closedyears')->where('closedyear','=',$year)->first();

            ?>


            @if(auth()->guard('admin')->user()->hasPermission('create_tasks') && $years==null)

                <a class="btn btn-primary btn-circle btn-xl " href="{{route('tasks.createfromhome')}}"
                   data-toggle="tooltip" title="اضافة مهمة">
                    <i class="fa fa-list"></i>
                    اضافة مهمة

                </a>

            @endif
                @if(auth()->guard('admin')->user()->hasPermission('create_tasks') && $years==null)

                    <a  class="btn btn-danger btn-circle btn-xl"href="{{route('tasks.evaluationfromhome')}}"
                        style="background-color:#5c5b5b; border:#5c5b5b;"

                        data-toggle="tooltip" title=" تقييم مهمة">
                        <i class="fa fa-briefcase"></i>
                        تقييم  مهمة
                    </a>

                @endif
            @if(auth()->guard('admin')->user()->hasPermission('create_pers') && $years==null)

                <a  class="btn btn-info btn-circle btn-xl"  href="{{route('pers.createfromhome')}}"
                    data-toggle="tooltip" title="اضافة اذن">
                    <i class="fa fa-check"></i>
                    اضافة أذن
                </a>
            @endif
            @if(auth()->guard('admin')->user()->hasPermission('create_holidaies') && $years==null)

                <a class="btn btn-warning btn-circle btn-xl"  href="{{route('holidays.createfromhome')}}"
                   style="background-color: #0d5d64; border: #0d5d64;"
                   data-toggle="tooltip" title="اضافة اجازة">
                    <i class="fa fa-home"></i>
                    اضافة أجازة

                </a>
            @endif
            @if(auth()->guard('admin')->user()->hasPermission('create_attendances') && $years==null)

                <a  class="btn btn-danger btn-circle btn-xl"href="{{route('attendances.createfromhome')}}"
                    style="background-color:#5c5b5b; border:#5c5b5b;"

                    data-toggle="tooltip" title="اضافة الدوام">
                    <i class="fa fa-briefcase"></i>
                    اضافة الدوام
                </a>

            @endif
            @if(auth()->guard('admin')->user()->hasPermission('create_users') && $years==null)

                <a  class="btn btn-primary btn-circle btn-xl" href="{{route('behaviors.createfromhome')}}"


                    data-toggle="tooltip" title="اضافة السلوك">
                    <i class="fa fa-handshake"></i>
                    اضافة السلوك
                </a>
            @endif
                @if(auth()->guard('admin')->user()->hasPermission('create_users') && $years==null)

                    <a  class="btn btn-warning btn-circle btn-xl" href="{{route('trainings.createfromhome')}}"

                        data-toggle="tooltip" title="اضافة عدد دورات التدريب"
                        style="background-color: #0d5d64; border: #0d5d64;"
                    >
                        <i class="fa fa-pencil"></i>
                        اضافة الدورات التدريبية

                    </a>
                @endif
{{--                @if(auth()->guard('admin')->user()->hasPermission('create_users') && $years==null)--}}

{{--                    <a  class="btn btn-danger btn-circle btn-xl" --}}

{{--                        data-toggle="tooltip" title="اضافة عدد دورات التدريب">--}}
{{--                        <i class="fa fa-balance-scale"></i>--}}
{{--                    </a>--}}
{{--                @endif--}}

        </div>
</div>
<div class="row" style="margin-top: 60px;">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{trans('admin.dashboard')}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>






<?php
            use App\Charts\SampleChart;
            $SampleChart=new SampleChart;
            $dates=DB::table('attendances')->select('adate')->distinct()->where('ayear','=',$year)->where('deleted_at','=',null)->get();

            // dd($dates)
			$here=[];
			$avgs=[];
foreach($dates as $date){
    $here[]=$date->adate;

}


            foreach($dates as $date){
                $attendances=DB::table('attendances')->where('ayear','=',$year)->where('adate','=',$date->adate)->where('deleted_at','=',null)->get();

                foreach($attendances as $attendance){
                    $att=$attendance->att_days;

                    $absent=$attendance->absent_days;
                    $per=(($att+$absent)/22)*100;
                    $sum=0;
                    $sum=$per+$sum;

                }
                $datescount=DB::table('attendances')->select('id')->where('ayear','=',$year)->where('adate','=',$date->adate)->where('deleted_at','=',null)->count();



			   $avgs[]=$sum/$datescount;
            }




            $SampleChart->labels(array_values($here));
            $SampleChart->title('اداء حضور الموظفين لهذه السنة', 30, "#0d5d64", true, 'Helvetica Neue'); // العنوان الي فوق
            $SampleChart->barwidth(0.2); // عرض البار نفسه
            $SampleChart->displaylegend(false); //عشان الليبل حق الالوان

            $SampleChart->dataset('اداء حضور الموظفين ','bar',array_values($avgs))
            ->color("#0d5d64")
            ->backgroundcolor("#0d5d64")
            ->fill(false) // عشان لو كان لاين
            ->linetension(0.1)
            ->dashed([5]);



            ?>


             <div id="dashboard_amchart_1" class="CSSAnimationChart">
                 <div class="row">
                 <div class="col-lg-12">

                         {{  $SampleChart->Container()  }}
                         {{  $SampleChart->script() }}

                 </div>
                 </div>



             </div>



            <?php
            use App\Charts\holidays;
            $holidays=new holidays;
            $dates=DB::table('holidaies')->select('hdate')->distinct()->where('hyear','=',$year)->where('deleted_at','=',null)->get();
			$hhere=[];
			$countless=0;
			$countmore=0;
			$lessav=[];
			$moreav=[];
            // dd($dates)
            foreach($dates as $date){
                $hhere[]=$date->hdate;

            }


            foreach($dates as $date){
                $emps=DB::table('holidaies')->select('emp_id')->distinct()->where('hyear','=',$year)->where('hdate','=',$date->hdate)->where('deleted_at','=',null)->get();
                $countless=0;
                $countmore=0;
                foreach($emps as $emp){
                 $sum=DB::table('holidaies')->where('hyear','=',$year)->where('hdate','=',$date->hdate)->where('emp_id','=',$emp->emp_id)->where('deleted_at','=',null)->sum('holidays_days');

                 if($sum<=3){
                     $countless=$countless+1;
                 }
                 elseif ($sum>3){
                    $countmore=$countmore+1;}
                }
}

            $moreav[]=$countmore;
            $lessav[]=$countless;



            $holidays = new holidays;
            $holidays->labels(array_values($hhere));
            $holidays->title('اداء اجازات الموظفين لهذه السنة', 30, "#562441", true, 'Helvetica Neue'); // العنوان الي فوق
            $holidays->barwidth(0.2); // عرض البار نفسه
            $holidays->displaylegend(true); //عشان الليبل حق الالوان
            $holidays->dataset('عدد الموظفين الذي اخذوا اكثر من 3 ايام', 'bar', array_values($moreav))
                ->color("#562441")
                ->backgroundcolor("#562441");
            $holidays->dataset('عدد الموظفين الذين اخذوا اقل من 3 ايام', 'bar', array_values($lessav))
                ->color("#0d5d64")
                ->backgroundcolor("#0d5d64");


            ?>


            <div id="dashboard_amchart_1" class="CSSAnimationChart">
                <div class="row">
                    <div class="col-lg-12">

                        {{  $holidays->Container()  }}
                        {{  $holidays->script() }}

                    </div>
                </div>



            </div>


            <?php
            use App\Charts\per;
            $per=new per;
            $dates=DB::table('pers')->select('pdate')->distinct()->where('pyear','=',$year)->where('deleted_at','=',null)->get();
$phere=[];
$countlessp=0;
 $countmorep=0;
 $moreavp=[];
 $lessavp=[];
            // dd($dates)
            foreach($dates as $date){
                $phere[]=$date->pdate;

            }


            foreach($dates as $date){
                $emps=DB::table('pers')->select('emp_id')->distinct()->where('pyear','=',$year)->where('pdate','=',$date->pdate)->where('deleted_at','=',null)->get();
                $countlessp=0;
                $countmorep=0;
                foreach($emps as $emp){
                    $sum=DB::table('pers')->where('pyear','=',$year)->where('pdate','=',$date->pdate)->where('emp_id','=',$emp->emp_id)->where('deleted_at','=',null)->count('id');

                    if($sum<=2){
                        $countlessp=$countlessp+1;
                    }
                    elseif ($sum>2){
                        $countmorep=$countmorep+1;}
                }
            }

            $moreavp[]=$countmorep;
            $lessavp[]=$countlessp;



            $holidays = new holidays;
            $holidays->labels(array_values($phere));
            $holidays->title('اداء اذون الموظفين لهذه السنة', 30,  "#562441", true, 'Helvetica Neue'); // العنوان الي فوق
            $holidays->barwidth(0.2); // عرض البار نفسه
            $holidays->displaylegend(true); //عشان الليبل حق الالوان
            $holidays->dataset('عدد الموظفين الذي اخذوا اكثر من 2 ايام', 'bar', array_values($moreavp))
                ->color( "#562441")
                ->backgroundcolor( "#562441");
            $holidays->dataset('عدد الموظفين الذين اخذوا اقل من 2 ايام', 'bar', array_values($lessavp))
                ->color(("#0d5d64"))
                ->backgroundcolor(("#0d5d64"));


            ?>


            <div id="dashboard_amchart_1" class="CSSAnimationChart">
                <div class="row">
                    <div class="col-lg-12">

                        {{  $holidays->Container()  }}
                        {{  $holidays->script() }}

                    </div>
                </div>



            </div>

            <?php
            use App\Charts\tasks;
            $tasks=new tasks;
            $dates=DB::table('tasks')->select('tdate')->distinct()->where('tyear','=',$year)->where('deleted_at','=',null)->get();
$there=[];
$tasky=[];
$a=0;
            // dd($dates)
            foreach($dates as $date){
                $there[]=$date->tdate;

            }


            foreach($dates as $date){
                $task_rate=DB::table('tasks')->where('tyear','=',$year)->where('tdate','=',$date->tdate)->where('deleted_at','=',null)->sum('task_rate');
                $task_count=DB::table('tasks')->where('tyear','=',$year)->where('tdate','=',$date->tdate)->where('deleted_at','=',null)->count('id');
                $a=($task_rate/$task_count);

            }

            $tasky[]=$a;



            $tasks = new tasks;
            $tasks->labels(array_values($there));
            $tasks->title('اداء مهام الموظفين لهذه السنة من 40', 30,  "#562441", true, 'Helvetica Neue'); // العنوان الي فوق
            $tasks->barwidth(0.2); // عرض البار نفسه
            $tasks->displaylegend(true); //عشان الليبل حق الالوان
            $tasks->dataset('اداء مهام الموظفين لهذه السنة', 'bar', array_values($tasky))
                ->color( "#562441")
                ->backgroundcolor( "#562441");


            ?>


            <div id="dashboard_amchart_1" class="CSSAnimationChart">
                <div class="row">
                    <div class="col-lg-12">

                        {{  $tasks->Container()  }}
                        {{  $tasks->script() }}

                    </div>
                </div>



            </div>






        </div>
     </div>
 </div>
<!-- END PAGE BASE CONTENT -->



@endsection


