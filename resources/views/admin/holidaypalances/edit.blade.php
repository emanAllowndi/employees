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
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('holidaypalances/create')}}"
												data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.holidaypalances')}}">
												<i class="fa fa-plus"></i>
										</a>
										<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.holidaypalances')}}">
												<a data-toggle="modal" data-target="#myModal{{$holidaypalances->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
														<i class="fa fa-trash"></i>
												</a>
										</span>
										<div class="modal fade" id="myModal{{$holidaypalances->id}}">
												<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																		<button class="close" data-dismiss="modal">x</button>
																		<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
																</div>
																<div class="modal-body">
																		<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$holidaypalances->id}}) ؟
																</div>
																<div class="modal-footer">
																		{!! Form::open([
																		'method' => 'DELETE',
																		'route' => ['holidaypalances.destroy', $holidaypalances->id]
																		]) !!}
																		{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
																		<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
																		{!! Form::close() !!}
																</div>
														</div>
												</div>
										</div>
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('holidaypalances')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.holidaypalances')}}">
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

{!! Form::open(['url'=>aurl('/holidaypalances/'.$holidaypalances->id),'method'=>'put','id'=>'holidaypalances','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('holidayPalance',trans('admin.holidayPalance'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('holidayPalance', $holidaypalances->holidayPalance ,['class'=>'form-control','placeholder'=>trans('admin.holidayPalance')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('emp_id',trans('admin.emp_id'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
{!! Form::select('emp_id',App\Model\emp::pluck("emp_name","id"), $holidaypalances->emp_id ,['class'=>'form-control','placeholder'=>trans('admin.emp_id')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('holidaytype_id',trans('admin.holidaytype_id'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
{!! Form::select('holidaytype_id',App\Model\holidaytype::pluck("holidaytype","id"), $holidaypalances->holidaytype_id ,['class'=>'form-control','placeholder'=>trans('admin.holidaytype_id')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('note',trans('admin.note'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('note', $holidaypalances->note ,['class'=>'form-control','placeholder'=>trans('admin.note')]) !!}
    </div>
</div>
<br>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('updating_reason',trans('admin.updating_reason'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('updating_reason', $holidaypalances->updating_reason ,['class'=>'form-control','placeholder'=>trans('admin.updating_reason')]) !!}
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

