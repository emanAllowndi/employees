@extends('admin.index')
	@section('content')
	<div class="row">
		<div class="col-md-12">
				<div class="widget-extra body-req portlet light bordered">
						<div class="portlet-title">
								<div class="caption">
										<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
								</div>
								<div class="actions">
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('tasks/create')}}"
												data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.tasks')}}">
												<i class="fa fa-plus"></i>
										</a>
										<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.tasks')}}">
												<a data-toggle="modal" data-target="#myModal{{$tasks->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
														<i class="fa fa-trash"></i>
												</a>
										</span>
										<div class="modal fade" id="myModal{{$tasks->id}}">
												<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																		<button class="close" data-dismiss="modal">x</button>
																		<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
																</div>
																<div class="modal-body">
																		<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$tasks->id}}) ؟
																</div>
																<div class="modal-footer">
																		{!! Form::open([
																		'method' => 'DELETE',
																		'route' => ['tasks.destroy', $tasks->id]
																		]) !!}
																		{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
																		<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
																		{!! Form::close() !!}
																</div>
														</div>
												</div>
										</div>
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('tasks')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.tasks')}}">
												<i class="fa fa-list"></i>
										</a>
										<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
												data-original-title="{{trans('admin.fullscreen')}}"
												title="{{trans('admin.fullscreen')}}">
										</a>
								</div>
						</div>
						<div class="portlet-body form">
								<div class="col-md-12">

{!! Form::open(['url'=>aurl('/tasks/'.$tasks->id),'method'=>'put','id'=>'tasks','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('task_name',trans('admin.task_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('task_name', $tasks->task_name ,['class'=>'form-control','placeholder'=>trans('admin.task_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('task_desc',trans('admin.task_desc'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('task_desc', $tasks->task_desc ,['class'=>'form-control','placeholder'=>trans('admin.task_desc')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('days',trans('admin.days'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('days', $tasks->days ,['class'=>'form-control','placeholder'=>trans('admin.days')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {{ Form::select('status', array('قيد التنفيذ' => 'قيد التنفيذ', 'تم انهائها بنجاح' => 'تم انهائها بنجاح', 'ملغية من قبل المسؤول' => 'ملغية من قبل المسؤول', 'لم يتم انهائها' => 'لم يتم انهائها', 'مؤجلة' => 'مؤجلة'),old('status'), array('class'=>'form-control','placeholder'=>trans('admin.status') )) }}
    <div class="col-md-9">
        {!! Form::text('status', $tasks->status ,['class'=>'form-control','placeholder'=>trans('admin.status')]) !!}
    </div>
</div>
<br>
                                    @if(($tasks->status) == "تم انهائها بنجاح" )

                                    <div class="form-group">
    {!! Form::label('task_rate',trans('admin.task_rate'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::number('task_rate', $tasks->task_rate ,['class'=>'form-control','placeholder'=>trans('admin.task_rate')]) !!}
    </div>
</div>
<br>
                                    @endif

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
{!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
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

