<!-- BEGIN HEADER -->
<?php
$year = session()->get('year');

?>

        <div class="page-header navbar navbar-fixed-top" style="height: 46px;">
{{--            <div id="particles-js"></div>--}}
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
{{--                    <a href="{{ aurl('') }}">--}}

{{--            @if(!empty(setting()->logo))--}}
{{--                        <img src="{{asset('logo2.png')}}" alt="وزارة الننقل" style="width:100px;height: 100px; margin-top: 0px;"  class="logo-default">--}}

{{--                        <img src="{{it()->url(setting()->logo)}}" alt="{{ setting()->{l('sitename')} }}" style="width:50px;height: 25px"  class="logo-default" />--}}
{{--            @else--}}
{{--            {{ setting()->{l('sitename')} }}--}}
{{--            @endif--}}
{{--                    </a>--}}
{{--                    <div class=”sidebar-toggle hidden-xs” data-open=”sidebar-left” data-target=”html” data-fire-event=”sidebar-left-toggle”>--}}

                    <div class="menu-toggler   sidebar-toggler hidden-xs "  style="
    margin-top: 20px;
"  >
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler " data-toggle="collapse"   data-target=".navbar-collapse "> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->

                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="row col-md-3">

                <h3 style="
    margin-top: 10px; color:white;
" >  نظام تقييم الموظفين {!! $year !!} </h3>

                </div>
{{--                <div class="row col-md-3 text-center">--}}

{{--                <img src="{{asset('logo.png')}}" alt="وزارة الننقل" style="width:100px;height: 100px; margin-top:0px;"  class="logo-default">--}}
{{--                </div>>--}}
                <div class="page-top">
                                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu" style="margin-top: 0;" >

                        <ul class="nav navbar-nav pull-right" >
                            <li class="separator hide"> </li>

                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
{{--                            <li class="dropdown dropdown-extended dropdown-dark dropdown-notification " id="header_notification_bar">--}}
{{--                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-top: 15px;">--}}
{{--                                    <i class="fa fa-bell"></i>--}}
{{--                                    <span class="badge badge-success"> {{auth()->guard('admin')->user()->unreadNotifications->count()}} </span>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li class="external">--}}
{{--                                        <h3>--}}
{{--                                            <span class="bold">الاشعارات</span> غير المقرؤة   {{auth()->guard('admin')->user()->unreadNotifications->count()}}   </h3>--}}
{{--                                        <a href="page_user_profile_1.html">عرض الكل</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">--}}
{{--                                            @foreach(auth()->guard('admin')->user()->unreadNotifications as $notification)--}}

{{--                                                <li>--}}

{{--                                                    <a href="javascript:;" >--}}
{{--                                                        <span class="time"> {{ $notification->created_at->diffForHumans() }}</span>--}}
{{--                                                        <span class="details">--}}
{{--                                                        <span class="label label-sm label-icon label-success">--}}
{{--                                                            <i class="{{ $notification->data['icon'] }}" ></i>--}}
{{--                                                        </span>      {{ $notification->data['title'] }} {{ $notification->data['fuser'] }} {{ $notification->data['muser'] }} {{ $notification->data['luser'] }}</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                            <!-- END NOTIFICATION DROPDOWN -->
                            <li class="separator hide"> </li>


                            {{--<li class="dropdown dropdown-extended dropdown-notification" id="cog_list">--}}
{{--    <a href="javascript:;"  class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">--}}
{{--        <i class="fa fa-paint-brush"></i>--}}
{{--    </a>--}}
{{--    <ul class="dropdown-menu">--}}
{{--        <li>--}}
{{--            <a href="javascript:;" onclick="change_theme('1')" >--}}
{{--            <i class="fa fa-paint-brush"></i> {{trans('admin.theme1')}} </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript:;" onclick="change_theme('2')">--}}
{{--            <i class="fa fa-paint-brush"></i> {{trans('admin.theme2')}} </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript:;" onclick="change_theme('3')">--}}
{{--            <i class="fa fa-paint-brush"></i> {{trans('admin.theme3')}} </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</li>--}}

{{--<li class="dropdown dropdown-extended dropdown-notification" id="lang_list">--}}
{{--    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-top: 15px ;">--}}
{{--        <i class="fa fa-globe"></i>--}}
{{--    </a>--}}
{{--    <ul class="dropdown-menu">--}}
{{--        @foreach(L::all() as $l)--}}
{{--        <li>--}}
{{--            <a href="{{aurl('lang/'.$l)}}">--}}
{{--            <i class="fa fa-flag"></i> {{trans('admin.'.$l)}} </a>--}}
{{--        </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</li>--}}

                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <!-- END NOTIFICATION DROPDOWN -->
                            <li class="separator hide"> </li>
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <!-- END INBOX DROPDOWN -->
                            <li class="separator"> </li>
                            <!-- BEGIN   DROPDOWN -->

                            <!-- END  DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-top: 15px ;">
                                    <span class="username username-hide-on-mobile"> {{ admin()->user()->name }} </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->

                                     @if(!empty(admin()->user()->photo_profile))
                            <img src="{{ it()->url(admin()->user()->photo_profile) }}" style="width:25px;height:25px;" class="img-circle" />
                            @else
                             <i class="fa fa-user"></i>
                            @endif

                                     </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{{aurl('account')}}">
                                            <i class="fa fa-user"></i> {{trans('admin.account')}} </a>
                                    </li>

                                    <li>
                                        <a href="{{ aurl('logout') }}">
                                            <i class="fa fa-key"></i> {{ trans('admin.logout') }} </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>

                    </div>

                    <!-- END TOP NAVIGATION MENU -->
                </div>

                <div class="clearfix"> </div>

                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->

        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container" style="
    padding-top: 0px;
">

<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse" style="
    margin-top:0px; background-color: #562441 ;">


    <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">



