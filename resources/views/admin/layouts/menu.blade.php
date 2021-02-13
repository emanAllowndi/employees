
<li class="nav-item start ">
    <a href="{{aurl('')}}" class="nav-link nav-toggle">
        <img src="{{asset('logo.png')}}" alt="وزارة الننقل" style="width:30px;height: 30px; margin-top:0px; margin-right: 0px;"  class="img-circle">

        <span class="title">وزارة النقل </span>
        <span class="selected"></span>
        {{--        <i class="fa fa-circle text-success" style="--}}
        {{--    margin-right: 50px;--}}
        {{--    margin-top: 10px;"></i> نشط--}}
    </a>
</li>

<li class="nav-item start ">
    <a href="{{aurl('')}}" class="nav-link nav-toggle">
        @if(isset(auth()->guard('admin')->user()->photo_profile))
        <img src="{{ it()->url(auth()->guard('admin')->user()->photo_profile) }}" style="width:30px;height: 30px; margin-top:0px; margin-right: 0px;" class="img-circle" />
        @else
            <img src="{{asset('default.png')}}" alt="وزارة الننقل" style="width:30px;height: 30px; margin-top:0px; margin-right: 0px;"  class="img-circle">

        @endif

        <span class="title">{!! auth()->guard('admin')->user()->first_name !!}
            {!! auth()->guard('admin')->user()->middel_name !!}
            {!! auth()->guard('admin')->user()->last_name !!}</span>
        <span class="selected"></span>
        {{--        <i class="fa fa-circle text-success" style="--}}
        {{--    margin-right: 50px;--}}
        {{--    margin-top: 10px;"></i> نشط--}}
    </a>
</li>




<li class="nav-item start {{ active_link(null,'active open') }} ">
    <a href="{{aurl('')}}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">{{trans('admin.dashboard')}}</span>
        <span class="selected"></span>
    </a>
</li>

<!--
<li class="nav-item start {{active_link('settings','active open')}}  ">
    <a href="{{aurl('settings')}}" class="nav-link nav-toggle">
        <i class="fa fa-cog"></i>
        <span class="title">{{trans('admin.settings')}}</span>
        <span class="selected"></span>
    </a>
</li>
-->
@if(auth()->guard('admin')->user()->hasRole('super_admin'))


<li class="nav-item start {{active_link('sectors','active open')}} {{active_link('jobs','active open')}}
{{active_link('publicadmins','active open')}}{{active_link('administrations','active open')}}
{{active_link('departments','active open')}} {{active_link('holidaytypes','active open')}} {{active_link('officialholidays','active open')}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-cog"></i>
        <span class="title">تهيئة</span>

        <span class="arrow {{active_link(null,'open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('sectors','block')}} ">
        <li class="nav-item start {{active_link('','active open')}}  ">
            <a href="{{aurl('sectors')}}" class="nav-link ">
                <i class="fa fa-square"></i>
                <span class="title">{{trans('admin.sectors')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start {{active_link('publicadmins','active open')}}  ">
            <a href="{{aurl('publicadmins')}}" class="nav-link ">
                <i class="fa fa-square"></i>
                <span class="title">{{trans('admin.publicadmins')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start {{active_link('alladministrations','active open')}}  ">
            <a href="{{route('administrations.all')}}" class="nav-link ">
                <i class="fa fa-square"></i>
                <span class="title">{{trans('admin.administrations')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start {{active_link('alldepartments','active open')}}  ">
            <a href="{{route('departments.all')}}" class="nav-link ">
                <i class="fa fa-cubes"></i>
                <span class="title">{{trans('admin.departments')}}  </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item start {{active_link('jobs','active open')}}  ">

            <a href="{{aurl('jobs')}}" class="nav-link ">
                <i class="fa fa-briefcase"></i>
                <span class="title">{{trans('admin.jobs')}}  </span>
                <span class="selected"></span>
            </a>
        </li>



        <li class="nav-item start {{active_link('holidaytypes','active open')}}  ">
            <a href="{{aurl('holidaytypes')}}" class="nav-link ">
                <i class="fa fa-th-list"></i>

                <span class="title">{{trans('admin.holidaytypes')}}  </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item start {{active_link('officialholidays','active open')}}  ">
            <a href="{{aurl('officialholidays')}}" class="nav-link ">
                <i class="fa fa-gift"></i>
                <span class="title">{{trans('admin.officialholidays')}}  </span>
                <span class="selected"></span>
            </a>
        </li>








    </ul>





</li>
@endif




@if(auth()->guard('admin')->user()->hasPermission('read_users'))

<li class="nav-item start {{active_link('users','active open')}}  ">
    <a href="{{route('users.allusers')}}" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title">المستخدمين</span>
        <span class="selected"></span>
    </a>
</li>
@endif
@if(auth()->guard('admin')->user()->hasRole('super_admin'))


<li class="nav-item start {{active_link('roles','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-balance-scale"></i>
        <span class="title">{{trans('admin.roles')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('roles','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}">
        <li class="nav-item start {{active_link('roles','active open')}}  ">
            <a href="{{aurl('roles')}}" class="nav-link ">
                <i class="fa fa-balance-scale"></i>
                <span class="title">{{trans('admin.roles')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('roles/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{trans('admin.create')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>
@endif
<!--
<li class="nav-item start {{active_link('holidaypalances','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-balance-scale"></i>
        <span class="title">{{trans('admin.holidaypalances')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('holidaypalances','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}">
        <li class="nav-item start {{active_link('holidaypalances','active open')}}  ">
            <a href="{{aurl('holidaypalances')}}" class="nav-link ">
                <i class="fa fa-balance-scale"></i>
                <span class="title">{{trans('admin.holidaypalances')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('holidaypalances/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{trans('admin.create')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>
-->

@if(auth()->guard('admin')->user()->hasPermission('read_emps'))

<li class="nav-item start {{active_link('emps','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title">{{trans('admin.emps')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('emps','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}">
        <li class="nav-item start {{active_link('emps','active open')}}  ">
            <a href="{{aurl('emps')}}" class="nav-link ">
                <i class="fa fa-users"></i>
                <span class="title">{{trans('admin.emps')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        @if(auth()->guard('admin')->user()->hasPermission('create_emps'))
        <li class="nav-item start">
            <a href="{{ aurl('emps/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{trans('admin.create')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
            @endif
    </ul>
</li>
@endif
<li class="nav-item start {{active_link('attendances','active open')}}  ">
    <a href="{{aurl('attendances')}}" class="nav-link nav-toggle">
        <i class="fa fa-building"></i>
        <span class="title">الحضور</span>
        <span class="selected"></span>
    </a>
</li>
<li class="nav-item start {{active_link('tasks','active open')}}  ">
    <a href="{{aurl('tasks')}}" class="nav-link nav-toggle">
        <i class="fa fa-tasks"></i>
        <span class="title">المهام</span>
        <span class="selected"></span>
    </a>
</li>
<li class="nav-item start {{active_link('holidays','active open')}}  ">
    <a href="{{aurl('holidays')}}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">الاجازات</span>
        <span class="selected"></span>
    </a>
</li>
<li class="nav-item start {{active_link('pers','active open')}}  ">
    <a href="{{aurl('pers')}}" class="nav-link nav-toggle">
        <i class="fa fa-check-circle"></i>
        <span class="title">الأذون</span>
        <span class="selected"></span>
    </a>
</li>
<li class="nav-item start {{active_link('holidaypalances','active open')}}  ">
    <a href="{{aurl('holidaypalances')}}" class="nav-link nav-toggle">
        <i class="fa fa-balance-scale"></i>
        <span class="title">رصيد اجازات الموظفين</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item start {{active_link('performance','active open')}}  ">
    <a href="{{aurl('performances')}}" class="nav-link nav-toggle">
        <i class="fa fa-tachometer"></i>
        <span class="title">انضباط وحوافز الموظفين</span>
        <span class="selected"></span>
    </a>
</li>
@if(auth()->guard('admin')->user()->hasRole('super_admin') || auth()->guard('admin')->user()->hasPermission('create_users'))

<li class="nav-item start {{active_link('audits','active open')}}  ">
    <a href="{{aurl('audits')}}" class="nav-link nav-toggle">
        <i class="fa fa-search"></i>
        <span class="title">مراقبة النظام</span>
        <span class="selected"></span>
    </a>
</li>
@endif
{{--<li class="nav-item start {{active_link('settings','active open')}}  ">--}}
{{--    <a href="{{aurl('#')}}" class="nav-link nav-toggle">--}}
{{--        <i class="fa fa-book"></i>--}}
{{--        <span class="title">دليل استخدام النظام</span>--}}
{{--        <span class="selected"></span>--}}
{{--    </a>--}}
{{--</li>--}}
<li class="nav-item start {{active_link('reports','active open')}}  ">
    <a href="{{aurl('reports')}}" class="nav-link nav-toggle">
        <i class="fa fa-book"></i>
        <span class="title">تقارير</span>
        <span class="selected"></span>
    </a>
</li>


@if(auth()->guard('admin')->user()->hasRole('super_admin') || auth()->guard('admin')->user()->hasPermission('create_users'))


<li class="nav-item start {{active_link('closedyears','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-calendar "></i>
        <span class="title">{{trans('admin.closedyears')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('closedyears','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}">
        <li class="nav-item start {{active_link('closedyears','active open')}}  ">
            <a href="{{aurl('closedyears')}}" class="nav-link ">
                <i class="fa fa-calendar "></i>
                <span class="title">{{trans('admin.closedyears')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('closedyears/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{trans('admin.addcolosed')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>
    @endif
<li class="nav-item start {{active_link('trainings','active open')}}  ">
    <a href="{{aurl('trainings')}}" class="nav-link nav-toggle">
        <i class="fa fa-pencil"></i>
        <span class="title">التدريب</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item start {{active_link('behaviors','active open')}}  ">
    <a href="{{aurl('behaviors')}}" class="nav-link nav-toggle">
        <i class="fa fa-handshake"></i>
        <span class="title">السلوك</span>
        <span class="selected"></span>
    </a>
</li>

