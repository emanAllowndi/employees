@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">مراقبة  المستخدمين   </span>
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
                        <h3 class="card-title">مراقبة العمليات الاساسية على النظام</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example8" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th style="width:50px;">  الرقم </th>
                                <th>اسم المستخدم </th>
                                <th>ايميل المستخدم </th>
                                <th>العملية</th>
                                <th>الجدول</th>
                                <th>من الرابط</th>
                                <th>عنوان الجهاز </th>
                                <th>مواصفات الجهاز</th>
                                <th>القيمة القديمة</th>

                                <th>القيمة الجديدة</th>


                                <th>الفترة </th>
                                <th>ادارة </th>


                            </tr>
                            </thead>
                            <tbody>

                            @foreach($audits as $audit)
                                <tr>

                                    <td>

                                        {!! $audit->user_id !!}

                                    </td>
                                    <?php
                                    $username = DB::table('users')
                                     ->where('id','=',[$audit->user_id])->first();
                                    //dd($username->first_name );


                                    ?>
                                    <td>

                                        {!! $username->first_name !!}  {!! $username->middel_name !!}  {!! $username->last_name !!}

                                    </td>
                                    <td>

                                        {!! $username->email !!}

                                    </td>
                                    <td>

                                        {!! $audit->event !!}

                                    </td>
                                    <td>

                                        {!! $audit->auditable_type !!}

                                    </td>


                                    <td>

                                        {!! $audit->url !!}

                                    </td>
                                    <td>

                                        {!! $audit->ip_address !!}

                                    </td>
                                    <td>

                                        {!! $audit->user_agent !!}

                                    </td>
                                    <td>
                                        @foreach( $audit->old_values as  $old_value)

                                            {!! $old_value !!}
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach( $audit->new_values as  $new_value)

                                            {!! $new_value !!}
                                        @endforeach

                                    </td>
                                    <td>

                                        {!! $audit->created_at->diffForHumans(); !!}

                                    </td>
                                    <td>

                                        <div class="actions">
                                            <a type="submit"  class="btn btn-info btn-circle"  href="{{route('audits.show',$audit->id)}}"
                                               data-toggle="tooltip" title="عرض ">
                                                <i class="fa fa-eye"></i>
                                            </a>

{{--                                            <a type="submit"  class="btn btn-danger btn-circle"  href="{{route('reports.printadmin')}}"--}}
{{--                                               data-toggle="tooltip" title="عرض ">--}}
{{--                                                <i class="fa fa-trash"></i>--}}
{{--                                            </a>--}}




                                        </div>
                                    </td>

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
