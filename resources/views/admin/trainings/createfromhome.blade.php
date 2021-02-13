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
                        <div class="col-md-12 holi" style="border: 1px solid #8eaeb4 ;">
                            <div class="col-md-8 "  style="margin-top: 100px;">
                                <form action="{{ route('trainings.storefromhome') }}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="POST" >
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
                                        <label for="course" class="col-md-2 control-label">{{trans('admin.coursenum')}}</label>
                                        <div class="col-md-10">
                                            <input type="number" id="course" name="course" value="{{old('course')}}" class="form-control" placeholder="{{trans('admin.coursenum')}}" />
                                        </div>
                                    </div>
                                    <br>


                                    <div class="form-group">
                                        <label for="tradate" class="col-md-2 control-label">{{trans('admin.tradate')}}</label>
                                        <div class="col-md-10">
                                            <input type="date" id="tradate" name="tradate" value="{{date('Y-m-d')}}" class="form-control" placeholder="{{trans('admin.tradate')}}" />
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
                            <div class="col-md-4 holileft" style="background-color: #8eaeb4 ;">
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




    {{--    <script>--}}
    {{--        $(document).ready(function(){--}}

    {{--            fetch_customer_data();--}}

    {{--            function fetch_customer_data(query = '')--}}
    {{--            {--}}
    {{--                $.ajax({--}}
    {{--                    url:"{{ route('holidays.search') }}",--}}
    {{--                    method:'GET',--}}
    {{--                    data:{query:query},--}}
    {{--                    dataType:'json',--}}
    {{--                    success:function(data)--}}
    {{--                    {--}}
    {{--                        $('tbody').html(data.table_data);--}}
    {{--                        $('#total_records').text(data.total_data);--}}
    {{--                    }--}}
    {{--                })--}}
    {{--            }--}}

    {{--            $(document).on('keyup', '#search', function(){--}}
    {{--                var query = $(this).val();--}}
    {{--                fetch_customer_data(query);--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}



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

