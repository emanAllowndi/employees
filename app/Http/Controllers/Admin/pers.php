<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\emps;

use App\DataTables\persDataTable;
use App\Model\holidayPalance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\per;
use App\Model\emp;
use App\Model\user;
use App\Model\department;
use App\Model\job;
use App\Model\audit;
use Illuminate\Support\Facades\DB;




use Validator;
use Set;
use Up;
use Form;
use Barryvdh\DomPDF\PDF;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class pers extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(persDataTable $pers)
            {
               return $pers->render('admin.pers.index',['title'=>trans('admin.pers')]);
            }

    public function allpers(){
        $year = session()->get('year');

        $pers=  DB::table('pers')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        return view('admin.pers.allpers',['title'=>trans('admin.all'),'pers'=>$pers]);


    }



    public function audits (){

        $audits = audit::all();
        //dd($audit->id);




        return view('admin.audits',['audits'=>$audits]);


    }

        /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create($emp_id)
            {
                $emps =  emp::find($emp_id);
               return view('admin.pers.create',['title'=>trans('admin.create'),'emps'=>$emps]);
            }

    public function createfromhome()
    {
        return view('admin.pers.createfromhome',['title'=>trans('admin.create')]);
    }


    public function search($employee)
    {
        $year = session()->get('year');



        if( $employee !==0) {
            $data = emp::with('department','administration','publicAdmin','user','job','sector')
                ->where('deleted_at','=',null)
                ->where('id', '=', $employee)
                ->first();

            $pers=per::with('emp')
                ->where('deleted_at','=',null)
                ->where('emp_id', '=', $employee)
                ->where('month', '=', date('m'))
                ->where('pyear', '=', date('Y'))
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
<th style=" border: none;">عدد الاذون المأخوذة لهذا الشهر    : </th>
         <td class="text-left" style=" border: none;">'.$pers.'</td>
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


    /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store($emp_id ,Request $request)
            {
              $rules = [
             'per_cause'=>'required',
             'pdate'=>'required',
             'from'=> '',
             'to'=> '',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'per_cause'=>trans('admin.per_cause'),
             'from'=>trans('admin.from'),
             'to'=>trans('admin.to'),


              ]);

              $emp =  emp::find($emp_id);
                $data['pdate'] =Carbon::parse($request->pdate)->format('Y-m');
                $data['pyear'] = Carbon::parse($request->pdate)->format('Y');
                $data['month'] =Carbon::parse($request->pdate)->format('m');

              $data['emp_id'] = $emp_id;


              per::create($data);
              $per=per::latest()->first()->id;
              session()->flash('success',trans('admin.added'));
              return redirect()->route('pers.show',['id'=>$per]);
            }



    public function storefromhome(Request $request)
    {
        $rules = [
            'per_cause'=>'required',
            'emp_id'=>'required',
            'pdate'=>'required',
            'from'=> '',
            'to'=> '',

        ];
        $data = $this->validate(request(),$rules,[],[
            'per_cause'=>trans('admin.per_cause'),
            'from'=>trans('admin.from'),
            'to'=>trans('admin.to'),


        ]);
        $emp_id=$request->emp_id;

        $emp =  emp::find($emp_id);



        $data['pdate'] =Carbon::parse($request->pdate)->format('Y-m');
        $data['pyear'] = Carbon::parse($request->pdate)->format('Y');
        $data['month'] =Carbon::parse($request->pdate)->format('m');


        $data['emp_id'] = $emp_id;


        per::create($data);
        $per=per::latest()->first()->id;
        session()->flash('success',trans('admin.added'));
        return redirect()->route('pers.show',['id'=>$per]);
    }


    /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {

                $pers =  per::find($id);
                $emp=emp::find($pers->emp->id);

                return view('admin.pers.show',['title'=>trans('admin.show'),'pers'=>$pers,'emp'=>$emp]);
            }


    public function createPDF($id) {
        // retreive all records from db


        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::Write(0, 'Hello World');
        PDF::Output('hello_world.pdf');

    }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $pers =  per::find($id);
                return view('admin.pers.edit',['title'=>trans('admin.edit'),'pers'=>$pers]);
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
             'per_type'=>'required',
             'per_desc'=>'',
                    'updating_reason'=>'required',
					 'pdate'=>'required',
            'from'=> '',
            'to'=> ''

                ];
             $data = $this->validate(request(),$rules,[],[
             'per_type'=>trans('admin.per_type'),
             'per_desc'=>trans('admin.per_desc'),
			 'from'=>trans('admin.from'),
            'to'=>trans('admin.to'),
                   ]);
                $data['updating_reason']=$request->updating_reason;
				
        $data['pdate'] =Carbon::parse($request->pdate)->format('Y-m');
        $data['pyear'] = Carbon::parse($request->pdate)->format('Y');
        $data['month'] =Carbon::parse($request->pdate)->format('m');


                per::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('pers'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $pers = per::find($id);


               @$pers->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$pers = per::find($id);

                    	@$pers->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $pers = per::find($data);


                    @$pers->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
