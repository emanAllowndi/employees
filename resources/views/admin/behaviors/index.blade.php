@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">السلوك</span>
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

                                <th>التقييم</th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($behaviors as $behavior)
                                <tr>

                                    <td>{!! $behavior->emp->emp_name !!} {!! $behavior->emp->second_name !!} {!! $behavior->emp->third_name !!} {!! $behavior->emp->last_name !!}</td>
                                        @php
                                        $de=0;
                                        @endphp
                                    @if($behaviors !=null)

                                        @php

                                            $de=$behavior->behavior;
                                        @endphp
                                    @endif

                                    <td>{!!$de !!}</td>

                                    <td>{!!  Carbon\Carbon::parse($behavior->bedate)->format('Y-m') !!}</td>



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
