@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">دورات التدريب</span>
                    </div>
                    <div class="actions">


                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>




                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>عدد دورات التدريب</th>

                                <th>التقييم</th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainings as $training)
                                <tr>

                                    <td>{!! $training->emp->emp_name !!} {!! $training->emp->second_name !!} {!! $training->emp->third_name !!} {!! $training->emp->last_name !!}</td>

                                    <td>{!! $training->coursenum !!}</td>
                                    <?php
                                    $traper=0;
                                    if($training->coursenum > 0){
                                        $traper=5;
                                    }
                                     ?>

                                    <td>{!! $traper !!}</td>

                                    <td>{!!  Carbon\Carbon::parse($training->tradate)->format('Y-m') !!}</td>



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
        </div>
    </div>


@stop
