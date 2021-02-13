<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\officialHolidaysDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Model\officialHoliday;
use Validator;
use Set;
use Up;
use Form;
use DateTime;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class officialHolidays extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(officialHolidaysDataTable $officialholidays)
            {
               return $officialholidays->render('admin.officialholidays.index',['title'=>trans('admin.officialholidays')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.officialholidays.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store()
            {
              $rules = [
             'holiday_name'=>'required',
             'holiday_month'=>'date',
             'holiday_month_end'=>'date',
            'off_days'=>'numeric',
            'odate'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'holiday_name'=>trans('admin.holiday_name'),
             'holiday_month'=>trans('admin.holiday_month'),
             'holiday_month_end'=>trans('admin.holiday_month_end'),


              ]);

               $data['off_days']= Carbon::parse($data['holiday_month'])->diffInDays( Carbon::parse($data['holiday_month_end']));
               $data['odate']=date('M-Y');
                $data['oyear'] = date('Y');

                //  dd($data);
              officialHoliday::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('officialholidays'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $officialholidays =  officialHoliday::find($id);
                return view('admin.officialholidays.show',['title'=>trans('admin.show'),'officialholidays'=>$officialholidays]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $officialholidays =  officialHoliday::find($id);
                return view('admin.officialholidays.edit',['title'=>trans('admin.edit'),'officialholidays'=>$officialholidays]);
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
             'holiday_name'=>'required',
             'official_holidays_days'=>'required|numeric',
             'holiday_month'=>'date',
                    'updating_reason'=>'required',


                ];
             $data = $this->validate(request(),$rules,[],[
             'holiday_name'=>trans('admin.holiday_name'),
             'official_holidays_days'=>trans('admin.official_holidays_days'),
             'holiday_month'=>trans('admin.holiday_month'),
                   ]);
                $data['updating_reason']=$request->updating_reason;

                officialHoliday::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('officialholidays'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $officialholidays = officialHoliday::find($id);


               @$officialholidays->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$officialholidays = officialHoliday::find($id);

                    	@$officialholidays->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $officialholidays = officialHoliday::find($data);


                    @$officialholidays->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
