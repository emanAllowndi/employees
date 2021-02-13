@extends('admin.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
				<div class="portlet-title">
						<div class="caption">
								<span class="caption-subject bold uppercase font-dark"> {{$emps->emp_name}}  {{$title}}</span>
						</div>
						<div class="actions">
								<a  href="{{route('holidays.store',$emps->id)}}"
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

{!! Form::open(['url'=>route('holidays.store',$emps->id),'files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}



<br>
<div class="form-group">
		{!! Form::label('holidaytype_id',trans('admin.holidaytype_id'),['class'=>'col-md-3 control-label']) !!}
		<div class="col-md-9">
{!! Form::select('holidaytype_id',App\Model\holidaytype::pluck("holidaytype","id"),old('holidaytype_id'),['class'=>'form-control','placeholder'=>trans('admin.holidaytype_id')]) !!}
		</div>
</div>
<br>




<div class="form-group">
    {!! Form::label('holiday_desc',trans('admin.holiday_desc'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('holiday_desc',old('holiday_desc'),['class'=>'form-control','placeholder'=>trans('admin.holiday_desc')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('holidays_days',trans('admin.holidays_days'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holidays_days',old('holidays_days'),['class'=>'form-control','placeholder'=>trans('admin.holidays_days')]) !!}
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

