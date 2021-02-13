<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\usersDataTable;
use App\Model\audit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\user;
use App\Model\emp;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Validator;
use Set;
use Up;
use Form;


// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class users extends Controller
{


    /**

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
     */
            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return Response
             */
            public function index(usersDataTable $users)
            {
               return $users->render('admin.users.index',['title'=>trans('admin.users')]);
            }

    public function allusers(){
        //$year = session()->get('year');

        $users=  DB::table('users')->where('deleted_at','=',null)->get();



        return view('admin.users.allusers',['title'=>trans('admin.all'),'users'=>$users]);


    }


    public function showaudits($id)
    {

        $audits =  audit::find($id);
////        $array_data1 = json_decode($audits->old_values, true);
//////        $array_data2 = json_decode($audits->new_values, true);
//        $nameArr = [];
//        $responseArray = json_decode($audits->old_values->getBody(), true); // set true here
//        foreach ($responseArray['workspaces']['workspace'] as $row) {
//            $nameArr[] = $row['name'];
//        }
//        dd($nameArr);

        return view('admin.users.showaudits',['title'=>trans('admin.show'),'audits'=>$audits]);
    }



            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
             */
            public function create($emp_id)

            {

                $emp=DB::table('emps')->where('id','=',$emp_id)->first();
               // dd($emp->emp_name );
               return view('admin.users.create',['title'=>trans('admin.create'),'emp'=>$emp]);
            }

    public function createfromuser()

    {
    return view('admin.users.createfromuser',['title'=>trans('admin.create')]);
    }
    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Store a newly created resource in storage.
     * @param Request $r
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */

    public function storefromuser()
    {

        $rules = ([

            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
            'photo_profile'=>''.it()->image().'|nullable',
            'emp_id'=>'unique:users,emp_id',
            'updating_reason'=>'',
            'first_name'=>'',
            'middel_name'=>'',
            'last_name'=>'',



        ]);
        $data = $this->validate(request(),$rules,[],[

            'email'=>trans('admin.email'),
            'first_name'=>trans('admin.first_name'),
            'middel_name'=>trans('admin.middel_name'),
            'last_name'=>trans('admin.last_name'),
            'photo_profile'=>trans('admin.photo_profile'),


        ]);

        $data['password']=bcrypt($request->password);

        //$data['emp_id']=0;

        if(request()->hasFile('photo_profile')){
            $data['photo_profile'] = it()->upload('photo_profile','users');
        }
        //dd($data['password']);




        $user=user::create($data);
        $user->attachRole($request->role);

        $permissions=DB::table('permission_role')->where('role_id','=',$request->role)->get();
        foreach ($permissions as $permission){
            $user->attachPermission($permission->permission_id);
        }
        session()->flash('success',trans('admin.added'));
        return redirect(aurl('users'));

    }

    public function store($emp_id ,Request $request)
            {

                //dd($emp);
                //dd(trans('admin.password'));
            // dd($request->password);
                $rules = ([

             'email'=>'required|unique:users,email',
             'password'=>'required|confirmed',
             'photo_profile'=>''.it()->image().'|nullable',
             'emp_id'=>'unique:users,emp_id',
             'updating_reason'=>'',




                ]);
              $data = $this->validate(request(),$rules,[],[

             'email'=>trans('admin.email'),
              'photo_profile'=>trans('admin.photo_profile'),


              ]);
                $emp=DB::table('emps')->where('id','=',$emp_id)->first();

                $data['password']=bcrypt($request->password);
               $data['first_name']=$emp->emp_name;
                $data['middel_name']=$emp->second_name;
                $data['last_name']=$emp->last_name;
                $data['emp_id']=$emp->id;

                if(request()->hasFile('photo_profile')){
                    $data['photo_profile'] = it()->upload('photo_profile','users');
                }
                //dd($data['password']);
                $there=DB::table('users')->where('deleted_at','=',null)->where('emp_id','=',$emp_id)->first();

                if(empty($there)){


                $user=user::create($data);
            $user->attachRole($request->role);

            $permissions=DB::table('permission_role')->where('role_id','=',$request->role)->get();
            foreach ($permissions as $permission){
                $user->attachPermission($permission->permission_id);
            }
                    session()->flash('success',trans('admin.added'));
                return redirect(aurl('emps'));}
                else{

                    session()->flash('success','المستخدم موجود مسبقاً');
                    return redirect(aurl('emps'));
                }
            }



    /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return Response
             */
            public function show($id)
            {
                $users =  user::find($id);
                return view('admin.users.show',['title'=>trans('admin.show'),'users'=>$users]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return Response
             */

			public function edit($id)
            {
                $users=DB::table('users')->where('deleted_at','=',null)->where('id','=',$id)->first();
               // dd($users->id);
               $user =  user::find($id);
                return view('admin.users.edit',['title'=>trans('admin.edit'),'users'=>$users],compact('user'));
            }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * update a newly created resource in storage.
     * @param Request $r
     * @return Response
     * @throws ValidationException
     */
            public function update(Request $request,$id)

            {
                $request->validate([
                    'first_name'=>'required|string',
                    'middel_name'=>'',
                    'last_name'=>'',
                    'email'=>'required',
                    'photo_profile'  => 'sometimes|nullable|'.it()->image(),
                   'updating_reason'=>'',
                    'role'=>'required',

                 ]);





                $data['updating_reason']=$request->updating_reason;

				$user = User::find($id);
                $user->roles()->sync($request->role);


                $permissions=DB::table('permission_role')->select('permission_id')->where('role_id','=',$request->role)->get();
                   foreach ($permissions as $permission){
                       $per[]=$permission->permission_id;
                   }
                    $user->permissions()->sync($per);


              //$user->attachRole('admin');





              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('users'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param Request $r
             * @return Response
             */
            public function destroy($id)
            {
               $users = user::find($id);


               @$users->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$users = user::find($id);

                    	@$users->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $users = user::find($data);


                    @$users->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
