@extends('admin.index')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered" >
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">  {{$title}}</span>
                    </div>
                    <div class="actions">
                        <a  href="#"
                            class="btn btn-circle btn-icon-only btn-default"
                            tooltip="{{trans('admin.show_all')}}"
                            title="{{trans('admin.show_all')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                           href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form" >
                    <div class="row">
                        <div class="col-md-12 holi" style="border: 1px solid #0d5d64;">
                            <div class="col-md-8 "  style="margin-top: 100px;">
                                <form action="{{ route('tasks.storeevaluation') }}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="POST" >
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    {{--                                <input type="hidden" name="_method" value="GET">--}}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">اسم الموظف </label>
                                        <?php

                                        use App\Model\emp;
                                        use App\Model\task;
                                        $year = session()->get('year');
                                        $years=DB::table('closedyears')->where('closedyear','=',$year)->first();
                                        $user_id=auth()->guard('admin')->user()->id;

                                        if(auth()->guard('admin')->user()->hasRole('super_admin') && $years==null){
                                            $emps=emp::with('user')->where('deleted_at','=',null)->get();

                                        }
                                        else{
                                            $emps=emp::with('user')->where('deleted_at','=',null)->where('user_id','=',$user_id)->get();

                                             }
                                        ?>
                                        <div class="col-md-10">

                                            <select class=" select2bs4 form-control task " name="task_id">
                                                <option value="0"  selected="true"> المهمة  </option>

                                                @foreach($emps as $emp)
                                                    <?php

                                                        $tasks=task::with('emp')->where('deleted_at','=',null)->where('status','=','قيد التنفيذ')->where('emp_id','=',$emp->id)->where('tyear','=',$year)->get();

                                                    ?>
                                                    @foreach($tasks as $task)


                                                    <option class="form-control" value="{!! $task->id !!}" name="task_id"  >
                                                        {!! $task->task_name !!}
                                                    </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                    <br>


                                    <div class="form-group">
                                        {!! Form::label('task_rate',trans('admin.task_rate'),['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::number('task_rate',old('task_rate'),['min' => 0, 'max' => 40,'class'=>'form-control','placeholder'=>trans('admin.task_rate')]) !!}
                                        </div>
                                    </div>
                                    <br>


                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" class="btn btn-success" value="{{ trans('admin.add') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-4 holileft" style="background-color: #148799;">
                                <div class="row">
                                    <div class="text-center">
                                        <img src="{{asset('default.png')}}" alt="وزارة الننقل" style="width:150px;height: 150px; margin-top: 5px; border: 4px solid #eec8a3" class="img-circle"  >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="text-center  ">



                                        <table  class="table borderless">
                                            <thead>

                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>

                                        <h4> <span id="palance"></span> </h4>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')

    <!-- Ajax code -->





    <script>
        $(document).ready(function() {
            $('.task').on('change', function() {
                getMoreUsers();
            });


        });
        function getMoreUsers() {

            var task = $(".task option:selected").val();

            // Search on based of type

            $.ajax({
                type: 'GET',
                url:'searche/' + task ,
                dataType: 'json',      //return data will be json
                success: function (data) {
                    $('tbody').html(data.table_data);
                    //$('#palance').text(data.total_data);
                },
                error: function () {

                }
            });


        }
    </script>

@stop

