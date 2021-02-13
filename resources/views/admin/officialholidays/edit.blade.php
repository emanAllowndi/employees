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
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('officialholidays/create')}}"
												data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.officialholidays')}}">
												<i class="fa fa-plus"></i>
										</a>
										<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.officialholidays')}}">
												<a data-toggle="modal" data-target="#myModal{{$officialholidays->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
														<i class="fa fa-trash"></i>
												</a>
										</span>
										<div class="modal fade" id="myModal{{$officialholidays->id}}">
												<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																		<button class="close" data-dismiss="modal">x</button>
																		<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
																</div>
																<div class="modal-body">
																		<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$officialholidays->id}}) ؟
																</div>
																<div class="modal-footer">
																		{!! Form::open([
																		'method' => 'DELETE',
																		'route' => ['officialholidays.destroy', $officialholidays->id]
																		]) !!}
																		{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
																		<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
																		{!! Form::close() !!}
																</div>
														</div>
												</div>
										</div>
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('officialholidays')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.officialholidays')}}">
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

{!! Form::open(['url'=>aurl('/officialholidays/'.$officialholidays->id),'method'=>'put','id'=>'officialholidays','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('holiday_name',trans('admin.holiday_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holiday_name', $officialholidays->holiday_name ,['class'=>'form-control','placeholder'=>trans('admin.holiday_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('official_holidays_days',trans('admin.official_holidays_days'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('official_holidays_days', $officialholidays->official_holidays_days ,['class'=>'form-control','placeholder'=>trans('admin.official_holidays_days')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('holiday_month',trans('admin.holiday_month'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holiday_month', $officialholidays->holiday_month ,['class'=>'form-control date-picker','placeholder'=>trans('admin.holiday_month'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
    </div>
</div>
<br>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('updating_reason',trans('admin.updating_reason'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('updating_reason', $officialholidays->updating_reason ,['class'=>'form-control','placeholder'=>trans('admin.updating_reason')]) !!}
                                        </div>
                                    </div>
                                    <br>

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

