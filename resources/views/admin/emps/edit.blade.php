@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url'=>aurl('/emps'),'id'=>'emps','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        {!! Form::submit(trans('admin.update'),['class'=>'btn btn-success']) !!}

                        <a  href="{{aurl('emps')}}"
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
                <div class="portlet-body form">
                    <div class="row col-md-12">

                        <div class="rightemp col-md-7">


                            <div class="form-group">
                                <div class="col-md-12" >
                                    {!! Form::text('emp_name',$emps->emp_name,['class'=>'form-control' ,'placeholder'=>trans('admin.emp_name')])  !!}
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::text('second_name',$emps->second_name,['class'=>'form-control','placeholder'=>trans('admin.second_name')]) !!}
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::text('third_name',$emps->third_name,['class'=>'form-control','placeholder'=>trans('admin.third_name')]) !!}
                                </div>
                            </div>
                            <br>


                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::text('last_name',$emps->last_name,['class'=>'form-control','placeholder'=>trans('admin.last_name')]) !!}
                                </div>
                            </div>
                            <hr/>


                            <div class="form-group">
                                {!! Form::label('phone_num',trans('admin.phone_num'),['class'=>'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::number('phone_num',$emps->phone_num,['class'=>'form-control','placeholder'=>trans('admin.phone_num')]) !!}
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('email',trans('admin.email'),['class'=>'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::email('email',$emps->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                                </div>
                            </div>
                            <br>

                        </div>

                        <div class="leftemp col-md-5">



                            <div class="image-upload text-right">
                                <label for="file-input">
                                    @if($emps->photo_profile==null)
                                        <img id="img"  src="{{asset('default.png')}}" alt="وزارة الننقل" style="width:150px;height: 150px; margin-top: 5px; border: 4px solid #eec8a3" class="img-circle"  >

                                    @endif
                                    <img id="img" src="{{ it()->url($emps->photo_profile) }}"   alt="وزارة الننقل" style="width:150px;height: 150px; margin-top: 5px; border: 4px solid #eec8a3" class="img-circle"  >
                                </label>

                                <input id="file-input" type="file" name="photo_profile" />
                            </div>


                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="form-group">
                                {!! Form::label('job_id',trans('admin.job_id'),['class'=>'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::select('job_id',App\Model\job::pluck("job_name","id"),$emps->job_id,['class'=>'form-control','placeholder'=>trans('admin.job_id')]) !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                {!! Form::label('department_id',trans('admin.department_id'),['class'=>'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::select('department_id',App\Model\department::pluck("department_name","id"),$emps->department_id,['class'=>'form-control','placeholder'=>trans('admin.department_id')]) !!}
                                </div>
                            </div>
                            <br>

                            <div class="form-group">

                                {!! Form::label('user_id',trans('admin.user_id'),['class'=>'col-md-3 control-label']) !!}

                                <div class="col-md-9">
                                    {!! Form::select('user_id',App\Model\user::pluck("first_name","id"),$emps->user_id,['class'=>'form-control','placeholder'=>trans('admin.user_id')]) !!}
                                </div>


                            </div>
                            <br>


                        </div>
                        <div class="row col-md-12 downemp">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#cv" data-toggle="tab">السيرة الذاتية</a></li>
                                <li><a href="#private" data-toggle="tab">معلومات خاصة</a></li>
                                <li><a href="#administration" data-toggle="tab">معلومات الشؤون الادارية</a></li>

                            </ul>

                            <div class="tab-content" style="padding:10px;">
                                <div id="cv" class="tab-pane active">
                                    <div class="form-group">
                                        {!! Form::label('cv',trans('admin.cv'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::file('cv',$emps->cv,['class'=>'form-control','placeholder'=>trans('admin.cv')]) !!}
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div id="private" class="tab-pane">

                                    <div class="rightemp col-md-6">
                                        <h3 style="color: purple;" class="bold"> معلومات تواصل </h3>
                                        <br>


                                        <div class="form-group">
                                            {!! Form::label('address',trans('admin.address'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::text('address',$emps->address,['class'=>'form-control','placeholder'=>trans('admin.address')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('emergency_person',trans('admin.emergency_person'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::text('emergency_person',$emps->emergency_person,['class'=>'form-control','placeholder'=>trans('admin.emergency_person')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('emergency_number',trans('admin.emergency_number'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('emergency_number',$emps->emergency_number,['class'=>'form-control','placeholder'=>trans('admin.emergency_number')]) !!}
                                            </div>
                                        </div>
                                        <br>



                                        <hr/>

                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <h3 style="color: purple;" class="bold"> الحالة الاجتماعية </h3>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('social',trans('admin.gender'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {{ Form::select('social', array('أعزب' => 'أعزب ', 'متزوج' => 'متزوج', 'مطلق' => 'مطلق', 'ارمل' => 'ارمل'),$emps->social, array('class'=>'form-control','placeholder'=>trans('admin.social') )) }}



                                            </div>
                                        </div>
                                        <br>

                                        <h3 style="color: purple;" class="bold"> التعليم </h3>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('qulification',trans('admin.qulification'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {{ Form::select('qulification', array('دكتوراة' => 'دكتوراة ', 'ماجيستير' => 'ماجيستير', 'بكالوريوس' => 'بكالوريوس', 'ثانوية' => 'ثانوية', 'لا يوجد مؤهل' => 'لا يوجد مؤهل'),$emps->qulification, array('class'=>'form-control','placeholder'=>trans('admin.qulification') )) }}



                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('major',trans('admin.major'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::text('major',$emps->major,['class'=>'form-control','placeholder'=>trans('admin.major')]) !!}
                                            </div>
                                        </div>

                                        <br>




                                    </div>

                                    <div class="leftemp col-md-6">
                                        <h3 style="color: purple;" class="bold"> المواطنة </h3>
                                        <br>
                                        <div class="form-group">
                                            {!! Form::label('nationality',trans('admin.nationality'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::text('nationality',$emps->nationality,['class'=>'form-control','placeholder'=>trans('admin.nationality')]) !!}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            {!! Form::label('snn',trans('admin.snn'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('snn',$emps->snn,['class'=>'form-control','placeholder'=>trans('admin.snn')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('passport',trans('admin.passport'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('passport',$emps->passport,['class'=>'form-control','placeholder'=>trans('admin.passport')]) !!}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            {!! Form::label('gender',trans('admin.gender'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {{ Form::select('gender', array('انثى' => 'انثى ', 'ذكر' => 'ذكر'),$emps->gender, array('class'=>'form-control','placeholder'=>trans('admin.gender') )) }}



                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('bitrthdate',trans('admin.bitrthdate'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::date('bitrthdate',$emps->bitrthdate,['class'=>'form-control','placeholder'=>trans('admin.bitrthdate')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('bitrthplace',trans('admin.bitrthplace'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::text('bitrthplace',$emps->bitrthplace,['class'=>'form-control','placeholder'=>trans('admin.bitrthplace')]) !!}
                                            </div>
                                        </div>
                                        <br>
                                        <hr/>

                                        <h3 style="color: purple;" class="bold"> المعالين </h3>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('sons',trans('admin.sons'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('sons',$emps->sons,['class'=>'form-control','placeholder'=>trans('admin.sons')]) !!}



                                            </div>
                                        </div>
                                        <br>

                                    </div>

                                </div>

                                <div id="administration" class="tab-pane">

                                    <div class="rightemp col-md-6">
                                        <h3 style="color: purple;" class="bold"> الراتب </h3>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('salary',trans('admin.salary'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('salary',$emps->salary,['class'=>'form-control','placeholder'=>trans('admin.salary')]) !!}
                                            </div>
                                        </div>
                                        <br>
                                        <hr/>


                                        <div class="form-group">
                                            {!! Form::label('status',trans('admin.status'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {{ Form::select('status', array('متعاقد' => 'متعاقد ', 'اساسي' => 'اساسي', 'منتدب' => 'منتدب', 'شيء آخر' => 'شيء آخر'),$emps->status, array('class'=>'form-control','placeholder'=>trans('admin.status') )) }}



                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('start_date',trans('admin.start_date'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::date('start_date',$emps->start_date,['class'=>'form-control','placeholder'=>trans('admin.start_date')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('employment_number',trans('admin.employment_number'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('employment_number',$emps->employment_number,['class'=>'form-control','placeholder'=>trans('admin.employment_number')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('fingerprint',trans('admin.fingerprint'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('fingerprint',$emps->fingerprint,['class'=>'form-control','placeholder'=>trans('admin.fingerprint')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('account_num',trans('admin.account_num'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('account_num',$emps->account_num,['class'=>'form-control','placeholder'=>trans('admin.account_num')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('contract',trans('admin.contract'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::file('contract',$emps->contract,['class'=>'form-control','placeholder'=>trans('admin.contract')]) !!}
                                            </div>
                                        </div>
                                        <br>






                                        <hr/>


                                    </div>

                                    <div class="leftemp col-md-6">
                                        <h3 style="color: purple;" class="bold"> الحافز </h3>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('motivation',trans('admin.motivation'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('motivation',$emps->motivation,['class'=>'form-control','placeholder'=>trans('admin.motivation')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <hr/>


                                        <div class="form-group">
                                            {!! Form::label('work_nature',trans('admin.work_nature'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('work_nature',$emps->work_nature,['class'=>'form-control','placeholder'=>trans('admin.work_nature')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('level',trans('admin.level'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::text('level',$emps->level,['class'=>'form-control','placeholder'=>trans('admin.level')]) !!}
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('transportation',trans('admin.transportation'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('transportation',$emps->transportation,['class'=>'form-control','placeholder'=>trans('admin.transportation')]) !!}
                                            </div>
                                        </div>
                                        <br>


                                        <div class="form-group">
                                            {!! Form::label('activity',trans('admin.activity'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {{ Form::select('activity', array('فعال' => 'فعال ', 'غير فعال' => 'غير فعال'),$emps->activity, array('class'=>'form-control','placeholder'=>trans('admin.activity') )) }}



                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            {!! Form::label('degree',trans('admin.degree'),['class'=>'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                {!! Form::number('degree',$emps->degree,['min'=>0 ,'max'=>20 ,'class'=>'form-control','placeholder'=>trans('admin.degree')]) !!}
                                            </div>
                                        </div>
                                        <br>





                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('footer')

    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#file-input").change(function() {
            readURL(this);
        });
    </script>
@stop
