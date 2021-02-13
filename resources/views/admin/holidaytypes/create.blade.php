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
								<a  href="{{aurl('holidaytypes')}}"
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

{!! Form::open(['url'=>aurl('/holidaytypes'),'id'=>'holidaytypes','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('holidaytype',trans('admin.holidaytype'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holidaytype',old('holidaytype'),['class'=>'form-control','placeholder'=>trans('admin.holidaytype')]) !!}
    </div>
</div>
<br>

                                    <div class="form-group">
                                        {!! Form::label('holidaytype',trans('admin.type_days'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::number('type_days',old('type_days'),['class'=>'form-control','placeholder'=>trans('admin.type_days')]) !!}
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

