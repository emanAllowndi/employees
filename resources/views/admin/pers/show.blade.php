@extends('admin.index')
@section('content')

		 <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">


                    <div class="actions">


                        <button type="button" name="ptn" id="ptn" class="btn btn-warning btn-circle"><i class="fa fa-print"></i></button>


                    </div>

            <div class="portlet-body form">
				<div class="col-md-12 print" style="text-align: right;">

                    <div class="caption  text-center">
                        <span class="caption-subject bold uppercase font-dark">تصريح خروج </span>
                    </div>


<div class="clearfix"></div>
<hr />

<div class="col-md-6 col-lg-6 col-xs-6">
<b>لا مانع من خروج الاخ  :</b>
 {!! $pers->emp->emp_name!!}  {!! $pers->emp->second_name!!} {!! $pers->emp->third_name!!} {!! $pers->emp->last_name!!}
</div>
<div class="col-md-3 col-lg-3 col-xs-3">
<b> الذي وظيفته  : </b>


 {!! $pers->emp->job->job_name !!}

</div>

<div class="col-md-3 col-lg-3 col-xs-3">
<b> في قسم  : </b>
    {!! $pers->emp->department->department_name !!}
</div>

<br>

<div class="clearfix"></div>

<div class="row " >
<div class="col-md-12 col-lg-12 col-xs-12">
<b>لغرض </b>
{!! $pers->per_cause!!}
</div>
</div>
 <br>
 <br>
 <br>

<div class="col-md-6 col-lg-6 col-xs-6">
<b>الموافق  :</b>
    {!! Carbon\Carbon::parse( $pers->updated_at)->format('Y-m-d')  !!}

</div>


<div class="col-md-3 col-lg-3 col-xs-3">
<b>من الساعة</b>

    {!! Carbon\Carbon::parse( $pers->from)->format('h:i')  !!}
{{-- {!! $pers->to !!}--}}
</div>


<div class="col-md-3 col-lg-3 col-xs-3">
<b>الى الساعة</b>
    {!! Carbon\Carbon::parse( $pers->to)->format('h:i')  !!}
</div>
<br>
<br>
<div class="clearfix"></div>
<hr />

<br>
<div class="col-md-12 col-lg-12 col-xs-12" style="padding-right: 500px;">

<b> المسؤول المباشر : </b>
    {!!  $pers->emp->user->first_name !!}
    {!!  $pers->emp->user->middel_name !!}

    {!!  $pers->emp->user->last_name !!}

</div>



			</div>
			<div class="clearfix"></div>
           </div>
         </div>
       </div>
   </div>



@stop
@section('footer')
    <script >
        $('#ptn').click(function(){
            $('.print').printThis(optionsal);


        });
        var optionsal ={
            printDelay: 2000,
            importCSS: true,
            loadCSS: "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            ,
            header:"<div class='d-flex justify-content-between' ><p  style='display: inline;'><img src=\"left.png\" style=\" width:230px;height: 90px ; \" alt=\"حسبنا الله\"/></p>" +
                " <p  style='display: inline;'><img src=\"middel.png\" style=\"width:140px;height: 130px; \"  alt=\"حسبنا الله\" /></p>" +
                " <p  style='display: inline;'> <img src=\"right.png\" style=\"width:200px;height: 100px;\"  alt=\"حسبنا الله\"/></p></div> " +
                "<hr>" +
                "<br>" +
                "<style>@media print { @page {size: auto !important} } td,th{text-align: center;} h5{text-align: right;} .right{text-align: right;} </style>" +
                "\n",
            footer:"<hr>",


        };

    </script>
@stop
