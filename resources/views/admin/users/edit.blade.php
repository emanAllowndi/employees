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

										<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('users')}}"
												data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
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

{!! Form::open(['url'=>aurl('/users/'.$users->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="form-group">
    {!! Form::label('first_name',trans('admin.first_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('first_name', $users->first_name ,['class'=>'form-control','placeholder'=>trans('admin.first_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('middel_name',trans('admin.middel_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('middel_name', $users->middel_name ,['class'=>'form-control','placeholder'=>trans('admin.middel_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('last_name',trans('admin.last_name'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('last_name', $users->last_name ,['class'=>'form-control','placeholder'=>trans('admin.last_name')]) !!}
    </div>
</div>
<br>
<div class="form-group">
    {!! Form::label('email',trans('admin.email'),['class'=>'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::email('email', $users->email ,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
    </div>
</div>
<br>

                                    <div class="form-group">
                                        {!! Form::label('updating_reason',trans('admin.updating_reason'),['class'=>'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('updating_reason', $users->updating_reason ,['class'=>'form-control','placeholder'=>trans('admin.updating_reason')]) !!}
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label for="department">دور المستخدم</label>
                                        <?php

                                        $roles=DB::table('roles')->get();
                                        $id=DB::table('role_user')->where('user_id','=',$users->id)->first();
                                        $name=DB::table('roles')->where('id','=',$id->role_id)->first();
                                        ?>

                                        <select class="form-control select2bs4" name="role" >
                                            <option value="{!! $name->id !!}" name="role" >
                                                {!! $name->display_name  !!}
                                            </option>
                                            @foreach($roles as $role)
                                                <option value="{!! $role->id !!}" name="role" >
                                                    {!! $role->display_name  !!}
                                                </option>
                                            @endforeach
                                        </select>

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

