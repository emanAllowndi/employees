<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\behaviorsDataTable;
use App\Model\emp;
use App\Model\per;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\behavior;
use Illuminate\Support\Facades\DB;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class behaviors extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
                $year = session()->get('year');

                $behaviors=behavior::with('emp')->where('deleted_at','=',null)->where('beyear','=',$year)->get();
                return view('admin.behaviors.index',['title'=>trans('admin.all'),'behaviors'=>$behaviors]);
            }




    public function search($employee)
    {
        $year = session()->get('year');



        if( $employee !==0) {
            $data = emp::with('department','administration','publicAdmin','user','job','sector')
                ->where('deleted_at','=',null)
                ->where('id', '=', $employee)
                ->first();






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
            //'total_data'  => $data2,
        );

        echo json_encode($data);

    }


    public function createfromhome()
    {
        return view('admin.behaviors.createfromhome',['title'=>trans('admin.create')]);
    }




    /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
    public function create($emp_id)
    {

        $emps =  emp::find($emp_id);

        return view('admin.behaviors.create',['title'=>trans('admin.create'),'emps'=>$emps]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request,$id)
            {
              $rules = [
             'behavior'=>'required',
             'bedate'=>'required',


                   ];
              $data = $this->validate(request(),$rules,[],[
             'behavior'=>trans('admin.behavior'),


              ]);

                $data['bedate'] =Carbon::parse($request->bedate)->format('Y-m');
                $data['beyear'] = Carbon::parse($request->bedate)->format('Y');
                $data['month'] =Carbon::parse($request->bedate)->format('m');


                $data['emp_id'] =$id;

              behavior::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('emps'));
            }
    public function storefromhome(request $request)
    {
        $rules = [
            'behavior'=>'required',
            'bedate'=>'required',

            'emp_id'=>'',

        ];
        $data = $this->validate(request(),$rules,[],[
            'behavior'=>trans('admin.behavior'),

            'emp_id'=>trans('admin.emp_id'),

        ]);

        $data['bedate'] =Carbon::parse($request->bedate)->format('Y-m');
        $data['beyear'] = Carbon::parse($request->bedate)->format('Y');
        $data['month'] =Carbon::parse($request->bedate)->format('m');

        behavior::create($data);

        session()->flash('success',trans('admin.added'));
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
                $behaviors =  behavior::find($id);
                return view('admin.behaviors.show',['title'=>trans('admin.show'),'behaviors'=>$behaviors]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $behaviors =  behavior::find($id);
                return view('admin.behaviors.edit',['title'=>trans('admin.edit'),'behaviors'=>$behaviors]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = [
             'behavior'=>'',
             'bedate'=>'',
             'beyear'=>'',
             'emp_id'=>'',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'behavior'=>trans('admin.behavior'),
             'bedate'=>trans('admin.bedate'),
             'beyear'=>trans('admin.beyear'),
             'emp_id'=>trans('admin.emp_id'),
                   ]);
              behavior::where('id',$id)->update($data);

              session()->flash('success',trans('admin.updated'));
                return back();
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $behaviors = behavior::find($id);


               @$behaviors->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$behaviors = behavior::find($id);

                    	@$behaviors->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $behaviors = behavior::find($data);


                    @$behaviors->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
