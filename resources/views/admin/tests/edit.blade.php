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
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('tests/create')}}"
												data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.tests')}}">
												<i class="fa fa-plus"></i>
										</a>
										<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.tests')}}">
												<a data-toggle="modal" data-target="#myModal{{$tests->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
														<i class="fa fa-trash"></i>
												</a>
										</span>
										<div class="modal fade" id="myModal{{$tests->id}}">
												<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																		<button class="close" data-dismiss="modal">x</button>
																		<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
																</div>
																<div class="modal-body">
																		<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$tests->id}}) ؟
																</div>
																<div class="modal-footer">
																		{!! Form::open([
																		'method' => 'DELETE',
																		'route' => ['tests.destroy', $tests->id]
																		]) !!}
																		{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
																		<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
																		{!! Form::close() !!}
																</div>
														</div>
												</div>
										</div>
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('tests')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.tests')}}">
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
										
{!! Form::open(['url'=>aurl('/tests/'.$tests->id),'method'=>'put','id'=>'tests','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('test_name',trans('admin.test_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('test_name', $tests->test_name ,['class'=>'form-control','placeholder'=>trans('admin.test_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('department_id',trans('admin.department_id'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
{!! Form::select('department_id',App\Model\department::pluck("department_name","id"), $tests->department_id ,['class'=>'form-control','placeholder'=>trans('admin.department_id')]) !!}
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
		
