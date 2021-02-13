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
                        <div class="col-md-12 holi" style="border: 1px solid #148799;">
                            <div class="col-md-8 "  style="margin-top: 100px;">
                                <form action="{{ route('attendances.storefromhome') }}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="POST" >
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    {{--                                <input type="hidden" name="_method" value="GET">--}}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">اسم الموظف </label>
                                        <?php

                                        $emps=DB::table('emps')->where('deleted_at','=',null)->get();
                                        ?>
                                        <div class="col-md-10">

                                            <select class=" select2bs4 form-control employee " name="emp_id">
                                                <option value="0"  selected="true"> اسم الموظف </option>

                                                @foreach($emps as $emp)

                                                    <option class="form-control" value="{!! $emp->id !!}" name="emp_id"  >
                                                        {!! $emp->emp_name !!} {!! $emp->second_name !!} {!! $emp->third_name !!} {!! $emp->last_name !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('att_days',trans('admin.att_days'),['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::text('att_days',old('att_days'),['class'=>'form-control','placeholder'=>trans('admin.att_days')]) !!}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {!! Form::label('absent_days',trans('admin.absent_days'),['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::text('absent_days',old('absent_days'),['class'=>'form-control','placeholder'=>trans('admin.absent_days')]) !!}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {!! Form::label('note',trans('admin.note'),['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::textarea('note',old('note'),['class'=>'form-control','placeholder'=>trans('admin.note')]) !!}
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('adate',trans('admin.adate'),['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::date('adate',date('Y-m-d'),['class'=>'form-control','placeholder'=>trans('admin.adate')]) !!}
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
            $('.employee').on('change', function() {
                getMoreUsers();
            });


        });
        function getMoreUsers() {

            var employee = $(".employee option:selected").val();

            // Search on based of type

            $.ajax({
                type: 'GET',
                url:'search/' + employee ,
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

