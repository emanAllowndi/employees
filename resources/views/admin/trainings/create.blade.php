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
								<a  href="{{aurl('trainings')}}"
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

<form action=""{{route('trainings.create',$emps)}}"" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="post" id="trainings">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="post">
<div class="form-group">
    <label for="course" class="col-md-3 control-label">{{trans('admin.coursenum')}}</label>
    <div class="col-md-9">
        <input type="number" id="coursenum" name="coursenum" value="{{old('coursenum')}}" class="form-control" placeholder="{{trans('admin.coursenum')}}" />
    </div>
</div>
<br>
                                    <div class="form-group">
                                        <label for="tradate" class="col-md-3 control-label">{{trans('admin.tradate')}}</label>
                                        <div class="col-md-9">
                                            <input type="date" id="tradate" name="tradate" value="{{date('Y-m-d')}}" class="form-control" placeholder="{{trans('admin.tradate')}}" />
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

