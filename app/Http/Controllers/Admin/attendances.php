<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\attendancesDataTable;
use App\Model\holiday;
use App\Model\per;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\attendance;
use App\Model\emp;
use DateTime;
use App\Model\officialHoliday;
use Illuminate\Support\Facades\DB;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class attendances extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(attendancesDataTable $attendances)
            {
               return $attendances->render('admin.attendances.index',['title'=>trans('admin.attendances')]);
            }

    public function allattendances(){
        $year = session()->get('year');

        $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();

        return view('admin.attendances.allattendances',['title'=>trans('admin.all'),'attendances'=>$attendances]);


    }


    public function search($employee)
    {
        $year = session()->get('year');



        if( $employee !==0) {
            $data = emp::with('department','administration','publicAdmin','user','job','sector')
                ->where('deleted_at','=',null)
                ->where('id', '=', $employee)
                ->first();

            $holidays=holiday::with('emp')
                ->where('deleted_at','=',null)
                ->where('emp_id', '=', $employee)
                ->where('month', '=', date('m'))
                ->where('hyear', '=', date('Y'))
                ->count('id')
            ;






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


<tr>
<th style=" border: none;">عدد الاجازات المأخوذة لهذا الشهر    : </th>
         <td class="text-left" style=" border: none;">'.$holidays.'</td>
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
            //'total_data'  => $data2,
        );

        echo json_encode($data);

    }

    public function createfromhome()
    {
        return view('admin.attendances.createfromhome',['title'=>trans('admin.create')]);
    }




    /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create($emp_id)

            {

                $emps=emp::find($emp_id);
               return view('admin.attendances.create',['title'=>trans('admin.create'),'emps'=>$emps]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store($emp_id ,Request $request)
            {
              $rules = [
             'att_days'=>'required|numeric',
             'absent_days'=>'required|numeric',
             'note'=>'',
             'adate'=>'required',


                   ];
              $data = $this->validate(request(),$rules,[],[
             'att_days'=>trans('admin.att_days'),
             'absent_days'=>trans('admin.absent_days'),
             'note'=>trans('admin.note'),


              ]);
              $emp =  emp::find($emp_id);
             // $dates = new \DateTime('now');

                $data['adate'] =Carbon::parse($request->adate)->format('Y-m');
                $data['ayear'] = Carbon::parse($request->adate)->format('Y');
                $data['month'] =Carbon::parse($request->adate)->format('m');



                $data['emp_id'] = $emp_id;
                $emp=emp::find($emp_id);
                $cheak=DB::table('attendances')->where('emp_id','=',$emp_id)->where('month','=', $data['month'])->where('ayear','=', $data['ayear'])->first();
               // dd($cheak);
                if(empty($cheak)){

                    attendance::create($data);


                    session()->flash('success',trans('admin.added'));

                }
             else{
                 session()->flash('success','تم اضافة الدوام لهذا الموظف مسبقاً');

             }
                return redirect()->route('emps.index');

            }


            public function storefromhome(Request $request){

                $rules = [
                    'emp_id' => 'required',
                    'att_days'=>'required|numeric',
                    'absent_days'=>'required|numeric',
                    'note'=>'',
                    'adate'=>'required',


                ];
                $data = $this->validate(request(),$rules,[],[
                    'att_days'=>trans('admin.att_days'),
                    'absent_days'=>trans('admin.absent_days'),
                    'note'=>trans('admin.note'),


                ]);
                $emp_id =$request->emp_id;
                // $dates = new \DateTime('now');

                $data['adate'] =Carbon::parse($request->adate)->format('Y-m');
                $data['ayear'] = Carbon::parse($request->adate)->format('Y');
                $data['month'] =Carbon::parse($request->adate)->format('m');

                $data['emp_id'] = $emp_id;
                $cheak=DB::table('attendances')->where('emp_id','=',$emp_id)->where('month','=', $data['month'])->where('ayear','=', $data['ayear'])->first();
                // dd($cheak);
                if(empty($cheak)){

                    attendance::create($data);


                    session()->flash('success',trans('admin.added'));

                }
                else{
                    session()->flash('error','تم اضافة الدوام لهذا الموظف مسبقاً');

                }
                return view('admin.home');



            }
            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $attendances =  attendance::find($id);
                return view('admin.attendances.show',['title'=>trans('admin.show'),'attendances'=>$attendances]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $attendances =  attendance::find($id);
                return view('admin.attendances.edit',['title'=>trans('admin.edit'),'attendances'=>$attendances]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id ,Request $request)
            {
                $rules = [
             'att_days'=>'required|numeric',
             'absent_days'=>'required|numeric',
             'note'=>'',
                    'updating_reason'=>'required',


                ];
             $data = $this->validate(request(),$rules,[],[
             'att_days'=>trans('admin.att_days'),
             'absent_days'=>trans('admin.absent_days'),
             'note'=>trans('admin.note'),
             'emp_id'=>trans('admin.emp_id'),
                   ]);
                $data['updating_reason']=$request->updating_reason;

                attendance::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));

                return redirect(aurl('attendances'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $attendances = attendance::find($id);


               @$attendances->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$attendances = attendance::find($id);

                    	@$attendances->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $attendances = attendance::find($data);


                    @$attendances->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
