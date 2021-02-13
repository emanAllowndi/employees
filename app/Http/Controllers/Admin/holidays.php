<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\holidayPalance;
use App\Model\user;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\emps;

use App\DataTables\holidaysDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\emp;
use App\Model\department;
use App\Model\holidaytype;


use App\Model\holiday;
use Validator;
use Set;
use Up;
use Form;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class holidays extends Controller
{

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(holidaysDataTable $holidays)
    {
        return $holidays->render('admin.holidays.index',['title'=>trans('admin.holidays'),'holidays'=>$holidays]);
    }
    public function allholidays(){
        $year = session()->get('year');

        $holidays=  DB::table('holidaies')->where('deleted_at','=',null)->where('hyear','=',$year)->get();


        //$holidays=holiday::all();
        return view('admin.holidays.allholidays',['title'=>trans('admin.all'),'holidays'=>$holidays]);


    }
    public function createfromhome()
    {
        return view('admin.holidays.createfromhome',['title'=>trans('admin.create')]);
    }
    public function search($employee, $type)
    {
        $year = session()->get('year');



        if( $employee !==0 && $type==0) {
            $data = emp::with('department','administration','publicAdmin','user','job','sector')
                ->where('deleted_at','=',null)
                ->where('id', '=', $employee)
                ->first();
            $data2="رصيد اجازات الموظف : ";




        }

       elseif( $employee !==0 && $type!==0) {
            $data = emp::with('department','administration','publicAdmin','user','job','sector')
                ->where('deleted_at','=',null)
                ->where('id', '=', $employee)
                ->first();

            $s= holidayPalance::with('emp','holidaytype')
                ->where('deleted_at','=',null)
                ->where('emp_id', '=', $employee ,'and','holidaytype_id','=',$type)
                ->where('palyear','=',date('Y'))
                ->first();

            if($s == null){
                $data2="لايوجد رصيد ";
            }
            else{

                $data2=".  رصيد اجازات الموظف : $s->holidayPalance.";

            }






        }


            $output = '';


            $total_row = $data->count();
            if($total_row > 0)
            {


                    $output .= '

         <tr>

         <th colspan="2" class="text-center" style="color:white; border: none;">'.$data->emp_name.' '.$data->second_name.' '.$data->third_name.' '.$data->last_name.'</th>
         </tr>
          <tr>

         <th colspan="2" class="text-center" style=" border: none;">'.$data->job->job_name.'</th>
         </tr>
          <tr>
    <th >المسؤول المشرف  : </th>
         <td class="text-left">'.$data->user->first_name.' '.$data->user->middel_name.' '.$data->user->last_name.'</td>
         </tr>

         <tr>
 <th style=" border: none;">القسم   : </th>
         <td class="text-left" style=" border: none;">'.$data->department->department_name.'</td>
         </tr>
           <tr>
<th style=" border: none;">الادارة   : </th>
         <td class="text-left" style=" border: none;">'.$data->administration->administration .'</td>
         </tr>

          <tr>
<th style=" border: none;">الادرة العامة   : </th>
         <td class="text-left" style=" border: none;">'.$data->publicAdmin->publicAdmin.'</td>
         </tr>
          <tr>
<th style=" border: none;">القطاع   : </th>
         <td class="text-left" style=" border: none;">'.$data->sector->sector.'</td>
         </tr>



         ';

            }
            else
            {
                $output .= '
       <tr>
        <td align="center" colspan="5" style=" border: none;">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $data2,
            );

            echo json_encode($data);

    }












    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create($emp_id)
    {

        $emps =  emp::find($emp_id);



        return view('admin.holidays.create',['title'=>trans('admin.create'),'emps'=>$emps]);
    }



    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function store($emp_id ,Request $request)
    {
        $emps =  emp::find($emp_id);

        $rules = [
            'holidaytype_id'=>'required|numeric',
            'holiday_desc'=>'',
            'holidays_days'=>'numeric',

        ];
        $data = $this->validate(request(),$rules,[],[
            //'holidaytype_id'=>trans('admin.holidaytype_id'),
            'holiday_desc'=>trans('admin.holiday_desc'),
            // 'holidays_days'=>trans('admin.holidays_days'),

        ]);
        $holidaypalance= DB::table('holiday_palances')->select('holidayPalance','id')->where('deleted_at','=',null)->where('holidaytype_id','=',  $data['holidaytype_id'])->where('emp_id','=',$emp_id)->first();
        //بيعطي رصيد الاجازات للموظف هذا
        if($holidaypalance != null) {
            $holidaytype = DB::table('holidaytypes')->select('holidaytype')->where('deleted_at', '=', null)->where('id', '=', $data['holidaytype_id'])->first();

            if ($holidaytype = 'مستحقة' || $holidaytype = 'مستحقه' || $holidaytype = 'اعتيادية' || $holidaytype = 'اعتياديه' || $holidaytype = 'مرضية' || $holidaytype = 'مرضيه'
                                    || $holidaytype = 'مرافق مريض ' || $holidaytype = 'اجازة وضع' || $holidaytype = 'اجازه وضع' || $holidaytype = 'اجازة حمل'
                                                    || $holidaytype = 'اجازه حمل' || $holidaytype = 'اجازة الحج' || $holidaytype = 'اجازه الحج') {
                $holidaypalance = DB::table('holiday_palances')->select('holidayPalance', 'id')->where('deleted_at', '=', null)->where('holidaytype_id', '=', $data['holidaytype_id'])->where('emp_id', '=', $emp_id)->first();
                $type_days = DB::table('holidaytypes')->select('type_days')->where('deleted_at', '=', null)->where('id', '=', $data['holidaytype_id'])->first();

                if (($holidaypalance->holidayPalance - $request->holidays_days) < 0) {

                    session()->flash('success', 'رصيد الاجازات للموظف غير كافي');
                    return view('admin.holidays.create', ['title' => trans('admin.create'), 'emps' => $emps]);
                } else {
                    $data['holidaytype_id'] = $request->holidaytype_id;
                    $data['holidays_days'] = $request->holidays_days;
                    $emp = emp::find($emp_id);
                    $data['hdate'] = date('M-Y');
                    $data['hyear'] = date('Y');
                    $data['month'] = date('m');


                    $data['emp_id'] = $emp_id;

                    $updatepalance = $holidaypalance->holidayPalance - $request->holidays_days;

                    DB::update('update holiday_palances set holidayPalance = ? where id =? AND  palyear=YEAR(CURDATE())', [$updatepalance, $holidaypalance->id]);
                    holiday::create($data);
                    $holiday = holiday::latest()->first()->id;
                    session()->flash('success', trans('admin.added'));

                    return redirect()->route('holidays.show', ['id' => $holiday]);
                }

            } // في حالة كانت مستحقة


            else {
                $data['holidaytype_id'] = $request->holidaytype_id;
                $data['holidays_days'] = $request->holidays_days;
                $emp = emp::find($emp_id);
                $data['hdate'] = date('M-Y');
                $data['hyear'] = date('Y');
                $data['month'] = date('M');

                $data['emp_id'] = $emp_id;


                holiday::create($data);
                $holiday = holiday::latest()->first()->id;
                session()->flash('success', trans('admin.added'));

                return redirect()->route('holidays.show', ['id' => $holiday]);

            } //في حالة لايوجد اي شروط ادخال الاجازات مفتوح مثل اصابة عمل اجازة مخالطة مريض
        }
        else{
            session()->flash('error', 'لايوجد رصيد اجازات للموظف بعد');
            return view('admin.holidays.create', ['title' => trans('admin.create'), 'emps' => $emps]);



        }
    }



    public function storefromhome(Request $request){

        $rules = [
            'holidaytype_id'=>'required|numeric',
            'emp_id'=>'required',
            'holiday_desc'=>'',
            'days'=>'numeric',
            'from'=>'',
            'to'=>'',

        ];
        $data = $this->validate(request(),$rules,[],[
            //'holidaytype_id'=>trans('admin.holidaytype_id'),
            'holiday_desc'=>trans('admin.holiday_desc'),
            // 'holidays_days'=>trans('admin.holidays_days'),

        ]);
        $emp_id=$request->emp_id;
        $holidaytype_id=$request->holidaytype_id;

        $holidaypalance= DB::table('holiday_palances')->select('holidayPalance','id')->where('deleted_at','=',null)->where('holidaytype_id','=',  $holidaytype_id)->where('emp_id','=',$emp_id)->first();

        if($holidaypalance != null) {
            $palanceafter=($holidaypalance->holidayPalance)-($request->days);
                if($palanceafter>0){


            $data['holidaytype_id'] = $request->holidaytype_id;
            $data['holidays_days'] = $request->days;
            $data['hdate'] = date('M-Y');
            $data['hyear'] = date('Y');
            $data['month'] = date('M');
            $data['emp_id'] = $request->emp_id;
            $data['emp_id'] = $request->emp_id;
            $data['fromdate'] = $request->from;
            $data['todate'] = $request->to;


            holiday::create($data);
              //      DB::table('holiday_palances')
                //        ->where('id', $holidaypalance->id)
                  //      ->update(['holidayPalance' => $palanceafter]);

                    $holiday = holiday::latest()->first()->id;
            session()->flash('success', trans('admin.added'));

            return redirect()->route('holidays.show', ['id' => $holiday]);
                }
                else{
                    session()->flash('error', 'رصيد الموظف غير كافي');
                    return view('admin.holidays.createfromhome', ['title' => trans('admin.create')]);
                }
        }

        else{
            session()->flash('error', 'لايوجد رصيد اجازات للموظف بعد');
            return view('admin.holidays.createfromhome', ['title' => trans('admin.create')]);
             }

    }

    /**
     * Display the specified resource.
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {

        $holidays =  holiday::find($id);
        return view('admin.holidays.show',['title'=>trans('admin.show'),'holidays'=>$holidays]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * edit the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $holidays =  holiday::find($id);
        return view('admin.holidays.edit',['title'=>trans('admin.edit'),'holidays'=>$holidays]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * update a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $rules = [
            'updating_reason'=>'required',

            'holiday_type'=>'required',
            'holiday_desc'=>'',
            'holidays_days'=>'numeric',

        ];
        $data = $this->validate(request(),$rules,[],[
            'holiday_type'=>trans('admin.holiday_type'),
            'holiday_desc'=>trans('admin.holiday_desc'),
            'holidays_days'=>trans('admin.holidays_days'),
        ]);
        $data['updating_reason']=$request->updating_reason;

        holiday::find($id)->update($data);

        session()->flash('success',trans('admin.updated'));
        return redirect(aurl('holidays'));
    }

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * destroy a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holidays = holiday::find($id);


        @$holidays->delete();
        session()->flash('success',trans('admin.deleted'));
        return back();
    }



    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if(is_array($data)){
            foreach($data as $id)
            {
                $holidays = holiday::find($id);

                @$holidays->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        }else {
            $holidays = holiday::find($data);


            @$holidays->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }


}

