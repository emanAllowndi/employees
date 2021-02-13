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
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('departments/create')}}"
												data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.departments')}}">
												<i class="fa fa-plus"></i>
										</a>
										<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.departments')}}">
												<a data-toggle="modal" data-target="#myModal{{$departments->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
														<i class="fa fa-trash"></i>
												</a>
										</span>
										<div class="modal fade" id="myModal{{$departments->id}}">
												<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																		<button class="close" data-dismiss="modal">x</button>
																		<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
																</div>
																<div class="modal-body">
																		<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$departments->id}}) ؟
																</div>
																<div class="modal-footer">
																		{!! Form::open([
																		'method' => 'DELETE',
																		'route' => ['departments.destroy', $departments->id]
																		]) !!}
																		{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
																		<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
																		{!! Form::close() !!}
																</div>
														</div>
												</div>
										</div>
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('departments')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.departments')}}">
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

{!! Form::open(['url'=>aurl('/departments/'.$departments->id),'method'=>'put','id'=>'departments','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('department_name',trans('admin.department_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('department_name', $departments->department_name ,['class'=>'form-control','placeholder'=>trans('admin.department_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('department_desc',trans('admin.department_desc'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('department_desc', $departments->department_desc ,['class'=>'form-control','placeholder'=>trans('admin.department_desc')]) !!}
    </div>

</div>
<br>

                                    <div class="form-group">
                                        {!! Form::label('administration_id',trans('admin.administration_id'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::select('administration_id',App\Model\administration::pluck("administration","id"),old('administration_id'),['class'=>'form-control','placeholder'=>trans('admin.administration_id')]) !!}
                                        </div>
                                    </div>
                                    <br>

                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('updating_reason',trans('admin.updating_reason'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('updating_reason', $departments->updating_reason ,['class'=>'form-control','placeholder'=>trans('admin.updating_reason')]) !!}
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

