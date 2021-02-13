<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\emps;

use App\Model\per;
use Illuminate\Support\Facades\DB;


use App\DataTables\tasksDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\task;
use App\Model\emp;
use App\Model\user;


use Validator;
use Set;
use Up;
use Form;


// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class tasks extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(tasksDataTable $tasks,$emp_id)
            {
                $emps =  emp::find($emp_id);

               return $tasks->render('admin.tasks.index',['title'=>trans('admin.tasks'),'tasks'=>$tasks,'emps'=>$emps] );
            }

    public function alltasks(){
        $year = session()->get('year');

        $tasks=  DB::table('tasks')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        return view('admin.tasks.alltasks',['title'=>trans('admin.all'),'tasks'=>$tasks]);


    }

    public function evaluationfromhome(){


       return view('admin.tasks.Evaluation',['title'=>trans('admin.create')]);

     }



    public function search($employee)
    {
        $year = session()->get('year');



        if( $employee !==0) {
            $data = emp::with('department','administration','publicAdmin','user','job','sector')
                ->where('deleted_at','=',null)
                ->where('id', '=', $employee)
                ->first();

            $tasks=task::with('emp')
                ->where('deleted_at','=',null)
                ->where('emp_id', '=', $employee)
                ->where('month', '=', date('m'))
                ->where('tyear', '=', date('Y'))
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
<th style=" border: none;">عدد المهام الموكلة للموظف لهذا الشهر    : </th>
         <td class="text-left" style=" border: none;">'.$tasks.'</td>
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


    public function searchevaluation($task)
    {
        $year = session()->get('year');



        if( $task !==0) {
            $data = task::with('emp')
                ->where('deleted_at','=',null)
                ->where('id', '=', $task)
                ->first();
//
//            $emp=emp::with('tasks')
//                ->where('deleted_at','=',null)
//                ->where('emp_id', '=', $employee)
//                ->where('month', '=', date('m'))
//                ->where('tyear', '=', date('Y'))
//                ->count('id')







        }



        $output = '';


        $total_row = $data->count();
        if($total_row > 0)
        {


            $output .= '

         <tr>

         <th colspan="2" class="text-center" style="color:white; border: none;">'.$data->emp->emp_name.' '.$data->emp->second_name.' '.$data->emp->third_name.' '.$data->emp->last_name.'</th>
         </tr>
          <tr>

         <th colspan="2" class="text-center" style=" border: none;">'.$data->emp->job->job_name.'</th>
         </tr>
          <tr>
           <tr>
    <th >اسم المهمة   : </th>
         <td class="text-left">'.$data->task_name.' </td>
         </tr>
    <th >وصف المهمة   : </th>
         <td class="text-left">'.$data->task_desc.' </td>
         </tr>

         <tr>
 <th style=" border: none;">حالة المهمة   : </th>
         <td class="text-left" style=" border: none;">'.$data->status.'</td>
         </tr>
           <tr>
<th style=" border: none;">عدد ايام التنفيذ   : </th>
         <td class="text-left" style=" border: none;">'.$data->days .'</td>
         </tr>

          <tr>
<th style=" border: none;">تاريخ انشاء المهمة   : </th>
         <td class="text-left" style=" border: none;">'.Carbon::parse($data->updated_at)->format("Y-m-d").'</td>
         </tr>
          <tr>


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
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create($emp_id)
            {

                $emps =  emp::find($emp_id);
             // dd( $task->emp->emp_name);


              return view('admin.tasks.create',['title'=>trans('admin.create'),'emps'=>$emps]);
            }

    public function createfromhome()
    {
        return view('admin.tasks.createfromhome',['title'=>trans('admin.create')]);
    }




            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store($emp_id ,Request $request)
            {
              //dd($request->all());

              $rules = [
                'task_name'=>'required',
               'task_desc'=>'',
               'type'=>'',
               'note'=>'',
               'days'=>'required|numeric',
               'status'=>'required',
               'task_rate'=>'',
               'tdate'=>'required',
                 // 'updating_reason'=>'required',


              ];
                 $data = $this->validate(request(),$rules,[],[
                'task_name'=>trans('admin.task_name'),
                'task_desc'=>trans('admin.task_desc'),
                'type'=>trans('admin.type'),
                'note'=>trans('admin.note'),
                'status'=>trans('admin.status'),
                'task_rate'=>trans('admin.task_rate'),

                 ]);
                 $emp =  emp::find($emp_id);
                $emps =  emp::find($emp_id);



                $data['tdate'] =Carbon::parse($request->tdate)->format('Y-m');
                $data['tyear'] = Carbon::parse($request->tdate)->format('Y');
                $data['month'] =Carbon::parse($request->tdate)->format('m');


                 $data['admin_id'] = admin()->user()->id;
                 $data['emp_id'] = $emp_id;



                task::create($data);


                session()->flash('success',trans('admin.added'));


                return view('admin.tasks.create',['title'=>trans('admin.create'),'emps'=>$emps]);



            }

            public function storeevaluation(Request $request){

                $rules = [

                    'task_rate'=>'required',


                ];
                $data = $this->validate(request(),$rules,[],[

                ]);

                $id=task::find($request->task_id);
//                $post->update(['field' => 'value']);
                $id->update(['task_rate' => $request->task_rate,'status' => 'انتهت المهمة']);

                session()->flash('success',trans('admin.updated'));
                return back();


            }


            public function storefromhome(Request $request)
    {
        //dd($request->all());

        $rules = [
            'emp_id'=>'required',

            'task_name'=>'required',
            'task_desc'=>'',
            'type'=>'',
            'note'=>'',
            'days'=>'required|numeric',
            'status'=>'required',
            'task_rate'=>'',
            'tdate'=>'required',
            // 'updating_reason'=>'required',


        ];
        $data = $this->validate(request(),$rules,[],[
            'task_name'=>trans('admin.task_name'),
            'task_desc'=>trans('admin.task_desc'),
            'type'=>trans('admin.type'),
            'note'=>trans('admin.note'),
            'status'=>trans('admin.status'),
            'task_rate'=>trans('admin.task_rate'),

        ]);
        $emp_id = $request->emp_id ;
        $emps = $request->emp_id ;


        $data['tdate'] =Carbon::parse($request->tdate)->format('Y-m');
        $data['tyear'] = Carbon::parse($request->tdate)->format('Y');
        $data['month'] =Carbon::parse($request->tdate)->format('m');

        $data['admin_id'] = admin()->user()->id;
        $data['emp_id'] = $emp_id;



        task::create($data);


        session()->flash('success',trans('admin.added'));


        return back();



    }


    /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {

                $tasks =  task::find($id);




                return view('admin.tasks.show',['title'=>trans('admin.show'),'tasks'=>$tasks]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit( $id)
            {
                $emp= task::find($id)->emps;

                $tasks =  task::find($id);
                return view('admin.tasks.edit',['title'=>trans('admin.edit'),'tasks'=>$tasks,'emp'=>$emp]);
            }




            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update(Request $request ,$id)
            {
                $rules = [
             'task_name'=>'required',
             'task_desc'=>'',
             'type'=>'',
             'note'=>'',
             'days'=>'required|numeric',
             'status'=>'required',
             'task_rate'=>'',
                    //'updating_reason'=>'',


                ];
             $data = $this->validate(request(),$rules,[],[
             'task_name'=>trans('admin.task_name'),
             'task_desc'=>trans('admin.task_desc'),
             'days'=>trans('admin.days'),
             'status'=>trans('admin.status'),
                 'type'=>trans('admin.type'),
                 'note'=>trans('admin.note'),
             'task_rate'=>trans('admin.task_rate'),
                   ]);

              $data['admin_id'] = admin()->user()->id;
                $data['updating_reason']=$request->updating_reason;

                task::  find($id)->update($data);
                $emp =  task::find($id)->emp_id;
               // dd($emp_id);

              session()->flash('success',trans('admin.updated'));
               return redirect()->route('emps.show',['emp'=>$emp]);


                //return redirect(aurl('tasks'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $tasks = task::find($id);

                //$tasks->delete();
               @$tasks->delete();

               session()->flash('success',trans('admin.deleted'));
               return back();
            }







 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$tasks = task::find($id);

                    	@$tasks->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $tasks = task::find($data);


                    @$tasks->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


            public function rate(Request $request ,$id)
            {
               $tasks = task::find($id);


               $rules = [

                'task_rate'=>'numeric',

                            ];
                $data = $this->validate(request(),$rules,[],[

                'task_rate'=>trans('admin.task_rate'),
                      ]);
                 $data['admin_id'] = admin()->user()->id;
                 task::  find($id)->update($data);

                 session()->flash('success',trans('admin.updated'));
                 return view('admin.tasks.rate',['title'=>trans('admin.edit'),'tasks'=>$tasks]);


            }


}
