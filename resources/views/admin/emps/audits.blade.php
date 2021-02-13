@extends('admin.index')


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">بيانات الموظفين   </span>
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
                        <h3 class="card-title">ملخص اداء الوظفين في الوزارة </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>المشرف </th>
                                <th>القسم</th>
                                <th>الوظيفة</th>
                                <th>الدوام</th>
                                <th>المهام </th>
                                <th>الاذون </th>
                                <th>الاجازات </th>

                                <th>نسبة الانضباط </th>
                                <th>الحافز </th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>

<tr>
    <td>
    </td>
</tr>


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
