<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\DataTables\holidayPalancesDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\holidayPalance;
use App\Model\emp;
use App\Model\holidaytype;


use Validator;
use Set;
use Up;
use Form;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class holidayPalances extends Controller
{

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(holidayPalancesDataTable $holidaypalances)
    {
        $year = session()->get('year');

        $pals=holidayPalance::with('emp')->where('deleted_at','=',null)->where('palyear','=',$year);

        return view('admin.holidaypalances.index',['title'=>trans('admin.holidaypalances'),'pals'=>$pals]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create($emp_id)
    {

        $holidaytypes=holidaytype::all();
//dd($holidaytypes);

        $emps=emp::find($emp_id);

        return view('admin.holidaypalances.create',['title'=>trans('admin.create'),'emps'=>$emps,'holidaytypes'=>$holidaytypes]);
    }

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function store($emp_id ,Request $request)
    {
        // dd($request->ids);
        $count= DB::table('holidaytypes')->where('deleted_at','=',null)->get()->count('id');
        $check= DB::table('holiday_palances')->where('deleted_at','=',null)->where('emp_id','=',$emp_id)->where('palyear','=',date('Y'))->first();
        // dd(date('Y'));
        if(empty($check)){
            $preyear=date('Y')-1; //مابش
            $type_id= DB::table('holidaytypes')->select('id')->where('deleted_at','=',null)->where('holidaytype','like','اجازة اعتيادية')->first();

            $perpal= DB::table('holiday_palances')->select('holidayPalance')->where('deleted_at','=',null)->where('emp_id','=',$emp_id)->where('palyear','=',$preyear)->where('holidaytype_id','=',$type_id->id)->first();



            for($i = 0; $i < $count; $i ++){

                $rules = [
                    'holidayPalance' => '',
                    //'holidaytype_id'=>'required|numeric',
                    //'note'=>'',

                ];
                $data = $this->validate(request(), $rules, [], [
                    //'holidayPalance' => trans('admin.holidayPalance'),
                    // 'holidaytype_id' => trans('admin.holidaytype_id'),
                    // 'note' => trans('admin.note'),

                ]);

                $data['emp_id'] = $emp_id;
                $data['palyear'] =date('Y');
                $data['paldate'] =date('Y,m,d');
                $data['month'] =date('m');

                $yearly_id= DB::table('holidaytypes')->select('id')->where('deleted_at','=',null)->where('holidaytype','like','اجازة اعتيادية')->first();

                $r=$request->ids[$i];
                $p=$request->holidayPalance[$i];
                if($r==$yearly_id->id){

                    $data['holidayPalance']=$p+$perpal;
                    if($data['holidayPalance']>90){
                        $data['holidayPalance']=90;
                    }
                }
                else{
                    $data['holidayPalance']=$request->holidayPalance[$i];
                }

                $data['holidaytype_id'] = $request->ids[$i];



                holidayPalance::create($data);
            }

            session()->flash('success',trans('admin.added'));
        }
        else{
            session()->flash('error','الموظف لدية رصيد بالفعل لهذه السنة');


        }
        return redirect()->route('emps.index');
    }

    /**
     * Display the specified resource.
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $holidaypalances =  holidayPalance::find($id);
        return view('admin.holidaypalances.show',['title'=>trans('admin.show'),'holidaypalances'=>$holidaypalances]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * edit the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $holidaypalances =  holidayPalance::find($id);
        return view('admin.holidaypalances.edit',['title'=>trans('admin.edit'),'holidaypalances'=>$holidaypalances]);
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

            'holidayPalance'=>'numeric',
            'emp_id'=>'required|numeric',
            'holidaytype_id'=>'required|numeric',
            'note'=>'',

        ];
        $data = $this->validate(request(),$rules,[],[
            'holidayPalance'=>trans('admin.holidayPalance'),
            'emp_id'=>trans('admin.emp_id'),
            'holidaytype_id'=>trans('admin.holidaytype_id'),
            'note'=>trans('admin.note'),
        ]);
        $data['updating_reason']=$request->updating_reason;

        holidayPalance::  find($id)->update($data);

        session()->flash('success',trans('admin.updated'));
        return redirect(aurl('holidaypalances'));
    }

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * destroy a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holidaypalances = holidayPalance::find($id);


        @$holidaypalances->delete();
        session()->flash('success',trans('admin.deleted'));
        return back();
    }



    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if(is_array($data)){
            foreach($data as $id)
            {
                $holidaypalances = holidayPalance::find($id);

                @$holidaypalances->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        }else {
            $holidaypalances = holidayPalance::find($data);


            @$holidaypalances->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }


}
