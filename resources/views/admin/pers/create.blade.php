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
								<a   href="{{route('pers.create',$emps->id)}}"
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

<form action="{{route('pers.create',$emps->id)}}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="post" id="pers">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="post">
<div class="form-group">
    <label for="per_cause" class="col-md-3 control-label">{{trans('admin.per_cause')}}</label>
    <div class="col-md-9">
        <input type="textarea" id="per_cause" name="per_cause" value="{{old('per_cause')}}" class="form-control" placeholder="{{trans('admin.per_cause')}}" />
    </div>
</div>
<br>
<div class="form-group">
    <label for="from" class="col-md-3 control-label">{{trans('admin.from')}}</label>
    <div class="col-md-9">
        <input type="time" id="from" class="form-control" placeholder="{{trans('admin.from')}}"
        name="from" >
    </div>
</div>
<br>

<div class="form-group">
    <label for="to" class="col-md-3 control-label">{{trans('admin.to')}}</label>
    <div class="col-md-9">
        <input type="time" id="to" name="to" value="{{old('to')}}" class="form-control" placeholder="{{trans('admin.to')}}" />
    </div>
</div>
<br>

    <div class="form-group">
        <label for="pdate" class="col-md-3 control-label">{{trans('admin.pdate')}}</label>
        <div class="col-md-9">
            <input type="date" id="pdate" name="pdate" value="{{date('Y-m-d')}}" class="form-control" placeholder="{{trans('admin.pdate')}}" />
        </div>
    </div>
    <br>



<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
<input type="submit" class="btn btn-success" value="{{ trans('admin.add') }}" />
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

