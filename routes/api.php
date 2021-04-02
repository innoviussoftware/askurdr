<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('forgot/password', 'Auth\ForgotPasswordController')->name('forgot.password');
Route::post('forgot/password', 'API\AuthController@forgotpassword')->name('forgot.password');
Route::post('get/sinch_ticket', 'API\AuthController@getsinchticket')->name('get.sinch_ticket');
Route::get('get/user/emr/{phone}','API\UserController@getUserEmr');
Route::get('get/user/calltype/{from}/{to}','API\UserController@getUserCalltyp');
Route::get('get/user/calllog/{from}/{to}/{duration}/{type}','API\UserController@getUserCalllog');

Route::get('get/user/doctorstatus/{user_id}','API\UserController@changedoctorStatus');
Route::get('terms_condition','API\AuthController@getTermsConditionPdf');


Route::namespace('API')->group(function () {

    Route::post('paytab', 'AuthController@addpaymentPaytab');
    Route::post('login', 'AuthController@Login');
    Route::post('logout', 'AuthController@logout');
    Route::post('register', 'AuthController@Register');
    Route::post('sendotp','AuthController@SendOtp');
    Route::get('adminsetting', 'AuthController@adminsetting');
    Route::get('terms_condition', 'AuthController@getTermsConditionPdf');
    Route::post('otp','AuthController@generate_otp'); 
    Route::get('insurancecompany','DoctorController@insurancecompanylist');
    Route::get('user/getspecialitylist', 'AuthController@specialityList');
    Route::post('user/specialitywisedrlist', 'AuthController@specialitydoctoreList');
    Route::post('user/specialitywisedrlistwithfilter', 'AuthController@specialitydoctorelistwithfilter');
});

Route::middleware('auth:api')->prefix('user')->namespace('API')->group(function () {
    Route::get('me', 'AuthController@me');
    // Route::post('doctordetail', 'AuthController@specialitydoctoreList');
    Route::get('pastpatientbookinglist', 'DoctorController@getpastpatientappointment');

    Route::post('patientdetail', 'AuthController@patientdetail');
    Route::post('editprofile', 'AuthController@editprofile');
    Route::post('changepassword', 'AuthController@changepassword');
    Route::get('cliniclist', 'AuthController@clinicList');
	Route::get('documenttypelist', 'AuthController@documentTypeList');
    Route::get('specialitylist', 'AuthController@specialityList');
    Route::post('clinicwisedoctor', 'DoctorController@clinicwisedoctor');
    Route::post('specialitywisedoctor', 'DoctorController@specialitywisedoctor');
    Route::post('doctordetail', 'DoctorController@doctordetail');
    Route::post('doctorbooking', 'DoctorController@doctorbooking');
    Route::post('doctorbookingform', 'DoctorController@bookingform');
    Route::get('bookinglist', 'DoctorController@getappointment');
    Route::get('patientbookinglist', 'DoctorController@getpatientappointment');

    Route::post('sendcallrequest', 'DoctorController@sendcallrequest');
    Route::post('sendcallrequesttopatient', 'DoctorController@sendcallrequesttopatient');
    Route::get('getnotification', 'DoctorController@getnotification');
    Route::post('deletenotification', 'DoctorController@deletenotification');
    Route::get('physican/{text}', 'AuthController@getPhysicanDiagnosis');
    
    Route::get('medicines', 'AuthController@medicinesList');
    Route::get('investigationlist', 'AuthController@InvestigationList');
    Route::post('previsit', 'DoctorController@previsitBookingForm');

    Route::post('addEmr', 'DoctorController@addEmrDetails');
    Route::post('sendemail', 'DoctorController@sendEmail');
    Route::post('sendmessage', 'DoctorController@sendTextMessageNorification');

    Route::post('patientlist', 'DoctorController@patientList');
    Route::get('prescriptionlist', 'DoctorController@prescriptionList');
    Route::post('emrdetails', 'DoctorController@getemr_details');
    Route::get('getwaitinglist/{doctor_id}', 'DoctorController@waitingList');
    Route::post('checktimeslot', 'DoctorController@checktimeSlot');
    Route::post('emrupdate', 'DoctorController@editemrDetails');
    Route::post('deletetype', 'DoctorController@deleteEmrDetails');

    Route::post('getlabreport','DoctorController@getLabReport');
    Route::post('updatelabreport','DoctorController@uploadlabResults');
    Route::post('prescriptionlistbyid','DoctorController@prescriptionListById');
    Route::post('pdfinvestigation','DoctorController@pdfInvestigation');

    Route::post('getlabreportbyid','DoctorController@gelabreportByid');
    Route::post('getpatientreferral','DoctorController@getPatientWiseRefereal');
    Route::post('getallcount','DoctorController@getAllCount');

    Route::post('getlastvisit','DoctorController@getLastVisitOfPatient');  
    Route::post('changestatus','DoctorController@changedoctorStatus');   
    Route::post('getAvailStatus','DoctorController@getdoctoravailabilitystatus');

    Route::post('getnotificationcount','AuthController@getNotificationCount'); 

    Route::get('package','AuthController@getpackage');

    Route::post('addpayment','AuthController@payment_plan');

    Route::get('chat/{username}','AuthController@chatmessages');

    Route::post('checknode', 'AuthController@createChat');

    Route::post('quickid', 'AuthController@storeQuickBloxId');


    Route::post('addcall', 'AuthController@addcallhistorylist');
    Route::post('getcall', 'AuthController@getcallhistorylist');
    Route::post('addchatmsg', 'AuthController@addchatlastmsg');
    Route::post('getchatmsg', 'AuthController@getchatlastmsg');


//
    Route::post('notificationsend', 'DoctorController@pushtesting');
    Route::post('paymenthistory', 'AuthController@paymenyhistory');
    Route::post('changeddoctorstatus', 'DoctorController@changeddoctorstatus');

    Route::post('getpaymenthistory', 'AuthController@getpaymenthostory');
    Route::post('checkbalancestatus', 'AuthController@checkbalancestatus');
    //


    Route::post('getcallmedical', 'AuthController@getcallhistorymediacallist');
    Route::post('sendcallnotificationrequest', 'DoctorController@sendcallnotificationrequest');
    Route::post('uploaddocumentvideocall', 'DoctorController@uploaddocumentvideocall');
    Route::post('getdocumentvideocall', 'DoctorController@getdocumentvideocall');


    Route::post('create_pdf_bill', 'DoctorController@create_pdf_bill'); 
    Route::post('paymentcut', 'DoctorController@addpayment'); 

    Route::post('specialitywisedrlistwithfilter', 'AuthController@specialitydoctorelistwithfilter');
    Route::post('specialitywisedrlist', 'AuthController@specialitydoctoreList');

    Route::post('addbalance', 'AuthController@addwalletMoney');
    Route::post('getbill', 'DoctorController@getBill');

    Route::post('getcalltype', 'AuthController@chatType');






});

