
<?php

$year= session()->get('year');

$years=DB::table('closedyears')->where('closedyear','=',$year)->first();

?>
<div class="action">
				<div class="btn-group">

						<a class="btn btn-default btn-outlines btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
								<i class="fa fa-wrench"></i>
						{{ trans('admin.actions') }}
								<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">


                            @if(auth()->guard('admin')->user()->hasPermission('update_emps') && empty($years))
								<li>
										<a href="{{ aurl('/emps/'.$id.'/edit')}}"><i class="fa fa-pencil-square-o"></i> {{trans('admin.edit')}}</a>
								</li>
								<li class="divider"> </li>
                            @endif

                                @if(auth()->guard('admin')->user()->hasPermission('read_emps') && empty($years))
                                    <li>
                                        <a href="{{ route('emps.details',$id)}}"><i class="fa fa-eye"></i> عرض تفاصيل الموظف</a>
                                    </li>
                                @endif



                            @if(auth()->guard('admin')->user()->hasPermission('read_emps'))

                                <li>
										<a  href="{{route('emps.show',$id)}}"><i class="fa fa-eye"></i> {{trans('admin.showhistory')}}</a>
								</li>
                                @endif
                                @if(auth()->guard('admin')->user()->hasPermission('delete_emps') && empty($years))

                                <li>


										<a data-toggle="modal" data-target="#delete_record{{$id}}" href="#">
						<i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
								</li>
                                @endif
                                @if(auth()->guard('admin')->user()->hasPermission('create_tasks') && empty($years))

                                <li>
										<a href="{{route('tasks.create',$id)}}">  <i class="fa fa-tasks"></i>
                                            {{trans('admin.add_task')}}</a>
								</li>
                                @endif
                                @if(auth()->guard('admin')->user()->hasPermission('create_holidaies') && empty($years))

								<li>
										<a href="{{route('holidays.create',$id)}}">        <i class="fa fa-home"></i>
                                            {{trans('admin.add_holidays')}}</a>
								</li>
                                @endif
                                @if(auth()->guard('admin')->user()->hasPermission('create_pers') && empty($years))


                                <li>
										<a href="{{route('pers.create',$id)}}">        <i class="fa fa-check-circle"></i>
                                            {{trans('admin.add_pers')}}</a>
								</li>
                                @endif
                                @if(auth()->guard('admin')->user()->hasPermission('create_attendances') && empty($years))

                                <li>
										<a href="{{route('attendances.create',$id)}}">        <i class="fa fa-building"></i>
                                            {{trans('admin.add_attendance')}}</a>
								</li>
								@endif

                                @if(auth()->guard('admin')->user()->hasPermission('create_attendances') && empty($years))


                                    <li>
                                        <a href="{{route('holidaypalances.create',$id)}}"><i class="fa fa-balance-scale"></i> {{trans('admin.add_holidaypalances')}}</a>
                                    </li>
                                @endif

                                @if(auth()->guard('admin')->user()->hasPermission('create_users') && empty($years))


                                    <li>
                                        <a href="{{route('users.create',$id)}}"><i class="fa fa-user"></i> {{trans('admin.add_users')}}</a>
                                    </li>
                            @endif
                                @if(auth()->guard('admin')->user()->hasPermission('create_users') && empty($years))


                                    <li>
                                        <a href="{{route('trainings.create',$id)}}"><i class="fa fa-book"></i> {{trans('admin.add_courses')}}</a>
                                    </li>
                            @endif
                                @if(auth()->guard('admin')->user()->hasPermission('create_users') && empty($years))


                                    <li>
                                        <a href="{{route('behaviors.create',$id)}}"><i class="fa fa-chalkboard-teacher"></i> {{trans('admin.add_behaviors')}}</a>
                                    </li>
                            @endif

    <!-- Button trigger modal -->


						</ul>


                </div>
		</div>





								<!-- Button trigger modal -->






		<div class="modal fade" id="delete_record{{$id}}">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
								</div>
								<div class="modal-body">
										<i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$id}}) ؟
								</div>
								<div class="modal-footer">
										{!! Form::open([
										'method' => 'DELETE',
										'route' => ['emps.destroy', $id]
										]) !!}
										{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
										<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
										{!! Form::close() !!}
								</div>
						</div>
				</div>
		</div>
