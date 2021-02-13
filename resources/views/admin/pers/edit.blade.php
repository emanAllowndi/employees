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
										
										
										
										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('pers')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.pers')}}">
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

<form action="{{aurl('/pers/'.$pers->id)}}"  class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" id="pers">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="put">
<div class="form-group">
    <label for="per_type" class="col-md-3 control-label">{{trans('admin.per_type')}}</label>
    <div class="col-md-9">
        <input type="text" id="per_type" name="per_type" value="{{ $pers->per_cause }}" class="form-control" placeholder="{{trans('admin.per_type')}}" />
    </div>
</div>
<br>

    <br>
	
	
	
    <div class="form-group">
                                        <label for="from" class="col-md-3 control-label">{{trans('admin.from')}}</label>
                                        <div class="col-md-9">
                                            <input type="time" id="from" class="form-control" placeholder="{{trans('admin.from')}}"
                                                   name="from"  value="{{ $pers->from }}">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label for="to" class="col-md-3 control-label">{{trans('admin.to')}}</label>
                                        <div class="col-md-9">
                                            <input type="time" id="to" name="to" value="{{$pers->to}}" class="form-control" placeholder="{{trans('admin.to')}}" />
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label for="pdate" class="col-md-3 control-label">{{trans('admin.pdate')}}</label>
                                        <div class="col-md-9">
                                            <input type="date" id="pdate" name="pdate" value="{!! Carbon\Carbon::parse($pers->pdate)->format('Y-m-d')  !!}" class="form-control" placeholder="{{trans('admin.pdate')}}" />
                                        </div>
                                    </div>
                                    <br>
    <div class="form-group">
        {!! Form::label('updating_reason',trans('admin.updating_reason'),['class'=>'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('updating_reason', $pers->updating_reason ,['class'=>'form-control','placeholder'=>trans('admin.updating_reason')]) !!}
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

