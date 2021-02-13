@extends('admin.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
				<div class="portlet-title">
						<div class="caption">
								<span class="caption-subject bold uppercase font-dark">{{$emps->emp_name}} {{$title}}</span>
						</div>
						<div class="actions"method="post">

								<a  href="{{route('emps.show',$emps->id)}}"
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
								<div class="col-md-12">


{!! Form::open(['url'=>route('tasks.store',$emps->id),'files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('task_name',trans('admin.task_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('task_name',old('task_name'),['class'=>'form-control','placeholder'=>trans('admin.task_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('task_desc',trans('admin.task_desc'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('task_desc',old('task_desc'),['class'=>'form-control','placeholder'=>trans('admin.task_desc')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('days',trans('admin.days'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('days',old('days'),['class'=>'form-control','placeholder'=>trans('admin.days')]) !!}
    </div>
</div>
<br>

                                    <div class="form-group">
                                        {!! Form::label('type',trans('admin.type'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">

                                            {{ Form::select('type', array('خارجية' => 'خارجية', 'اعمال يومية' => 'اعمال يومية', 'داخلية' => 'داخلية', 'اعمال من ضمن الخطة' => 'اعمال من ضمن الخطة'),old('type'), array('class'=>'form-control','placeholder'=>trans('admin.type') )) }}

                                        </div>
                                    </div>
                                    <br>

<div class="form-group">
    {!! Form::label('status',trans('admin.status'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">

        {{ Form::select('status', array('قيد التنفيذ' => 'قيد التنفيذ', 'انتهت المهمة' => 'انتهت المهمة', 'ملغية من قبل المسؤول' => 'ملغية من قبل المسؤول', 'لم يتم انهائها' => 'لم يتم انهائها', 'مؤجلة' => 'مؤجلة'),old('status'), array('class'=>'form-control','placeholder'=>trans('admin.status') )) }}

    </div>
</div>
<br>
                                    <div class="form-group">
                                        {!! Form::label('note',trans('admin.note'),['class'=>'col-md-3 control-label']) !!}

                                        <div class="col-md-9">
                                            {!! Form::text('note',old('note'),['class'=>'form-control','placeholder'=>trans('admin.note')]) !!}
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('tdate',trans('admin.tdate'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::date('tdate',date('Y-m-d'),['class'=>'form-control','placeholder'=>trans('admin.tdate')]) !!}
                                        </div>
                                    </div>
                                    <br>





<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
         </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
										</div>
										<div class="clearfix"></div>
						</div>
				</div>
		</div>
	</div>
	@stop

