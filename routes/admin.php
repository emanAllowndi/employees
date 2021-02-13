<?php

/*
|--------------------------------------------------------------------------
| Web Admin Panel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

app()->singleton('admin', function () {
		return 'admin';
	});

\L::Panel(app('admin'));/// Set Lang redirect to admin
\L::LangNonymous();// Run Route Lang 'namespace' => 'Admin',

Route::group(['prefix' => app('admin'), 'middleware' => 'Lang'], function () {

		Route::get('theme/{id}', 'Admin\Dashboard@theme');
		Route::group(['middleware' => 'admin_guest'], function () {

				Route::get('login', 'Admin\AdminAuthenticated@login_page');
				Route::post('login', 'Admin\AdminAuthenticated@login_post');

				Route::post('reset/password', 'Admin\AdminAuthenticated@reset_password');
				Route::get('password/reset/{token}', 'Admin\AdminAuthenticated@reset_password_final');
				Route::post('password/reset/{token}', 'Admin\AdminAuthenticated@reset_password_change');
			});
		/*
		|--------------------------------------------------------------------------
		| Web Routes
		|--------------------------------------------------------------------------
		| Do not delete any written comments in this file
		| These comments are related to the application (it)
		| If you want to delete it, do this after you have finished using the application
		| For any errors you may encounter, please go to this link and put your problem
		| phpanonymous.com/it/issues
		 */

		Route::group(['middleware' => 'admin:admin'], function () {
				//////// Admin Routes /* Start */ //////////////
				Route::get('/', 'Admin\Dashboard@home')->name('home');
				Route::any('logout', 'Admin\AdminAuthenticated@logout');

				Route::get('account', 'Admin\AdminAuthenticated@account');
				Route::post('account', 'Admin\AdminAuthenticated@account_post');
				Route::resource('settings', 'Admin\Settings');

				Route::resource('jobs','Admin\jobs');
Route::post('jobs/multi_delete','Admin\jobs@multi_delete');


				Route::resource('departments','Admin\departments');
Route::post('departments/multi_delete','Admin\departments@multi_delete');
            Route::any('performances','Admin\emps@performance')->name('emps.performance');

Route::resource('emps','Admin\emps');
Route::post('emps/multi_delete','Admin\emps@multi_delete');
Route::GET('emps/details/{emp_id}','Admin\emps@details')->name('emps.details');
Route::get('emps/names/me','Admin\emps@names')->name('emps.names');

Route::GET('emps/{id}','Admin\emps@holishow')->name('holishow.show');




//Route::resource('tasks','Admin\tasks');
					           //employee tasks//

			Route::GET('tasks/{emp_id}','Admin\tasks@index')->name('tasks.index');
			Route::GET('tasks/{emp_id}','Admin\tasks@create')->name('tasks.create');
			Route::POST('tasks/{emp_id}','Admin\tasks@store')->name('tasks.store');
			Route::GET('emps/tasks/show/{id}','Admin\tasks@show')->name('tasks.show');
			Route::GET('tasks/{id}/edit','Admin\tasks@edit')->name('tasks.edit');

			Route::GET('tasks/{id}/addrate','Admin\tasks@addrate')->name('tasks.addrate');
			Route::PUT('tasks/{id}','Admin\tasks@updaterate')->name('tasks.updaterate');
            Route::GET('tasks','Admin\tasks@alltasks')->name('tasks.all');




            Route::PUT('tasks/{id}','Admin\tasks@update')->name('tasks.update');
			Route::DELETE('tasks/{id}','Admin\tasks@destroy')->name('tasks.destroy');

			Route::POST('emps/tasks/{id}','Admin\tasks@rate')->name('tasks.rate');

            Route::any('createtask','Admin\tasks@createfromhome')->name('tasks.createfromhome');
            Route::GET('search/{employee}','Admin\tasks@search');
            Route::POST('storetask','Admin\tasks@storefromhome')->name('tasks.storefromhome');


            Route::any('evaluation','Admin\tasks@evaluationfromhome')->name('tasks.evaluationfromhome');
            Route::GET('searche/{task}','Admin\tasks@searchevaluation');
            Route::any('evaluationstore','Admin\tasks@storeevaluation')->name('tasks.storeevaluation');



            Route::POST('tasks/multi_delete','Admin\tasks@multi_delete');





								//end of employee tasks//



								//employee holidays//
							//	Route::resource('holidays','Admin\holidays');


			Route::GET('holidays/{emp_id}','Admin\holidays@index')->name('holidays.index');
			Route::GET('holidays/{emp_id}','Admin\holidays@create')->name('holidays.create');
			Route::POST('holidays/{emp_id}','Admin\holidays@store')->name('holidays.store');

            Route::GET('emps/holidays/show/{id}','Admin\holidays@show')->name('holidays.show');
			Route::GET('holidays/{id}/edit','Admin\holidays@edit')->name('holidays.edit');
			Route::PUT('holidays/{id}','Admin\holidays@update')->name('holidays.update');
			Route::DELETE('holidays/{id}','Admin\holidays@destroy')->name('holidays.destroy');
            Route::GET('holidays','Admin\holidays@allholidays')->name('holidays.all');


            Route::any('createholiday','Admin\holidays@createfromhome')->name('holidays.createfromhome');
            Route::GET('search/{employee}/{type}','Admin\holidays@search');
            Route::POST('holidaystore','Admin\holidays@storefromhome')->name('holidays.storefromhome');





            Route::post('holidays/multi_delete','Admin\holidays@multi_delete');


								//end of employee holidays//






								//employee pers//
								//Route::resource('pers','Admin\pers');


			Route::GET('pers/{emp_id}','Admin\pers@index')->name('pers.index');
			Route::GET('pers/{emp_id}','Admin\pers@create')->name('pers.create');
			Route::POST('pers/{emp_id}','Admin\pers@store')->name('pers.store');

			Route::GET('emps/pers/show/{id}','Admin\pers@show')->name('pers.show');
			Route::GET('pers/{id}/edit','Admin\pers@edit')->name('pers.edit');
			Route::PUT('pers/{id}','Admin\pers@update')->name('pers.update');
			Route::DELETE('pers/{id}','Admin\pers@destroy')->name('pers.destroy');
            Route::GET('pers','Admin\pers@allpers')->name('pers.all');


            Route::any('createper','Admin\pers@createfromhome')->name('pers.createfromhome');
            Route::GET('search/{employee}','Admin\pers@search');
            Route::POST('perstore','Admin\pers@storefromhome')->name('pers.storefromhome');




            Route::post('pers/multi_delete','Admin\pers@multi_delete');


								//end of employee pers//






				//Route::resource('users','Admin\users');
//Route::post('users/multi_delete','Admin\users@multi_delete');




            Route::GET('users','Admin\users@index')->name('users.index');
            Route::GET('users/{emp_id}','Admin\users@create')->name('users.create');
            Route::POST('users/{emp_id}','Admin\users@store')->name('users.store');
            Route::GET('users/show/{id}','Admin\users@show')->name('users.show');
            Route::GET('users/{id}/edit','Admin\users@edit')->name('users.edit');
            Route::PUT('users/{id}','Admin\users@update')->name('users.update');
            Route::DELETE('users/{id}','Admin\users@destroy')->name('users.destroy');
           Route::GET('users','Admin\users@allusers')->name('users.allusers');
            Route::GET('users/all/create','Admin\users@createfromuser')->name('users.createfromuser');
            Route::POST('users/all/store','Admin\users@storefromuser')->name('users.storefromuser');

            Route::post('users/multi_delete','Admin\users@multi_delete');





            Route::resource('tests','Admin\tests');
Route::post('tests/multi_delete','Admin\tests@multi_delete');

					//Route::resource('attendances', 'Admin\attendances');


					Route::GET('attendances/{emp_id}','Admin\attendances@index')->name('attendances.index');
					Route::GET('attendances/{emp_id}','Admin\attendances@create')->name('attendances.create');
					Route::POST('attendances/{emp_id}','Admin\attendances@store')->name('attendances.store');
					Route::GET('emps/attendances/show/{id}','Admin\attendances@show')->name('attendances.show');
					Route::GET('attendances/{id}/edit','Admin\attendances@edit')->name('attendances.edit');
					Route::PUT('attendances/{id}','Admin\attendances@update')->name('attendances.update');
					Route::DELETE('attendances/{id}','Admin\attendances@destroy')->name('attendances.destroy');
					Route::GET('attendances','Admin\attendances@allattendances')->name('attendances.all');


            Route::any('createattendance','Admin\attendances@createfromhome')->name('attendances.createfromhome');
            Route::GET('search/{employee}','Admin\attendances@search');
            Route::POST('attendancestore','Admin\attendances@storefromhome')->name('attendances.storefromhome');




					Route::post('attendances/multi_delete','Admin\attendances@multi_delete');

				Route::resource('officialholidays','Admin\officialHolidays');
Route::post('officialholidays/multi_delete','Admin\officialHolidays@multi_delete');


				Route::resource('holidaytypes','Admin\holidaytypes');
Route::post('holidaytypes/multi_delete','Admin\holidaytypes@multi_delete');







					Route::resource('ratings','Admin\ratings');


	Route::GET('ratings/{task_id}','Admin\ratings@index')->name('ratings.index');
	Route::GET('emps/ratings/{task_id}','Admin\ratings@create')->name('ratings.create');
	Route::POST('ratings/{task_id}','Admin\ratings@store')->name('ratings.store');
	Route::GET('ratings/show/{id}','Admin\ratings@show')->name('ratings.show');
	Route::GET('ratings/{id}/edit','Admin\ratings@edit')->name('ratings.edit');
	Route::PUT('ratings/{id}','Admin\ratings@update')->name('ratings.update');
	Route::DELETE('ratings/{id}','Admin\ratings@destroy')->name('ratings.destroy');

	Route::post('ratings/multi_delete','Admin\ratings@multi_delete');

				Route::resource('imgs','Admin\imgs');
Route::post('imgs/multi_delete','Admin\imgs@multi_delete');




                            //Route::resource('holidaypalances','Admin\holidayPalances');


            Route::GET('holidaypalances','Admin\holidaypalances@index')->name('holidaypalances.index');
            Route::GET('holidaypalances/{emp_id}','Admin\holidaypalances@create')->name('holidaypalances.create');
            Route::POST('holidaypalances/{emp_id}','Admin\holidaypalances@store')->name('holidaypalances.store');
            Route::GET('emps/holidaypalances/show/{id}','Admin\holidaypalances@show')->name('holidaypalances.show');
            Route::GET('holidaypalances/{id}/edit','Admin\holidaypalances@edit')->name('holidaypalances.edit');
            Route::PUT('holidaypalances/{id}','Admin\holidaypalances@update')->name('holidaypalances.update');
            Route::DELETE('holidaypalances/{id}','Admin\holidaypalances@destroy')->name('holidaypalances.destroy');

            Route::post('holidaypalances/multi_delete','Admin\holidayPalances@multi_delete');




				Route::resource('publicadmins','Admin\publicAdmins');
Route::post('publicadmins/multi_delete','Admin\publicAdmins@multi_delete');

				Route::resource('sectors','Admin\sectors');
Route::post('sectors/multi_delete','Admin\sectors@multi_delete');

				Route::resource('closedyears','Admin\closedyears');
Route::post('closedyears/multi_delete','Admin\closedyears@multi_delete');

				//Route::resource('trainings','Admin\trainings');
            Route::GET('trainings','Admin\trainings@index')->name('trainings.index');
            Route::GET('trainings/{emp_id}','Admin\trainings@create')->name('trainings.create');
            Route::POST('trainings/{emp_id}','Admin\trainings@store')->name('trainings.store');
            Route::GET('emps/trainings/show/{id}','Admin\trainings@show')->name('trainings.show');
            Route::GET('trainings/{id}/edit','Admin\trainings@edit')->name('trainings.edit');
            Route::PUT('trainings/{id}','Admin\trainings@update')->name('trainings.update');
            Route::DELETE('trainings/{id}','Admin\trainings@destroy')->name('trainings.destroy');

            Route::post('trainings/multi_delete','Admin\trainings@multi_delete');




           // Route::resource('behaviors','Admin\behaviors');
            Route::GET('behaviors','Admin\behaviors@index')->name('behaviors.index');
            Route::GET('behaviors/{emp_id}','Admin\behaviors@create')->name('behaviors.create');
            Route::POST('behaviors/{emp_id}','Admin\behaviors@store')->name('behaviors.store');
            Route::GET('emps/behaviors/show/{id}','Admin\behaviors@show')->name('behaviors.show');
            Route::GET('behaviors/{id}/edit','Admin\behaviors@edit')->name('behaviors.edit');
            Route::PUT('behaviors/{id}','Admin\behaviors@update')->name('behaviors.update');
            Route::DELETE('behaviors/{id}','Admin\behaviors@destroy')->name('behaviors.destroy');

            Route::post('behaviors/multi_delete','Admin\behaviors@multi_delete');



				Route::resource('coursenums','Admin\coursenums');
Route::post('coursenums/multi_delete','Admin\coursenums@multi_delete');
				//////// Admin Routes /* End */ //////////////
			});
    Route::get('/pers/pdf/{id}','Admin\pers@createPDF')->name('pers.pdf');
    Route::get('audits','Admin\emps@audits')->name('emps.audits');
    Route::GET('audits/show/{id}','Admin\users@showaudits')->name('audits.show');

    Route::get('printperformance','Admin\emps@printperformance')->name('emps.printperformance');
    Route::any('printshow/{id}','Admin\emps@printshow')->name('emps.printshow');

    Route::any('reports','Admin\reports@index')->name('reports.index');
    Route::any('reports/employee','Admin\reports@emp')->name('reports.emp');
    Route::any('reports/department','Admin\reports@dep')->name('reports.dep');
    Route::any('reports/adminstration','Admin\reports@admin')->name('reports.admin');
    Route::any('reports/public','Admin\reports@public')->name('reports.public');
    Route::any('reports/sector','Admin\reports@sector')->name('reports.sector');
    Route::any('reports/user','Admin\reports@user')->name('reports.user');




    Route::resource('administrations','Admin\administrations');
    Route::post('administrations/multi_delete','Admin\administrations@multi_delete');


    Route::GET('administrations','Admin\administrations@alladministrations')->name('administrations.all');
   Route::GET('departments','Admin\departments@alldepartments')->name('departments.all');


    Route::any('createbehavior','Admin\behaviors@createfromhome')->name('behaviors.createfromhome');
    Route::GET('search/{employee}','Admin\behaviors@search');
    Route::POST('behaviorstore','Admin\behaviors@storefromhome')->name('behaviors.storefromhome');



    Route::any('createtraining','Admin\trainings@createfromhome')->name('trainings.createfromhome');
    Route::GET('search/{employee}','Admin\trainings@search');
    Route::POST('trainingstore','Admin\trainings@storefromhome')->name('trainings.storefromhome');



    Route::resource('roles','Admin\roles');
    Route::post('roles/multi_delete','Admin\roles@multi_delete');





});
