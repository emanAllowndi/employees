<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app('l')}}" dir="{{app('dir')}}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
    @yield('header')

        <meta charset="utf-8" />
        <title>{{!empty($title)?$title:trans('admin.dashboard')}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap/css/bootstrap{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet" type="text/css" />


        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="{{url('design/admin_panel')}}/assets/global/css/components{{app('direction')}}.min.css" rel="stylesheet" id="style_components" type="text/css" />

        <link href="{{url('design/admin_panel')}}/assets/global/css/plugins{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />

        <link href="{{url('design/admin_panel')}}/assets/global/css/plugins" rel="stylesheet" type="text/css" />



        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->


        @if(session('theme') == 1)
         <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/layout{{app('direction')}}.min.css" id="stylelink1" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/themes/default{{app('direction')}}.min.css" id="stylelink2" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/custom{{app('direction')}}.min.css"  id="stylelink3" rel="stylesheet" type="text/css" />
        @elseif(session('theme') == 2)
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/layout{{app('direction')}}.min.css" id="stylelink1" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/themes/default{{app('direction')}}.min.css" id="stylelink2" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/custom{{app('direction')}}.min.css"  id="stylelink3" rel="stylesheet" type="text/css" />

        @elseif(session('theme') == 3)

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/layout{{app('direction')}}.min.css" id="stylelink1" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/themes/default{{app('direction')}}.min.css" id="stylelink2" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/custom{{app('direction')}}.min.css"  id="stylelink3" rel="stylesheet" type="text/css" />

        @else
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/layout{{app('direction')}}.min.css" id="stylelink1" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/themes/default{{app('direction')}}.min.css" id="stylelink2" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('design/admin_panel')}}/assets/layouts/layout4/css/custom{{app('direction')}}.min.css"  id="stylelink3" rel="stylesheet" type="text/css" />
        @endif

        <script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
        @if(!empty(setting()->icon))
        <link rel="shortcut icon" href="{{ it()->url(setting()->icon) }}" />
        @endif
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END CORE PLUGINS -->

        <link href="{{ url("design/admin_panel/assets/global/plugins/datatables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{url("design/admin_panel")}}/assets/global/css/components-rtl.min.css">
        <link rel="stylesheet" href="{{url("design/admin_panel")}}/assets/global/css/plugins-rtl.min.css">
        <link href="{{ url("design/admin_panel/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css") }}" rel="stylesheet" type="text/css" />
        @if(app("l") != 'ar')
        <link href="{{ url("design/admin_panel/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
        @endif

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
        <style type="text/css">
            .table-responsive{
                padding-top:70px;
            }


            .filter-report {
                padding: 15px;
                background: #ffffff;
                border-radius: 3px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }
              .form-group select {
                width: 100%;
                  height: 40px;
            }
            .form-group input {
               height:40px;


            }

            .form-group  {
                border: none !important;
                padding: 0 !important;

            }
            .form-horizontal .control-label {
                text-align: right;}




            @media print {
                .scroll-container {
                    max-height: 100%;
                    overflow-y: auto;
                }
            }

            .btn-grad1 {background-image: linear-gradient(to right, #0d5d64 0%, #562441   51%, #a2196b  100%)}
            .btn-grad2 {background-image: linear-gradient(to right, #562441  0%, #0d9cba  51%, #562441   100%)}
            .btn-grad3 {background-image: linear-gradient(to right, #a2196b 0%, #0d5d64   51%, #a2196b  100%)}
            .btn-grad4 {background-image: linear-gradient(to right, #148799 0%, #562441  51%, #148799  100%)}

            .btn-grad {

                margin-right: 10px;
                border: none !important;
               width: 100%;

                padding: 15px 45px;
                text-align: center;
                text-transform: uppercase;
                transition: 0.5s;

                height: 30px;
                background-size: 200% auto;
                color: white;
                box-shadow: 0 0 20px #eee;
                border-radius: 10px !important;
                display: block;
            }

            .btn-grad:hover  {
                background-position: right center; /* change the direction of the change here */
                color: #fff;
                text-decoration: none;
            }
            .holi{
                padding-left: 0;

                width: 100%;
                height: auto;
                background-color: white;
                border: 2px solid  #ee87a0;
                border-radius: 10px !important;

            }
             .holileft{
                 padding-left: 0;
                 margin-right: 0;
                background-color:#ee87a0;
                height: 600px;
                text-align: left;
                 border-radius: 10px 0 0 10px !important;
            }
            .rightemp{

                height: auto;
                /*background-color: black;*/


            }
            .leftemp{

                height: auto;
                /*background-color: white;*/

            }
            .downemp{
                width: 100%;
                height: auto;
                /*background-color: yellow;*/

            }

            .image-upload>input {
                display: none;
            }

            .page-header.navbar {

                min-height:20px;

            }

            .btn-circle.btn-xl {
                width:auto;
                height: 70px;
                padding: 10px 16px;
                border-radius: 35px;
                font-size: 24px;
                line-height: 1.33;
            }



        </style>

    </head>
    <!-- END HEAD -->
    <body class="page-container-bg-solid page-header-fixed  page-sidebar-closed-hide-logo page-sidebar-closed">
