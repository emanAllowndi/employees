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
								<a  href="{{aurl('attendances')}}"
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
{!! Form::open(['url'=>route('attendances.store',$emps->id),'files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('att_days',trans('admin.att_days'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('att_days',old('att_days'),['class'=>'form-control','placeholder'=>trans('admin.att_days')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('absent_days',trans('admin.absent_days'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('absent_days',old('absent_days'),['class'=>'form-control','placeholder'=>trans('admin.absent_days')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('note',trans('admin.note'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('note',old('note'),['class'=>'form-control','placeholder'=>trans('admin.note')]) !!}
    </div>
</div>
<br>
                                    <div class="form-group">
                                        {!! Form::label('adate',trans('admin.adate'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::date('adate',date('Y-m-d'),['class'=>'form-control','placeholder'=>trans('admin.adate')]) !!}
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

