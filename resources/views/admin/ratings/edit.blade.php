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
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('ratings/create')}}"
												data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.ratings')}}">
												<i class="fa fa-plus"></i>
										</a>
										<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.ratings')}}">
												<a data-toggle="modal" data-target="#myModal{{$ratings->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
														<i class="fa fa-trash"></i>
												</a>
										</span>
										<div class="modal fade" id="myModal{{$ratings->id}}">
												<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																		<button class="close" data-dismiss="modal">x</button>
																		<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
																</div>
																<div class="modal-body">
																		<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$ratings->id}}) ؟
																</div>
																<div class="modal-footer">
																		{!! Form::open([
																		'method' => 'DELETE',
																		'route' => ['ratings.destroy', $ratings->id]
																		]) !!}
																		{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
																		<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
																		{!! Form::close() !!}
																</div>
														</div>
												</div>
										</div>
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('ratings')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.ratings')}}">
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
										
<form action="{{aurl('/ratings/'.$ratings->id)}}"  class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" id="ratings">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="put">
<div class="form-group">
    <label for="rating" class="col-md-3 control-label">{{trans('admin.rating')}}</label>
    <div class="col-md-9">
        <input type="text" id="rating" name="rating" value="{{ $ratings->rating }}" class="form-control" placeholder="{{trans('admin.rating')}}" />
    </div>
</div>
<br>
<div class="form-group">
    <label for="task_id" class="col-md-3 control-label">{{trans('admin.task_id')}}</label>
    <div class="col-md-9">
        <select id="task_id" name="task_id" class="form-control" placeholder="{{trans('admin.task_id')}}" >
    @foreach(App\Model\task::pluck("task_name","id") as $task_id)
      <option value="{{ $task_id->"id" }}" {{ $ratings->task_id == $task_id->"id"?"selected":"" }} >{{ $task_id->"task_name" }}</option>
    @endforeach
</select>
    </div>
</div>
<br>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
<input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}" />
         </div>
            </div>
        </div>
    </div>
</div>
</form>

												</div>
												<div class="clearfix"></div>
								</div>
						</div>
				</div>
		</div>
		@stop
		
