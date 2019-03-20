<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
return view('auth.login');
});
//Auth::routes();
Auth::routes(['verify' => true]);




Route::post('setCookiesTheme', 'NomiddlewareController@setCookiesTheme')->name('setCookiesTheme');
Route::group(['middleware' => 'prevent-back-history'],function(){
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('logout', 'HomeController@logout')->name('applogout');
    Route::get('screenlock/{currtime}/{id}/{randnum}', 'HomeController@screenlock')->name('screenlock');
Route::get('edit-profile', 'HomeController@editprofile')->name('edit-profile');
Route::post('profileupdate','HomeController@profileupdate')->name('profileupdate');
Route::resource('permissions','PermissionController');
Route::get('permission-delete/{id}','PermissionController@permissionDelete')->name('permission-delete');
Route::resource('roles','RoleController');
Route::get('role-delete/{id}','RoleController@roleDelete')->name('role-delete');


///////Website Setting
Route::get('websitesetting', 'WebsiteController@websitesetting')->name('websitesetting');
Route::post('websitesettingupdate', 'WebsiteController@websitesettingupdate')->name('websitesettingupdate');
// Ticket section
Route::get('ticket-generated', 'TicketController@ticketGenerate')->name('ticket-generated');
Route::get('ticket-generated/create', 'TicketController@ticketCreate')->name('ticket-generated-create');
Route::post('ticket-generated/store', 'TicketController@ticketStore')->name('ticket-generated-store');
Route::post('ticket-generated2/store', 'TicketController@ticketStore2')->name('ticket-generated-store2');
Route::post('ticket-generated/close', 'TicketController@ticketclose')->name('ticket-generated-close');

Route::get('ticket-processing', 'TicketController@ticketProcessinglist')->name('ticket-processing');
Route::get('ticket-processing/edit/{id}', 'TicketController@ticketProcessingEdit')->name('ticket-processing-edit');
Route::get('ticket-processing/delete/{id}', 'TicketController@ticketProcessingDelete')->name('ticket-processing-delete');
Route::get('ticket-generated/edit/{id}', 'TicketController@ticketProcessingedits')->name('ticket-generated-edit');
Route::get('ticket-processing/view/{id}', 'TicketController@ticketProcessingView')->name('ticket-updates-view');
Route::get('ticket-processing/view', 'TicketController@ticketProcessingViewRadio')->name('ticket-updates-Radio');
Route::get('ticket-processing/editrequestaccess/{id}', 'TicketController@requestaccessediting')->name('ticket-processing-SiteAccessEdit');
Route::post('ticket-processing/view', 'TicketController@ticketPostReply')->name('ticket-post-reply');
Route::post('getmodeldata','TicketController@getmodeldata')->name('getmodeldata');
//for editing the access time data
 Route::post('getsecurityescortmodeldata','TicketController@getsecurityescortmodeldata')->name('getsecurityescortmodeldata');
 Route::post('savesecurityescortmodeldata','TicketController@savesecurityescortmodeldata')->name('savesecurityescortmodeldata');
Route::post('ticket-processing/accessrequestediting','TicketController@editaccesstime')->name('editingaccesstime');
Route::post('ticket-processing/close','TicketController@closetheticket')->name('closetheticket');

Route::get('ticket-list/closed', 'TicketController@ticketListClosed')->name('ticket-list-closed');
Route::get('ticket-list/closedEdit/{id}', 'TicketController@ticketListClosedEdit')->name('ticketListClosedEdit');
Route::post('ticket-list/closedStore', 'TicketController@ticketListClosedStore')->name('ticketListClosedEditStored');

Route::get('ticket-list/Pending', 'TicketController@ticketListPending')->name('ticket-list-Pending');
Route::get('ticket-list/pendingEdit/{id}', 'TicketController@ticketListPendingEdit')->name('ticketListPendingEdit');
Route::post('ticket-list/pendingStore', 'TicketController@ticketListPendingStore')->name('ticketListPendingEditStored');


Route::get('ticket-list/Cancelled', 'TicketController@ticketListCancelled')->name('ticket-list-Cancelled');
Route::get('ticket-list/cancelledEdit/{id}', 'TicketController@ticketListCancelledEdit')->name('ticketListCancelledEdit');
Route::post('ticket-list/cancelledStore', 'TicketController@ticketListCancelledStore')->name('ticketListCancelledEditStored');
Route::get('ticket-list','TicketController@todolist')->name('to-do-list');
Route::get('ticket-list/create-todo','TicketController@todolist')->name('create-todo');
Route::get('ticket-list/save-todo-list','TicketController@savetodolist')->name('save-todo-list');
Route::get('ticket-list/edit-todo/{id}','TicketController@edittodo')->name('edit-todo');
Route::get('ticket-list/delete-todo/{id}','TicketController@deletetodo')->name('delete-todo');
Route::get('ticket-list/mark-as-complete/{id}','TicketController@markascomplete')->name('markascomplete');
Route::get('ticket-list/mark-as-pending/{id}','TicketController@markaspending')->name('markaspending');


//deleting the field engineer
Route::get('field_engg/delete/{id}','TicketController@deleteassigned_fe')->name('deleteassigned_fe');
Route::post('getaccessinsertmodaldata','TicketController@getaccessinsertmodaldata')->name('getaccessinsertmodaldata');
Route::post('savenewaccessrequest','TicketController@savenewaccessrequest')->name('savenewaccessrequest');

Route::post('getescortinsertmodaldata','TicketController@getescortinsertmodaldata')->name('getescortinsertmodaldata');
Route::post('savenewsecurityrequest','TicketController@savenewsecurityrequest')->name('savenewsecurityrequest');

Route::post('geteditfedata','TicketController@geteditfedata')->name('geteditfedata');
Route::post('updatefedata','TicketController@updatefedata')->name('updatefedata');
Route::get('delfedata/{id}','TicketController@delfedata')->name('delfedata');


/*  Ticketgenerated  section Add  */


/*Region list for edit update delete starts here*/
Route::get('region-list','RegionController@showregionlist')->name('region-list');
Route::get('region-create','RegionController@showregioncreate')->name('region-create');
Route::get('region-edit/{id}','RegionController@regionedit')->name('region-edit');
Route::post('region-update','RegionController@updateregion')->name('updateregion');
Route::post('newregioninsert','RegionController@insertnewregion')->name('newregioninsert');
Route::get('region-del/{id}','RegionController@deleteregion')->name('region-del');

/*Region list for edit update delete ends here*/

/*Get the infobip balance*/
Route::get('infobalance','BalanceController@getbalance')->name('infobalance');
/*Get the infobip balance*/


 	/*Ticket Report start*/
Route::get('ticket-report','TicketReportController@ticketReportList')->name('ticket-report-list');
Route::get('ticket-report/{ticket_id}','TicketReportController@ticketReportGenerated')->name('ticket-report-view');

Route::get('ticket-report-chart', 'TicketReportController@ticketReportFEchart')->name('ticket-report-FEchart');

/*Route::get('ticket-report-escort', 'TicketReportController@ticketReportEscort')->name('ticket-report-Escort');*/
Route::get('ticket-report-escort/view', 'TicketReportController@ticketReportEscortView')->name('ticket-report-EscortView');
Route::post('ticket-report-escort/Edit', 'TicketReportController@ticketReportEscortEdit')->name('ticket-report-EscortEdit');

/*Route::get('ticket-report-request-access', 'TicketReportController@ticketReportRequestAccess')->name('ticket-report-Request-Access');*/

Route::get('ticket-report-request-access/view', 'TicketReportController@ticketReportRequestAccessView')->name('ticket-report-Request-AccessView');
Route::post('ticket-report-request-access/Edit', 'TicketReportController@ticketReportRequestAccessEdit')->name('ticket-report-Request-AccessEdit');


Route::get('ticket-report-faultAnalysis','TicketReportController@ticketReportFaultAnalysis')->name('ticket-report-faultAnalysis');

Route::post('ticket-report-faultAnalysis','TicketReportController@ticketReportFaultAnalysisView')->name('ticket-report-faultAnalysisView');
 

Route::get('fault-report','TicketReportController@faultReportGenerated')->name('fault-report');
Route::get('fault_ticket_page/{id}','TicketReportController@fault_ticket_page')->name('fault_ticket_page');
Route::post('showfaultreportlist','TicketReportController@showfaultreportlist')->name('showfaultreportlist');
Route::post('fault-report','TicketReportController@getregiononchoice')->name('getregiononchoice');

	/*Ticket Report end*/

	/*KNOWLEDGE BASE section start here*/
	 Route::post('siteids','KnowledgeBaseController@uploadsiteids')->name('uploadsiteids');

	Route::get('knowledge-base-siteInfo','KnowledgeBaseController@siteInfo')->name('knowledge-base-siteInfo');
	Route::get('knowledge-base-siteInfo/create','KnowledgeBaseController@siteInfoAdd')->name('knowledge-base-create');
	Route::get('knowledge-base-siteInfo/edit/{id}','KnowledgeBaseController@siteInfoEdit')->name('knowledge-base-edit');
	Route::get('knowledge-base-siteInfo/delete/{id}','KnowledgeBaseController@siteInfoDelete')->name('knowledge-base-delete');

	Route::post('knowledge-base-siteInfo','KnowledgeBaseController@siteInfoStore')->name('knowledge-base-store');
	Route::get('knowledge-base-contactlist','KnowledgeBaseController@contactList')->name('knowledge-base-contactlist');
	Route::get('knowledge-base-contactlist/create','KnowledgeBaseController@contactListAdd')->name('knowledge-base-contactcreate');
	Route::get('knowledge-base-contactlist/edit/{id}','KnowledgeBaseController@contactEdit')->name('knowledge-base-contactEdit');
	Route::get('knowledge-base-contactlist/delete/{id}','KnowledgeBaseController@contactDelete')->name('knowledge-base-contactDelete');
	Route::post('knowledge-base-contactlist','KnowledgeBaseController@contactListStore')->name('knowledge-base-contactStore');

	Route::get('knowledge-base-enggDriver','KnowledgeBaseController@enggDriver')->name('knowledge-base-enggDriver');
	Route::get('knowledge-base-enggDriver/create','KnowledgeBaseController@enggDriverAdd')->name('knowledge-base-enggDriverCreate');
	Route::get('knowledge-base-enggDriver/edit/{id}','KnowledgeBaseController@enggDriverEdit')->name('knowledge-base-enggDriverEdit');
	Route::get('knowledge-base-enggDriver/delete/{id}','KnowledgeBaseController@enggDriverDelete')->name('knowledge-base-enggDriverDelete');
	Route::post('knowledge-base-enggDriver','KnowledgeBaseController@enggDriverStore')->name('knowledge-base-enggDriverStore');

	Route::get('knowledge-base-nofbis','KnowledgeBaseController@nofbisList')->name('knowledge-base-nofbis');
	Route::get('knowledge-base-nofbis/create','KnowledgeBaseController@nofbisAdd')->name('knowledge-base-nofbisCreate');
	Route::get('knowledge-base-nofbis/edit/{id}','KnowledgeBaseController@nofbisEdit')->name('knowledge-base-nofbisEdit');
	Route::get('knowledge-base-nofbis/delete/{id}','KnowledgeBaseController@nofbisDelete')->name('knowledge-base-nofbisDelete');
	Route::post('knowledge-base-nofbis','KnowledgeBaseController@nofbisStore')->name('knowledge-base-nofbisStore');





	/*KNOWLEDGE BASE section end here*/
///////sms part start ///////////
Route::get('sms_setting','SmsController@smssettingpage')->name('sms_setting'); 
 
Route::post('modifysmssetting','SmsController@modifysmssetting')->name('modifysmssetting'); 

Route::get('smsperhour','SmsController@testingthesms')->name('smsperhour');

///////sms part end /////////////	


///////User Management
///////Department
Route::get('users/list', 'UserController@userslist')->name('users-list');
Route::get('users/create', 'UserController@userscreate')->name('users-create');
Route::get('users/edit/{id}', 'UserController@usersedit')->name('users-edit');
Route::post('users/store', 'UserController@usersstore')->name('users-store');
Route::get('users/delete/{id}', 'UserController@usersdelete')->name('users-delete');
Route::get('users/delete/{id}','UserController@deleteuserbyid')->name('users-del');

///////Nature Of Falut
Route::get('natureoffault/list', 'NatureOfFaultController@natureoffaultlist')->name('natureoffault-list');
Route::get('natureoffault/create', 'NatureOfFaultController@natureoffaultcreate')->name('natureoffault-create');
Route::get('natureoffault/edit/{id}', 'NatureOfFaultController@natureoffaultedit')->name('natureoffault-edit');
Route::post('natureoffault/store', 'NatureOfFaultController@natureoffaultstore')->name('natureoffault-store');
Route::get('natureoffault/delete/{id}', 'NatureOfFaultController@natureoffaultdelete')->name('natureoffault-delete');

///////Service
Route::get('service/list', 'ServiceController@servicelist')->name('service-list');
Route::get('service/create', 'ServiceController@servicecreate')->name('service-create');
Route::get('service/edit/{id}', 'ServiceController@serviceedit')->name('service-edit');
Route::post('service/store', 'ServiceController@servicestore')->name('service-store');
///////Ticket Status
Route::get('ticket-status/list', 'TicketstatusController@ticketstatuslist')->name('ticket-status-list');
Route::get('ticket-status/create', 'TicketstatusController@ticketstatuscreate')->name('ticket-status-create');
Route::get('ticket-status/edit/{id}', 'TicketstatusController@ticketstatusedit')->name('ticket-status-edit');
Route::post('ticket-status/store', 'TicketstatusController@ticketstatusstore')->name('ticket-status-store');
///////Client
Route::get('client/list', 'ClientController@clientlist')->name('client-list');
Route::get('client/create', 'ClientController@clientcreate')->name('client-create');
Route::get('client/edit/{id}', 'ClientController@clientedit')->name('client-edit');
Route::post('client/store', 'ClientController@clientstore')->name('client-store');
///////Department
Route::get('department/list', 'DepartmentController@departmentlist')->name('department-list');
Route::get('department/create', 'DepartmentController@departmentcreate')->name('department-create');
Route::get('department/edit/{id}', 'DepartmentController@departmentedit')->name('department-edit');
Route::post('department/store', 'DepartmentController@departmentstore')->name('department-store');

});
});