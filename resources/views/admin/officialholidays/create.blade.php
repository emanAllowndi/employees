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
								<a  href="{{aurl('officialholidays')}}"
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

{!! Form::open(['url'=>aurl('/officialholidays'),'id'=>'officialholidays','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('holiday_name',trans('admin.holiday_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holiday_name',old('holiday_name'),['class'=>'form-control','placeholder'=>trans('admin.holiday_name')]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('holiday_month',trans('admin.holiday_month'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holiday_month',old('holiday_month'),['class'=>'form-control date-picker','placeholder'=>trans('admin.holiday_month'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
    </div>
</div>
<br>

<br>
<div class="form-group">
    {!! Form::label('holiday_month_end',trans('admin.holiday_month_end'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holiday_month_end',old('holiday_month_end'),['class'=>'form-control date-picker','placeholder'=>trans('admin.holiday_month_end'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
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

