@extends('admin.index')
@section('header')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
@stop

@section('content')


		 <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
              <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">بيانات الموظف  {!! $emps->emp_name !!} {!! $emps->second_name !!} {!! $emps->third_name !!} {!! $emps->last_name !!}</span>
                    </div>
                    <div class="actions">


                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                        <?php
                        $year= session()->get('year');
                        ?>
                         <?php
                        $years=DB::table('closedyears')->where('closedyear','=',$year)->first();

                        ?>


                    @if(auth()->guard('admin')->user()->hasPermission('create_tasks') && $years==null)

                        <a class="btn btn-primary btn-circle" href="{{route('tasks.create',$emps->id)}}"
                           data-toggle="tooltip" title="اضافة مهمة">
                            <i class="fa fa-list"></i>
                        </a>
                        @endif
                        @if(auth()->guard('admin')->user()->hasPermission('create_pers') && $years==null)

                        <a  class="btn btn-info btn-circle"  href="{{route('pers.create',$emps->id)}}"
                            data-toggle="tooltip" title="اضافة اذن">
                            <i class="fa fa-check"></i>
                        </a>
                        @endif
                        @if(auth()->guard('admin')->user()->hasPermission('create_holidaies') && $years==null)

                        <a class="btn btn-warning btn-circle"  href="{{route('holidays.create',$emps->id)}}"
                           data-toggle="tooltip" title="اضافة اجازة">
                            <i class="fa fa-home"></i>

                        </a>
                        @endif
                        @if(auth()->guard('admin')->user()->hasPermission('create_attendances') && $years==null)

                        <a  class="btn btn-danger btn-circle" href="{{route('attendances.create',$emps->id)}}"

                            data-toggle="tooltip" title="اضافة الدوام">
                            <i class="fa fa-briefcase"></i>
                        </a>
                            @endif
                        @if(auth()->guard('admin')->user()->hasPermission('create_users') && $years==null)

                            <a  class="btn btn-warning btn-circle" href="{{route('holidaypalances.create',$emps->id)}}"

                                data-toggle="tooltip" title="اضافة الدوام">
                                <i class="fa fa-balance-scale"></i>
                            </a>
                        @endif

                    </div>
                </div>
            <div class="portlet-body form">
				<div class="col-md-12">
                <div class="row">

            <div class="col-md-12 col-lg-12 col-xs-12">
            <b>{{trans('admin.id')}} :</b> {{$emps->id}}
            </div>
            <div class="clearfix"></div>
            <hr />
            </div>
            </div>

            <div class="col-md-12">


                    <div class="col-md-6col-lg-6 col-xs-6">
                    <b>{{trans('admin.emp_name')}} :</b>
                    {!! $emps->emp_name !!} {!! $emps->second_name !!} {!! $emps->third_name !!} {!! $emps->last_name !!}

                    </div>
                    <br><br>

                    <div class="col-md-4 col-lg-4 col-xs-4">
                    <b>{{trans('admin.salary')}} :</b>
                    {!! $emps->salary !!}
                    </div>


                    <div class="col-md-4 col-lg-4 col-xs-4">
                    <b>{{trans('admin.major')}} :</b>
                    {!! $emps->major !!}
                    </div>
                    <div class="row">

                    <div class="col-md-4 col-lg-4 col-xs-4">
                    <b>{{trans('admin.qulification')}} :</b>
                    {!! $emps->qulification !!}
                    </div>
                    </div>
                    <br><br>
                    <div class="row">
<div class="col-md-4 col-lg-4 col-xs-4">
<b>{{trans('admin.user_id')}} :</b>

    <?php
    $username= DB::table('users')->where('id','=',$emps->user_id)->where('deleted_at','=',null)->first();

    ?>
@if($username==null)
	لا يوجد مسؤول مباشر
	@else

    {!! $username->first_name !!}     {!! $username->middel_name !!}     {!! $username->last_name !!}
@endif


</div>
</div>
<br><br>


                    </div>




                    <br>
                    <br>
                    <br>

                <div class="clearfix"></div>






 <!-- /.card -->
                 <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-edit"></i>
              تاريخ الموظف
            </h3>
          </div>
          <div class="card-body">

          <!--  <h4 class="mt-5 ">Custom Content Above</h4>-->



              <ul class="nav nav-tabs">
                  <li class="active"><a href="#tasks" data-toggle="tab">المهام</a></li>
                  <li><a href="#taskperform" data-toggle="tab">اداء المهام</a></li>
                  <li><a href="#attendance" data-toggle="tab">الدوام</a></li>
                  <li><a href="#holidays_palance" data-toggle="tab">رصيد الاجازات</a></li>

                  <li><a href="#holidays" data-toggle="tab">الاجازات</a></li>
                  <li><a href="#holidaysperfrom" data-toggle="tab">الانضباط في الاجازات</a></li>

                  <li><a href="#pers" data-toggle="tab">الاذون</a></li>
                  <li><a href="#persperform" data-toggle="tab">الانضباط في الاذون</a></li>
                  <li><a href="#behaviors" data-toggle="tab">الانضباط في السلوك</a></li>
                  <li><a href="#trainings" data-toggle="tab">الدورات التدريبية</a></li>


                  <li><a href="#performance" data-toggle="tab">انضباط الكلي للموظف والحافز</a></li>


              </ul>


              <div class="tab-content" style="padding:10px;">
                  <div id="tasks" class="tab-pane active">


                      <div class="card">
                          <div class="card-header">
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>المهمة</th>
                                      <th>الوصف </th>
                                      <th>عدد الايام</th>
                                      <th>الحالة</th>
                                      <th>التقييم</th>
                                      <th>التاريخ</th>
                                      <th>ادارة</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($tasks as $task)
                                      <tr>
                                          <td>{!! $task->task_name !!}</td>
                                          <td>{!! $task->task_desc !!}</td>
                                          <td>{!! $task->days !!}</td>

                                          <td>
                                              @if( $task->status == "قيد التنفيذ")
                                              <a  class="btn btn-info btn-circle"  href="{{ aurl('/tasks/'.$task->id.'/edit')}}"

                                                  data-toggle="tooltip" title="تغيير الحالة">
                                                  <i>{!! $task->status !!}</i>
                                              </a>
                                                  @elseif( $task->status == "انتهت المهمة")
                                                  <a  class="btn btn-success btn-circle"  href="{{ aurl('/tasks/'.$task->id.'/edit')}}"

                                                      data-toggle="tooltip" title="تغيير الحالة">
                                                      <i>{!! $task->status !!}</i>

                                                  </a>

                                              @elseif( $task->status == "ملغية من قبل المسؤول")
                                                  <a  class="btn btn-danger btn-circle"  href="{{ aurl('/tasks/'.$task->id.'/edit')}}"

                                                      data-toggle="tooltip" title="تغيير الحالة">
                                                      <i>{!! $task->status !!}</i>

                                                  </a>
                                              @elseif( $task->status == "لم يتم انهائها")
                                                  <a  class="btn btn-danger btn-circle" href="{{ aurl('/tasks/'.$task->id.'/edit')}}"

                                                      data-toggle="tooltip" title="تغيير الحالة">
                                                      <i>{!! $task->status !!}</i>

                                                  </a>
                                              @elseif( $task->status == "مؤجلة")
                                                  <a  class="btn btn-warning btn-circle"  href="{{ aurl('/tasks/'.$task->id.'/edit')}}"

                                                      data-toggle="tooltip" title="تغيير الحالة">
                                                      <i>{!! $task->status !!}</i>

                                                  </a>
                                                  @endif
                                          </td>
                                          <td>

                                              <a  href="{{ aurl('/tasks/'.$task->id.'/edit')}}"
                                                  data-toggle="tooltip" title="تغيير التقييم">
                                              <div class="progress" style="height: 18px;">

                                                  <div class="progress-bar bg-danger" role="progressbar" style="width:{!! $task->task_rate !!}%"  aria-valuenow="{!! $task->task_rate !!}%" aria-valuemin="0" aria-valuemax="40">
                                                      <span>{!! $task->task_rate!!}%</span>
                                                  </div>
                                              </div>
                                              </a>
                                          </td>
										<td>  {!! Carbon\Carbon::parse($task->created_at)->format('Y-m')  !!}</td>

                                          <td style="width: 270px;">
                                              @if(auth()->guard('admin')->user()->hasPermission('read_tasks'))
                                               <a  href="{{aurl('emps/tasks/show/'.$task->id)}}"  type="submit" class="btn btn-info">عرض</a>
                                              @endif
                                                  @if(auth()->guard('admin')->user()->hasPermission('update_tasks') && $years==null)

                                                  <a href="{{route('tasks.edit',$task->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                              @endif
                                                  @if(auth()->guard('admin')->user()->hasPermission('delete_tasks') && $years==null)

                                                  <a  data-toggle="modal" data-target="#delete_recordt{{$task->id}}" href="#" class="btn btn-danger">حذف</a>
                                            @endif


                                          </td>

                      <div class="modal fade" id="delete_recordt{{$task->id}}">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button class="close" data-dismiss="modal">x</button>
                                      <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                  </div>
                                  <div class="modal-body">
                                      <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$task->id}}) ؟
                                  </div>
                                  <div class="modal-footer">
                                      {!! Form::open([
                                      'method' => 'DELETE',
                                      'route' => ['tasks.destroy', $task->id]
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
                      </div>

                  </div>


                  <div id="taskperform" class="tab-pane">
                      <div class="card-body">
                          <table id="example5" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>التاريخ</th>
                                  <th>نسبة الانضباط في اداء المهام</th>

                              </tr>
                              </thead>
                              <tbody>

                              <?php
                              $dates=DB::table('tasks')->select('tdate')->distinct()->where('tyear','=',$year)->where('emp_id','=',$emps->id)->where('deleted_at','=',null)->get();

                               ?>
                              @foreach($dates as $date)

                                  <tr>

                                  <td>


                                      {!! Carbon\Carbon::parse($date->tdate)->format('Y-m')  !!}

                                  </td>

                                           <td>

                                         <?php

                                           $ratesum=DB::table('tasks')->where('tyear','=',$year)->where('tdate','=',$date->tdate)->where('emp_id','=',$emps->id)->where('deleted_at','=',null)->sum('task_rate');


                                               $taskcount = DB::table('tasks')->where('emp_id','=',$emps->id)->where('tyear','=',$year)->where('tdate','=',$date->tdate)->where('deleted_at','=',null)->count('id');
										 if($taskcount != 0){
                                              $taskperformance=$ratesum/$taskcount;}
                                          else{
                                              $taskperformance=0;
                                          }

                                          $taskperformance=round($taskperformance,2);

                                          ?>


                                          <div class="progress" style="height: 18px;">

                                                  <div class="progress-bar bg-danger" role="progressbar" style="width:{!! $taskperformance !!}%"  aria-valuenow="{!! $taskperformance !!}%" aria-valuemin="0" aria-valuemax="40">
                                                      <span>{!! $taskperformance!!}%</span>
                                                  </div>
                                              </div>
                                      </td>

                                  </tr>
                                  @endforeach

                              </tbody>
                              <tfoot>

                              </tfoot>
                          </table>
                      </div>



                  </div>

                  <div id="attendance" class="tab-pane">

                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title"></h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example3" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>عدد ايام الحضور</th>
                                      <th>عدد ايام الغياب </th>
                                      <th>عدد ايام العطل  </th>
                                      <th>عدد ايام الاجازات </th>

                                      <th>ملاحظات </th>
                                      <th>الانضباط في الدوام </th>
                                      <th>التاريخ</th>
                                      <th>ادارة</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($attendances as $attendance)
                                      <tr>
                                          <td>{!! $attendance->att_days !!}</td>
                                          <td>{!! $attendance->absent_days !!}</td>
                                          <td>


                                              <?php
                                              $adate=$attendance->adate;
                                              $oh = DB::table('official_holidaies')->where('oyear','=',$year)->where('odate','=',$adate)->where('deleted_at','=',null)->sum('off_days');
                                              //dd($s);

                                              ?>
                                              {!! $oh !!}


                                          </td>
                                          <td>

                                              <?php

                                              $emp=$emps->id;

                                              $adate=$attendance->adate;

                                              $h = DB::table('holidaies')->where('hyear','=',$year)->where('emp_id','=',[$emp])->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');

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
                                          <td>{!!$rate !!} </td>


                                          <td> {!! Carbon\Carbon::parse( $attendance->adate)->format('Y-m')  !!}
                                          </td>

                                          <td style="width: 270px;">
                                              @if(auth()->guard('admin')->user()->hasPermission('read_attendances'))

                                              <a  href="{{aurl('emps/attendances/show/'.$attendance->id)}}" type="submit" class="btn btn-info">عرض</a>
                                              @endif
                                                  @if(auth()->guard('admin')->user()->hasPermission('update_attendances') && $years==null)

                                                  <a href="{{route('attendances.edit',$attendance->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                             @endif
                                                  @if(auth()->guard('admin')->user()->hasPermission('delete_attendances') && $years==null)

                                                      <a  data-toggle="modal" data-target="#delete_recorda{{$attendance->id}}" href="#" class="btn btn-danger">حذف</a>
                                                  @endif


                                          </td>

                                          <div class="modal fade" id="delete_recorda{{$attendance->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button class="close" data-dismiss="modal">x</button>
                                                          <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                          <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$attendance->id}}) ؟
                                                      </div>
                                                      <div class="modal-footer">
                                                          {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['attendances.destroy', $attendance->id]
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
                  <div id="holidays_palance" class="tab-pane">

                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title"></h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example8" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>نوع الاجازة</th>
                                      <th>الوصف </th>
                                      <th>عدد الايام</th>
                                      <th>ادارة</th>

                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($holiday_palances as $holiday_palance)
                                      <?php

                                      ?>
                                      <tr>
                                          <td>
                                              <?php
                                             $types=DB::table('holidaytypes')->where('id','=',$holiday_palance->holidaytype_id)->get();
                                              ?>
                                              @foreach($types as $type)
                                                  {!! $type->holidaytype !!}
                                              @endforeach
                                          </td>
                                          <td>{!! $holiday_palance->note !!}</td>

                                          <td>{!! $holiday_palance->holidayPalance !!}</td>
                                          <td style="width: 270px;">
                                              @if(auth()->guard('admin')->user()->hasPermission('create_users'))
                                                  <a  href="{{aurl('emps/holidaypalances/show/'.$holiday_palance->id)}}"  type="submit" class="btn btn-info">عرض</a>
                                              @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('create_users') && $years==null)

                                                  <a href="{{route('holidaypalances.edit',$holiday_palance->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                              @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('create_users') && $years==null)

                                                      <a  data-toggle="modal" data-target="#delete_recordhp{{$holiday_palance->id}}" href="#" class="btn btn-danger">حذف</a>
                                                  @endif


                                          </td>

                                          <div class="modal fade" id="delete_recordhp{{$holiday_palance->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button class="close" data-dismiss="modal">x</button>
                                                          <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                          <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$holiday_palance->id}}) ؟
                                                      </div>
                                                      <div class="modal-footer">
                                                          {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['holidaypalances.destroy', $holiday_palance->id]
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
                  <div id="holidays" class="tab-pane">

                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title"></h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example4" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>الاجازة</th>
                                      <th>الوصف </th>
                                      <th>عدد الايام</th>
                                      <th>التاريخ</th>
                                      <th>ادارة</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($holidays as $holiday)
                                      <tr>
                                          <td>
                                              <?php
                                              $holidaytype=$holiday->holidaytype_id;
                                              $s = DB::select('select holidaytype from holidaytypes where id = ?', [$holidaytype]);


                                              ?>
                                              @foreach($s as $row)
                                                  {!! $row->holidaytype !!}
                                              @endforeach








                                          </td>
                                          <td>{!! $holiday->holiday_desc !!}</td>
                                          <td>{!! $holiday->holidays_days !!}</td>


                                          <td> {!! Carbon\Carbon::parse( $holiday->hdate)->format('Y-m')  !!}</td>
                                          <td style="width: 270px;">
                                              @if(auth()->guard('admin')->user()->hasPermission('read_holidaies'))

                                              <a  href="{{aurl('emps/holidays/show/'.$holiday->id)}}" type="submit" class="btn btn-info">عرض</a>
                                             @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('update_holidaies') && $years==null)

                                              <a href="{{route('holidays.edit',$holiday->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                             @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('delete_holidaies') && $years==null)


                                                      <a  data-toggle="modal" data-target="#delete_recordh{{$holiday->id}}" href="#" class="btn btn-danger">حذف</a>
                                                  @endif


                                          </td>

                                          <div class="modal fade" id="delete_recordh{{$holiday->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button class="close" data-dismiss="modal">x</button>
                                                          <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                          <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$holiday->id}}) ؟
                                                      </div>
                                                      <div class="modal-footer">
                                                          {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['holidays.destroy', $holiday->id]
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
                  <div id="holidaysperfrom" class="tab-pane">
                      <div class="card-body">
                          <table id="example6" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>التاريخ</th>
                                  <th>نسبة الانضباط في الاجازات</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($holidays as $holiday)
                                  <?php
                                  $emp=$emps->id;
                                  $holiday_id=$holiday->id;
                                  $holiday_idnext= $holiday_id + 1;
                                  $disdates = DB::table('holidaies')->select('hdate')->distinct()->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('id','=',[$holiday_id])->where('hdate','=',$adate)->where('deleted_at','=',null)->get();
                                  $datenext = DB::table('holidaies')->select('hdate')->distinct()->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('id','=',[$holiday_idnext])->where('hdate','=',$adate)->where('deleted_at','=',null)->get();

                                  //dd($disdates);
                                  ?>
                                  @if($disdates!= $datenext)
                                      <tr>

                                          <td>

                                              @foreach($disdates as $disdate)

                                                  {!! Carbon\Carbon::parse($disdate->hdate)->format('Y-m')  !!}
                                              @endforeach

                                          </td>






                                          <td>

                                              <?php
                                              $emp=$emps->id;

                                              $hdate=$holiday->hdate;
                                              $ratesum = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('hdate','=',$hdate)->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                                             if($ratesum>3){
                                                 $ratesum=$ratesum-3;
                                             }
                                             else{

                                                 $ratesum=0;
                                             }


                                              $holidaycount = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('hdate','=',$hdate)->where('hdate','=',$adate)->where('deleted_at','=',null)->count('id');
                                              $holidaysperformance=5-($ratesum/2);
                                              $holidaysperformance=round($holidaysperformance,2);
                                              // dd($taskperformance);


                                              ?>


                                              <div class="progress" style="height: 18px;">

                                                  <div class="progress-bar bg-danger" role="progressbar" style="width:{!! $holidaysperformance !!}%"  aria-valuenow="{!! $holidaysperformance !!}%" aria-valuemin="0" aria-valuemax="40">
                                                      <span>{!! $holidaysperformance!!}%</span>
                                                  </div>
                                              </div>
                                          </td>

                                      </tr>
                                  @endif
                              @endforeach

                              </tbody>
                              <tfoot>

                              </tfoot>
                          </table>
                      </div>



                  </div>

                  <div id="pers" class="tab-pane">

                      <div class="card">
                          <div class="card-header">
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example7" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>سبب الاذن </th>
                                      <th>من الساعة  </th>

                                      <th>الى الساعة </th>
                                      <th>التاريخ</th>
                                      <th>ادارة</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($pers as $per)
                                      <tr>
                                          <td>{!! $per->per_cause !!}</td>
                                          <td>{!! $per->from !!}</td>
                                          <td>{!! $per->to !!}</td>

                                          <td>{!! Carbon\Carbon::parse( $per->pdate)->format('Y-m')  !!}</td>
                                          <td style="width: 270px;">

                                              @if(auth()->guard('admin')->user()->hasPermission('read_pers'))

                                              <a  href="{{aurl('emps/pers/show/'.$per->id)}}"  type="submit" class="btn btn-info">عرض</a>
                                             @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('update_pers') && $years==null)

                                              <a href="{{route('pers.edit',$per->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                              @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('delete_pers') && $years==null)

                                                      <a  data-toggle="modal" data-target="#delete_recordp{{$per->id}}" href="#" class="btn btn-danger">حذف</a>
                                                  @endif


                                          </td>

                                          <div class="modal fade" id="delete_recordp{{$per->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button class="close" data-dismiss="modal">x</button>
                                                          <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                          <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$per->id}}) ؟
                                                      </div>
                                                      <div class="modal-footer">
                                                          {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['pers.destroy', $per->id]
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
                  <div id="persperform" class="tab-pane">
                      <div class="card-body">
                          <table id="example8" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>التاريخ</th>
                                  <th>نسبة الانضباط في الاذون</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($pers as $per)
                                  <?php
                                  $emp=$emps->id;
                                  $per_id=$per->id;
                                  $per_idnext= $per_id + 1;

                                  $disdates = DB::table('pers')->select('pdate')->distinct()->where('emp_id','=',[$emp])->where('pyear','=',$year)->where('id','=',[$per_id])->where('deleted_at','=',null)->get();
                                  $datenext = DB::table('pers')->select('pdate')->distinct()->where('emp_id','=',[$emp])->where('pyear','=',$year)->where('id','=',[$per_idnext])->where('deleted_at','=',null)->get();

                                  //dd($disdates);
                                  ?>
                                  @if($disdates!= $datenext)
                                      <tr>

                                          <td>

                                              @foreach($disdates as $disdate)

                                                  {!! Carbon\Carbon::parse($disdate->pdate)->format('Y-m')  !!}
                                              @endforeach

                                          </td>






                                          <td>

                                              <?php
                                              $emp=$emps->id;

                                              $pdate=$per->pdate;

                                              $perscount = DB::table('pers')->where('emp_id','=',[$emp])->where('pyear','=',$year)->where('pdate','=',$pdate)->where('deleted_at','=',null)->count('id');

                                              if($perscount>2){
                                                  $perscount=$perscount-2;
                                              }
                                              else{

                                                  $perscount=0;
                                              }



                                              $persperformance=5-($perscount/2);
                                              $persperformance=round($persperformance,2);
                                              // dd($taskperformance);


                                              ?>


                                              <div class="progress" style="height: 18px;">

                                                  <div class="progress-bar bg-danger" role="progressbar" style="width:{!! $persperformance !!}%"  aria-valuenow="{!! $persperformance !!}%" aria-valuemin="0" aria-valuemax="40">
                                                      <span>{!! $persperformance!!}%</span>
                                                  </div>
                                              </div>
                                          </td>

                                      </tr>
                                  @endif
                              @endforeach

                              </tbody>
                              <tfoot>

                              </tfoot>
                          </table>
                      </div>



                  </div>

                  <div id="behaviors" class="tab-pane">
                      <div class="card-body">
                          <table id="example8" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>التاريخ</th>
                                  <th>نسبة الانضباط في السلوك</th>
                                  <th>ادارة</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($behaviors as $behavior)


                                      <tr>

                                          <td>



                                                  {!! Carbon\Carbon::parse($behavior->bedate)->format('Y-m')  !!}


                                          </td>
                                          <?php
                                          $de=0;
                                          ?>
                                          @if($behavior !=null)

                                              @php
                                                  $de=$behavior->behavior;
                                              @endphp
                                          @endif



                                          <td>


                                              {!! $de!!}

                                          </td>


                                          <td style="width: 270px;">
                                              @if(auth()->guard('admin')->user()->hasPermission('read_attendances'))

                                                  <a  href="{{aurl('emps/behaviors/show/'.$behavior->id)}}" type="submit" class="btn btn-info">عرض</a>
                                              @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('update_attendances') && $years==null)

                                                  <a href="{{route('behaviors.edit',$behavior->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                              @endif
                                              @if(auth()->guard('admin')->user()->hasPermission('delete_attendances') && $years==null)

                                                  <a  data-toggle="modal" data-target="#delete_recordbe{{$behavior->id}}" href="#" class="btn btn-danger">حذف</a>
                                              @endif


                                          </td>
                                          <div class="modal fade" id="delete_recordbe{{$behavior->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button class="close" data-dismiss="modal">x</button>
                                                          <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                          <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$behavior->id}}) ؟
                                                      </div>
                                                      <div class="modal-footer">
                                                          {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['behaviors.destroy', $behavior->id]
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



                  </div>
                  <div id="trainings" class="tab-pane">
                      <div class="card-body">
                          <table id="example8" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>التاريخ</th>
                                  <th>عدد الدورات التدريببية</th>
                                  <th>التقييم (5)</th>

                                  <th>ادارة</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($trainings as $training)


                                  <tr>

                                      <td>



                                          {!! Carbon\Carbon::parse($training->tradate)->format('Y-m')  !!}


                                      </td>


                                      <td>
                                          {!! $training->coursenum !!}
                                      </td>






                                      <td>
                                          <?php
                                          if($training != null){
                                            if($training->coursenum > 0)
                                                $tranper=5;
                                            else{
                                                $tranper=0;

                                            }
                                        }
                                        else{
                                            $tranper=0;

                                        }
                                        ?>

                                          {!!$tranper !!}
                                      </td>

                                      <td style="width: 270px;">
                                          @if(auth()->guard('admin')->user()->hasPermission('read_attendances'))

                                              <a  href="{{aurl('emps/trainings/show/'.$training->id)}}" type="submit" class="btn btn-info">عرض</a>
                                          @endif
                                          @if(auth()->guard('admin')->user()->hasPermission('update_attendances') && $years==null)

                                              <a href="{{route('trainings.edit',$training->id)}}" type="submit" class="btn btn-warning">تعديل</a>
                                          @endif
                                          @if(auth()->guard('admin')->user()->hasPermission('delete_attendances') && $years==null)

                                              <a  data-toggle="modal" data-target="#delete_recordtra{{$training->id}}" href="#" class="btn btn-danger">حذف</a>
                                          @endif


                                      </td>
                                      <div class="modal fade" id="delete_recordtra{{$training->id}}">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button class="close" data-dismiss="modal">x</button>
                                                      <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                      <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$training->id}}) ؟
                                                  </div>
                                                  <div class="modal-footer">
                                                      {!! Form::open([
                                                      'method' => 'DELETE',
                                                      'route' => ['trainings.destroy', $training->id]
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



                  </div>




                  <div id="performance" class="tab-pane">





                          <div class="card-body">
                              <div class="row col-md-12">
                                  <div class="card-header col-md-6">
                                      <h3 class="card-title">ملخص اداء الموظف في الوزارة </h3>
                                  </div>

                              </div>

                              <table id="example9" class="table table-bordered table-striped printall">
                                  <thead>
                                  <tr>
                                      <th>التاريخ</th>
                                      <th>
                                          نسبة انضباط المهام (40)</th>
                                      <th>نسبة انضباط الدوام  (40)</th>
                                      <th>نسبة انضباط الاجازات (5)</th>
                                      <th>نسبة انضباط الاذون (5)</th>
                                      <th>نسبة انضباط السلوك (5)</th>

                                      <th>  تقييم الدورات التدريبية (5)</th>

                                      <th>نسبة الانضباط الكلي (40)</th>
                                      <th>الحافز (40)</th>

                                  </tr>
                                  </thead>
                                  <tbody>

                                  @foreach($attendances as $attendance)

                                          <tr>

                                              <td>

                                                  {!! Carbon\Carbon::parse( $attendance->adate)->format('Y-m')  !!}
                                              </td>
                                              <td>



                                              <?php

                                              $emp=$emps->id;


                                              $adate=$attendance->adate;
                                              $ratesum = DB::table('tasks')->where('emp_id','=',[$emp])->where('tyear','=',$year)->where('tdate','=',$adate)->where('deleted_at','=',null)->sum('task_rate');
                                              $taskcount = DB::table('tasks')->where('emp_id','=',[$emp])->where('tyear','=',$year)->where('tdate','=',$adate)->where('deleted_at','=',null)->count('id');
                                                  if($taskcount != 0){
                                                      $taskperformance=$ratesum/$taskcount;}
                                                  else{
                                                      $taskperformance='لايوجد مهام';
                                                      $taskperformance=40;
                                                  }

                                                  $taskperformance=round($taskperformance,2);
                                              ?>


                                                  {!! $taskperformance!!}
                                              </td>
                                              <td>
                                              <?php

                                                  $oh = DB::table('official_holidaies')->where('odate','=',$adate)->where('oyear','=',$year)->where('deleted_at','=',null)->sum('off_days');
                                                  $h = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                                              $att=$attendance->att_days;
                                              $att=($att+$oh+$h);//هنا لاحتساب عدد ايام الحضور باعتبار  ايام الاجازة والعطل
                                              $absent=$attendance->absent_days;
                                              $rate=($att/($att+$absent))*40;
                                                  $rate=round($rate, 2);

                                                  ?>
                                                  {!!$rate !!}

                                              </td>
                                              <td>
                                                  <?php
                                                  $ratesum = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->sum('holidays_days');
                                                  if($ratesum>3){
                                                  $ratesum=$ratesum-3;
                                                  }
                                                  else{

                                                  $ratesum=0;
                                                  }


                                                  $holidaycount = DB::table('holidaies')->where('emp_id','=',[$emp])->where('hyear','=',$year)->where('hdate','=',$adate)->where('deleted_at','=',null)->count('id');
                                                  $holidaysperformance=5-($ratesum/2);
                                                  // dd($taskperformance);


                                                  ?>


                                                      {!! $holidaysperformance!!}
                                              </td>



                                              <td>

                                                  <?php
                                                  $emp=$emps->id;


                                                  $perscount = DB::table('pers')->where('emp_id','=',[$emp])->where('pyear','=',$year)->where('pdate','=',$adate)->where('deleted_at','=',null)->count('id');

                                                  if($perscount>2){
                                                      $perscount=$perscount-2;
                                                  }
                                                  else{

                                                      $perscount=0;
                                                  }



                                                  $persperformance=5-($perscount/2);
                                                  // dd($taskperformance);

                                                  ?>

                                              {!! $persperformance!!}

                                              </td>
                                              <td>
                                                  <?php


                                                  $behaviors=DB::table('behaviors')->where('emp_id','=',[$emp])->where('beyear','=',$year)->where('bedate','=',$adate)->where('deleted_at','=',null)->first();
                                                  $de=0;
                                              ?>
                                              @if($behaviors !=null)

                                                  @php
                                                      $de=$behaviors->behavior;
                                                  @endphp
                                              @endif



                                                  {!! $de!!}
                                              </td>
                                              <td>
                                                  <?php


                                                  $trainings=DB::table('trainings')->where('emp_id','=',[$emp])->where('trayear','=',$year)->where('tradate','=',$adate)->where('deleted_at','=',null)->first();

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
                                                  {!! $tranper!!}
                                              </td>
                                              <td>

                                                  <?php
                                                  $total=$taskperformance+$rate+$holidaysperformance+$persperformance+$de+$tranper;
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



                      </div>


                  </div>
              </div>












              </div>




            </div>
          </div>
          <!-- /.card -->
        </div>
        @section('footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
        <script>


        @stop
















@stop
