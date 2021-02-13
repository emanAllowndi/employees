<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\trainingsDataTable;
use App\Model\emp;
use App\Model\per;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\training;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class trainings extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */


    public function index()
    {
        $year = session()->get('year');

        $trainings=training::with('emp')->where('deleted_at','=',null)->where('trayear','=',$year)->get();
        return view('admin.trainings.index',['title'=>trans('admin.all'),'trainings'=>$trainings]);
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
        return view('admin.trainings.createfromhome',['title'=>trans('admin.create')]);
    }


    /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
    public function create($emp_id)
    {

        $emps =  emp::find($emp_id);

        return view('admin.trainings.create',['title'=>trans('admin.create'),'emps'=>$emps]);
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
             'course'=>'',
             'tradate'=>'required',


                   ];
              $data = $this->validate(request(),$rules,[],[


              ]);
                $data['coursenum'] =$request->course;
                $data['emp_id'] =$id;

                $data['tradate'] =Carbon::parse($request->tradate)->format('Y-m');
                $data['trayear'] = Carbon::parse($request->tradate)->format('Y');
                $data['month'] =Carbon::parse($request->tradate)->format('m');





              training::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('emps'));
            }


    public function storefromhome(request $request)
    {
        $rules = [
            'coursenum'=>'',
            'tradate'=>'required',

            'emp_id'=>'',

        ];
        $data = $this->validate(request(),$rules,[],[

            'emp_id'=>trans('admin.emp_id'),

        ]);
        $data['coursenum'] =$request->coursenum;
        $data['tradate'] =Carbon::parse($request->tradate)->format('Y-m');
        $data['trayear'] = Carbon::parse($request->tradate)->format('Y');
        $data['month'] =Carbon::parse($request->tradate)->format('m');


        training::create($data);

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
                $trainings =  training::find($id);
                return view('admin.trainings.show',['title'=>trans('admin.show'),'trainings'=>$trainings]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $trainings =  training::find($id);
                return view('admin.trainings.edit',['title'=>trans('admin.edit'),'trainings'=>$trainings]);
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
             'coursenum'=>'',
             'tradate'=>'',
             'trayear'=>'',
             'emp_id'=>'',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'coursenum'=>trans('admin.coursenum'),
             'tradate'=>trans('admin.tradate'),
             'trayear'=>trans('admin.trayear'),
             'emp_id'=>trans('admin.emp_id'),
                   ]);

              training::where('id',$id)->update($data);

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
               $trainings = training::find($id);


               @$trainings->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$trainings = training::find($id);

                    	@$trainings->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $trainings = training::find($data);


                    @$trainings->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
