@extends('admin.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
				<div class="portlet-title">
						<div class="caption">
								<span class="caption-subject bold uppercase font-dark">{{$emps->emp_name}} {{$emps->second_name}} {{$emps->third_name}} {{$emps->last_name}}</span>
						</div>
						<div class="actions">
								<a  href="{{aurl('holidaypalances')}}"
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
                    {!! Form::open(['url'=>route('holidaypalances.store',$emps->id),'id'=>'holidayPalances','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

                @foreach($holidaytypes as $holidaytype)
								<div class="col-md-6">

    <div class="form-group">
     <label for="holidaytype_id" class="col-md-3 control-label">{!! $holidaytype->holidaytype !!}</label>

    <div class="col-md-9">

        {!! Form::number('holidayPalance[]',$holidaytype->type_days,['class'=>'form-control']) !!}
    </div>
</div>
<br>
                                    <div class="form-group">

                                        <div class="col-md-9">
                                            <input type="hidden" name="ids[]" id="hiddenField" value={!! $holidaytype->id !!} />

                                        </div>
                                    </div>
                                    <br>




										</div>
                    @endforeach

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

                        <div class="clearfix"></div>

						</div>
				</div>
		</div>
	</div>
	@stop

