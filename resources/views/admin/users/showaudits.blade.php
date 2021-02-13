@extends('admin.index')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12" style="margin-bottom: 50px;">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <b>{{trans('admin.id')}} :</b> {{$audits->id}}
                        </div>
                        <div class="clearfix"></div>
                        <hr />
                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>نوع العملية  :</b>
                            {{$audits->event}}

                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>عنوان الجهاز  :</b>
                            {{$audits->ip_address}}

                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>مواصفات المتصفح  :</b>
                            {{$audits->user_agent}}

                        </div>


                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>الملف :</b>
                            {{$audits->auditable_type}}
                        </div>

                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <b>منذ :</b>
                            {{$audits->created_at->diffForHumans()}}
                        </div>


                    </div>

@if(($audits->event)=='updated')
                        <table class="table table-striped ">
                            <div class="card-header">
                                <h3 class="card-title"> البيانات قبل التعديل</h3>
                            </div>
                                <thead>
                                @foreach($audits->old_values as $key=>$value)
                            <th>




                                {!! trans('admin.'.$key) !!}

                            </th>
                            @endforeach
                                </thead>
                            <tbody>
                            <tr>
                            @foreach($audits->old_values as $key=>$value)

                                <td> {!! $value !!}

                                </td>



                            @endforeach
                            </tr>
                                <tbody>

                        </table>
                        <table class="table table-striped ">
                            <div class="card-header">
                                <h3 class="card-title"> البيانات بعد التعديل</h3>
                            </div>
                            <thead>
                            @foreach($audits->new_values as $key=>$value)
                                <th>

                                    {!! trans('admin.'.$key) !!}

                                </th>
                            @endforeach
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($audits->new_values as $key=>$value)

                                    <td> {!! $value !!}</td>


                                @endforeach
                            </tr>
                            <tbody>

                        </table>

@endif

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop
