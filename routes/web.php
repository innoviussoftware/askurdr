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

Route::get('newfirebase','FirebaseController@index');

Route::get('/index', function () {
    return view('layouts.home');
})->name('arhtmlenglish');

Route::get('/arhtml', function () {
    return view('layouts.ar');
})->name('arhtmlarabic');


Route::get('/php_info', function () {
    return view('php_info');
});

Route::get('api_services', function () {
    return view('api_services');
});

Route::get('404', function () {
    return view('errors/404');
});
Route::get('activate/{token}', 'ActivateController@activate')->name('activate');
Route::get('activate-success', function () {
    return view('welcome');
})->name('activate_success');

Route::get('trancate_data', 'Auth\AppearanceController@trancate_data')->name('trancate_data');

Auth::routes();

Route::post('passwords', 'Auth\ForgotPasswordController@sendemail')->name('change.pwd');

Route::post('password-reset', 'Auth\PasswordController@sendPasswordResetToken')->name('password.email');
Route::get('password/reset/{token}', 'Auth\PasswordController@showPasswordResetForm');
Route::post('reset-password', 'Auth\PasswordController@resetPassword')->name('password.update');

Route::get('home', function () {
    //return redirect('admin/home');
    if (Auth::check()){
    if (Auth::user()->hasRole('admin')) // use Auth::check instead of Auth::user
        {
            return redirect('admin/home');
        }else{
            return redirect('front/index');
        }
    }else{
        return redirect('front/index');
    }
})->name('home');

Route::get('admin', function () {
    if (Auth::user()) // use Auth::check instead of Auth::user
    {
        return redirect('admin/home');
    }else{
        return redirect('front/index');
    }
});

Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('coming-soon', function () {
        return view('admin.comingsoon');
    })->name('coming_soon');

    // Roles Permission Management
    Route::get('role-permission', 'Admin\RolesPermissionController@index')->name('roles_permission.index');
    Route::get('role-permission/array', 'Admin\RolesPermissionController@rolearray')->name('roles_permission.rolearray');
    Route::get('role-permission/create', 'Admin\RolesPermissionController@create')->name('roles_permission.create');
    Route::post('role-permission/store', 'Admin\RolesPermissionController@store')->name('roles_permission.store');
    Route::get('role-permission/change/status/{id}/{status}', 'Admin\RolesPermissionController@changestatus')->name('roles_permission.changestatus');
    Route::get('role-permission/delete/{id}', 'Admin\RolesPermissionController@delete')->name('roles_permission.delete');
    Route::get('role-permission/edit/{id}', 'Admin\RolesPermissionController@edit')->name('roles_permission.edit');
    Route::patch('role-permission/update', 'Admin\RolesPermissionController@update')->name('roles_permission.update');
    Route::post('role-permission/bulk/action', 'Admin\RolesPermissionController@bulkaction')->name('roles_permission.bulkaction');

    // Speciality Manage
    Route::get('speciality', 'Admin\SpecialityController@index')->name('speciality.index');
    Route::get('speciality/array', 'Admin\SpecialityController@specialityarray')->name('speciality.specialityarray');
    Route::get('speciality/create', 'Admin\SpecialityController@create')->name('speciality.create');
    Route::post('speciality/store', 'Admin\SpecialityController@store')->name('speciality.store');
    Route::get('speciality/change/status/{id}/{status}', 'Admin\SpecialityController@changestatus')->name('speciality.changestatus');
    Route::get('speciality/delete/{id}', 'Admin\SpecialityController@delete')->name('speciality.delete');
    Route::get('speciality/edit/{id}', 'Admin\SpecialityController@edit')->name('speciality.edit');
    Route::patch('speciality/update', 'Admin\SpecialityController@update')->name('speciality.update');

    // Doctor Manage
    Route::get('doctor', 'Admin\DoctorController@index')->name('doctor.index');
    Route::get('doctor/array', 'Admin\DoctorController@doctorarray')->name('doctor.doctorarray');
    Route::get('doctor/create', 'Admin\DoctorController@create')->name('doctor.create');
    Route::post('doctor/store', 'Admin\DoctorController@store')->name('doctor.store');
    Route::get('doctor/change/status/{id}/{status}', 'Admin\DoctorController@changestatus')->name('doctor.changestatus');
    Route::get('doctor/delete/{id}', 'Admin\DoctorController@delete')->name('doctor.delete');
    Route::get('doctor/edit/{id}', 'Admin\DoctorController@edit')->name('doctor.edit');
    Route::patch('doctor/update', 'Admin\DoctorController@update')->name('doctor.update');
    Route::get('getdataeducation', 'Admin\DoctorController@doctoreducation');
    Route::get('getdataexpen', 'Admin\DoctorController@doctorexperience');
    Route::get('removeeducation', 'Admin\DoctorController@remove_education');
    Route::get('removeexp', 'Admin\DoctorController@remove_experience');

    Route::get('getclinicdoctor', 'Admin\DoctorController@getdoctorclinic');


    // Patient Manage
    Route::get('patient', 'Admin\PatientController@index')->name('patient.index');
    Route::get('patient/array', 'Admin\PatientController@patientarray')->name('patient.patientarray');
    Route::get('patient/change/status/{id}/{status}', 'Admin\PatientController@changestatus')->name('patient.changestatus');
    Route::get('patient/create/{id}', 'Admin\PatientController@create')->name('patient.create');
    Route::post('patient/store', 'Admin\PatientController@store')->name('patient.store');
    Route::get('patient/edit/{id}', 'Admin\PatientController@edit')->name('patient.edit');
    Route::patch('patient/update', 'Admin\PatientController@update')->name('patient.update');
    Route::get('patient/delete/{id}', 'Admin\PatientController@delete')->name('patient.delete');

     Route::get('getprescriptions', 'Admin\PatientController@getprescriptions');
     Route::get('removeprescriptions', 'Admin\PatientController@remove_prescriptions');
     Route::get('getprescriptionsmedicines', 'Admin\PatientController@getprescriptions_medcines');
    // Document Type Manage
    Route::get('document-type', 'Admin\DocumentTypeController@index')->name('document_type.index');
    Route::get('document-type/array', 'Admin\DocumentTypeController@documenttypearray')->name('document_type.documenttypearray');
    Route::get('document-type/create', 'Admin\DocumentTypeController@create')->name('document_type.create');
    Route::post('document-type/store', 'Admin\DocumentTypeController@store')->name('document_type.store');
    Route::get('document-type/change/status/{id}/{status}', 'Admin\DocumentTypeController@changestatus')->name('document_type.changestatus');
    Route::get('document-type/delete/{id}', 'Admin\DocumentTypeController@delete')->name('document_type.delete');
    Route::get('document-type/edit/{id}', 'Admin\DocumentTypeController@edit')->name('document_type.edit');
    Route::patch('document-type/update', 'Admin\DocumentTypeController@update')->name('document_type.update');

    // Clini Management
    Route::get('hospital', 'Admin\HospitalController@index')->name('hospital.index');
    Route::get('hospital/array', 'Admin\HospitalController@clinicarray')->name('hospital.hospitalarray');
    Route::get('hospital/create', 'Admin\HospitalController@create')->name('hospital.create');
    Route::post('hospital/store', 'Admin\HospitalController@store')->name('hospital.store');
    Route::get('hospital/change/status/{id}/{status}', 'Admin\HospitalController@changestatus')->name('hospital.changestatus');
    Route::get('hospital/delete/{id}', 'Admin\HospitalController@delete')->name('hospital.delete');
    Route::get('hospital/edit/{id}', 'Admin\HospitalController@edit')->name('hospital.edit');
    Route::patch('hospital/update', 'Admin\HospitalController@update')->name('hospital.update');

    //Insurance Company Managment
    Route::get('insurance', 'Admin\InsuranceCompanyController@index')->name('insurance.index');
    Route::get('insurance/array', 'Admin\InsuranceCompanyController@insurancearray')->name('insurance.insurancearray');
    Route::get('insurance/create', 'Admin\InsuranceCompanyController@create')->name('insurance.create');
    Route::post('insurance/store', 'Admin\InsuranceCompanyController@store')->name('insurance.store');
    Route::get('insurance/change/status/{id}/{status}', 'Admin\InsuranceCompanyController@changestatus')->name('insurance.changestatus');
    Route::get('insurance/delete/{id}', 'Admin\InsuranceCompanyController@delete')->name('insurance.delete');
    Route::get('insurance/edit/{id}', 'Admin\InsuranceCompanyController@edit')->name('insurance.edit');
    Route::patch('insurance/update', 'Admin\InsuranceCompanyController@update')->name('insurance.update');
    // Medicines Manage

    Route::get('medicines', 'Admin\MedicinesController@index')->name('medicines.index');
    Route::get('medicines/array', 'Admin\MedicinesController@specialityarray')->name('medicines.medicinesarray');
    Route::get('medicines/create', 'Admin\MedicinesController@create')->name('medicines.create');
    Route::post('medicines/store', 'Admin\MedicinesController@store')->name('medicines.store');
    Route::get('medicines/change/status/{id}/{status}', 'Admin\MedicinesController@changestatus')->name('medicines.changestatus');
    Route::get('medicines/delete/{id}', 'Admin\MedicinesController@delete')->name('medicines.delete');
    Route::get('medicines/edit/{id}', 'Admin\MedicinesController@edit')->name('medicines.edit');
    Route::patch('medicines/update', 'Admin\MedicinesController@update')->name('medicines.update');




     // Physican Diagonis Manage
    Route::get('medicines', 'Admin\MedicinesController@index')->name('medicines.index');
    Route::get('medicines/array', 'Admin\MedicinesController@specialityarray')->name('medicines.medicinesarray');
    Route::get('medicines/create', 'Admin\MedicinesController@create')->name('medicines.create');
    Route::post('medicines/store', 'Admin\MedicinesController@store')->name('medicines.store');
    Route::get('medicines/change/status/{id}/{status}', 'Admin\MedicinesController@changestatus')->name('medicines.changestatus');
    Route::get('medicines/delete/{id}', 'Admin\MedicinesController@delete')->name('medicines.delete');
    Route::get('medicines/edit/{id}', 'Admin\MedicinesController@edit')->name('medicines.edit');
    Route::patch('medicines/update', 'Admin\MedicinesController@update')->name('medicines.update');

     // Prescription Manage
    Route::get('prescription', 'Admin\PrescriptionController@index')->name('prescriptionlistall.index');
    Route::get('prescription/array', 'Admin\PrescriptionController@prescription_array')->name('prescription.prescription_array');
    Route::get('prescription/create', 'Admin\PrescriptionController@create')->name('prescription.create');
    Route::post('prescription/store', 'Admin\PrescriptionController@store')->name('prescription.store');
    Route::get('prescription/change/status/{id}/{status}', 'Admin\PrescriptionController@changestatus')->name('prescription.changestatus');
    Route::get('prescription/delete/{id}', 'Admin\PrescriptionController@delete')->name('prescription.delete');
    Route::get('prescription/edit/{id}', 'Admin\PrescriptionController@edit')->name('prescription.edit');
    Route::patch('prescription/update', 'Admin\PrescriptionController@update')->name('prescription.update');
    Route::get('removeprescriptions', 'Admin\PatientController@remove_prescriptions');





    //Refreal Manage
    Route::get('refreal', 'Admin\ReferalController@index')->name('refreal.index');
    Route::get('refreal/create', 'Admin\ReferalController@create')->name('refreal.create');
    Route::post('refreal/store', 'Admin\ReferalController@store')->name('refreal.store');
    Route::get('refreal/array', 'Admin\ReferalController@referalarray')->name('refreal.referalarray');
    Route::get('refreal/delete/{id}', 'Admin\ReferalController@delete')->name('refreal.delete');
     Route::get('refreal/edit/{id}', 'Admin\ReferalController@edit')->name('refreal.edit');
    Route::patch('refreal/update', 'Admin\ReferalController@update')->name('refreal.update');
    Route::get('refreal/change/status/{id}/{status}', 'Admin\ReferalController@changestatus')->name('refreal.changestatus');

    // Investigon Manage
    Route::get('investigation', 'Admin\InvestigationController@index')->name('investigation.index');
    Route::get('investigation/array', 'Admin\InvestigationController@investigationarray')->name('investigation.investigationarray');
    Route::get('investigation/create', 'Admin\InvestigationController@create')->name('investigation.create');
    Route::post('investigation/store', 'Admin\InvestigationController@store')->name('investigation.store');
    Route::get('investigation/change/status/{id}/{status}', 'Admin\InvestigationController@changestatus')->name('investigation.changestatus');
    Route::get('investigation/delete/{id}', 'Admin\InvestigationController@delete')->name('investigation.delete');
    Route::get('investigation/edit/{id}', 'Admin\InvestigationController@edit')->name('investigation.edit');
    Route::patch('investigation/update', 'Admin\InvestigationController@update')->name('investigation.update');

    //patient list Manage
    Route::get('patientlist', 'Admin\PatientListController@index')->name('patientlist.index');
    Route::get('patientlist/array', 'Admin\PatientListController@patientlistarray')->name('patientlist.patientlistarray');
    Route::get('patientlist/create', 'Admin\PatientListController@create')->name('patientlist.create');
    Route::post('patientlist/store', 'Admin\PatientListController@store')->name('patientlist.store');
    Route::get('patientlist/edit/{id}', 'Admin\PatientListController@edit')->name('patientlist.edit');
    Route::patch('patientlist/update', 'Admin\PatientListController@update')->name('patientlist.update');
    Route::get('patientlist/delete/{id}', 'Admin\PatientListController@delete')->name('patientlist.delete');
    Route::get('patientlist/change/status/{id}/{status}', 'Admin\PatientListController@changestatus')->name('patientlist.changestatus');


    // Home
    Route::get('edit/profile','Admin\HomeController@editProfile')->name('edit.profile');
    Route::patch('update/profile', 'Admin\HomeController@updateProfile')->name('update.profile');
    Route::get('change_password','Admin\HomeController@changePassword')->name('change.password');
    Route::patch('update/password', 'Admin\HomeController@updateChangePassword')->name('update.password');
    Route::get('/downloadPDF/{id}','Admin\PatientController@downloadPDF')->name('prescription.pdf');

    //ICD API RECORD

    Route::get('icd_record', 'Admin\PatientController@getdiagonis')->name('prescription.index');

    Route::get('medicines_record', 'Admin\PatientController@getMedicines');

    //Investigation Report
    Route::get('investigationreport', 'Admin\LabReportController@index')->name('investigationreport.index');
    Route::get('investigationreport/array', 'Admin\LabReportController@investigationreportarray')->name('investigationreport.reportarray');
    Route::get('investigationreport/create', 'Admin\LabReportController@create')->name('investigationreport.create');
    Route::post('investigationreport/store', 'Admin\LabReportController@store')->name('investigationreport.store');
    Route::get('investigationreport/change/status/{id}/{status}', 'Admin\LabReportController@changestatus')->name('investigationreport.changestatus');
    Route::get('investigationreport/delete/{id}', 'Admin\LabReportController@delete')->name('investigationreport.delete');
    Route::get('investigationreport/edit/{id}', 'Admin\LabReportController@edit')->name('investigationreport.edit');
    Route::patch('investigationreport/update', 'Admin\LabReportController@update')->name('investigationreport.update');

    //

    Route::get('prescriptionreport', 'Admin\VisitPrescriptionController@index')->name('prescriptionreport.index');
     Route::get('prescriptionreport/array', 'Admin\VisitPrescriptionController@prescriptionarray')->name('prescriptionreport.prescriptionarray');
    Route::get('prescriptionreport/create', 'Admin\VisitPrescriptionController@create')->name('prescriptionreport.create');
    Route::post('prescriptionreport/store', 'Admin\VisitPrescriptionController@store')->name('prescriptionreport.store');
    Route::get('prescriptionreport/edit/{id}', 'Admin\VisitPrescriptionController@edit')->name('prescriptionreport.edit');
    Route::patch('prescriptionreport/update', 'Admin\VisitPrescriptionController@update')->name('prescriptionreport.update');
    Route::get('prescriptionreport/delete/{id}', 'Admin\VisitPrescriptionController@delete')->name('prescriptionreport.delete');

    // Payment Plan

    Route::get('plan', 'Admin\PlanController@index')->name('plan.index');
    Route::get('plan/array', 'Admin\PlanController@packagearray')->name('plan.packagearray');
    Route::get('plan/create', 'Admin\PlanController@create')->name('plan.create');
    Route::post('plan/store', 'Admin\PlanController@store')->name('plan.store');
    Route::get('plan/change/status/{id}/{status}', 'Admin\PlanController@changestatus')->name('plan.changestatus');
    Route::get('plan/delete/{id}', 'Admin\PlanController@delete')->name('plan.delete');
    Route::get('plan/edit/{id}', 'Admin\PlanController@edit')->name('plan.edit');
    Route::patch('plan/update', 'Admin\PlanController@update')->name('plan.update');

    //Payment Details

    Route::get('paymentdetails', 'Admin\PaymentController@index')->name('paymentdetails.index');
    Route::get('paymentdetails/array', 'Admin\PaymentController@payementdetailsarray')->name('paymentdetails.paymentdetailsarray');

    //Insurance Details

    Route::get('insurancedetails', 'Admin\InsuranceController@index')->name('insurancedetails.index');
    Route::get('insurancedetails/array', 'Admin\InsuranceController@insurancedetailsarray')->name('insurancedetails.insurancedetailsarray');
    
    Route::get('appointmentdetails', 'Admin\VisitPrescriptionController@appointment_index')->name('appointmentdetails.index');
    Route::get('appointmentdetails/array', 'Admin\VisitPrescriptionController@appointmentarray')->name('appointmentdetails.appointmentarray');

    //fees user
    Route::get('/masterfees','Admin\HomeController@masterpricesetting')->name('master.setting.fees');
    Route::patch('/masterstorefees','Admin\HomeController@masterpricesettingstore')->name('master.setting.fees.store');
    // Route::get('create_pdf_bill', 'Admin\DoctorController@create_pdf_bill')->name('home.create_pdf_bill'); 
    
    // Lang Management
    Route::get('lang', 'Admin\LanguageController@index')->name('lang.index');
    Route::get('lang/array', 'Admin\LanguageController@langarray')->name('lang.langarray');
    Route::get('lang/create', 'Admin\LanguageController@create')->name('lang.create');
    Route::post('lang/store', 'Admin\LanguageController@store')->name('lang.store');
    Route::get('lang/change/status/{id}/{status}', 'Admin\LanguageController@changestatus')->name('lang.changestatus');
    Route::get('lang/delete/{id}', 'Admin\LanguageController@delete')->name('lang.delete');
    Route::get('lang/edit/{id}', 'Admin\LanguageController@edit')->name('lang.edit');
    Route::patch('lang/update', 'Admin\LanguageController@update')->name('lang.update');
    
    // Wallet Management
    Route::get('wallet', 'Admin\LanguageController@walletindex')->name('wallet.index');
    Route::get('wallet/array', 'Admin\LanguageController@walltearray')->name('wallet.walltearray');

    //Clinic Wallet Management
    Route::get('clinicwallet', 'Admin\LanguageController@clinicwallethistory')->name('clinicwallet.index');
    Route::get('clinicwallet/array', 'Admin\LanguageController@clinicwalletearray')->name('clinicwallet.walltearray');

    //Ask Clinic Wallet Management
    Route::get('askclinicwallet', 'Admin\LanguageController@askclinicwallethistory')->name('askclinicwallet.index');
    Route::get('askclinicwallet/array', 'Admin\LanguageController@askclinicwalletearray')->name('askclinicwallet.walltearray');

    //Master Settings Controller
    Route::get('mastersettings', 'Admin\MasterController@index')->name('mastersettings.index');
    Route::get('mastersettings/create', 'Admin\MasterController@create')->name('mastersettings.create');
    Route::post('mastersettings/store', 'Admin\MasterController@storeMasterAdminSetting')->name('mastersettings.store');
    Route::get('mastersettings/edit/{id}', 'Admin\MasterController@edit')->name('mastersettings.edit');
    Route::patch('mastersettings/update', 'Admin\MasterController@updateMasterAdminSetting')->name('mastersettings.update');

    //Doctor Commission

    Route::get('docommssion', 'Admin\LanguageController@doctorcommsion')->name('doctorcommsion.index');
    Route::get('docommssi;on/array', 'Admin\LanguageController@doctorcommsionArray')->name('doctorcommsionArray.array');

    Route::get('vat', 'Admin\LanguageController@vat')->name('vat.index');
    //Route::get('lang/array', 'Admin\LanguageController@langarray')->name('lang.langarray');
    Route::get('vat/create', 'Admin\LanguageController@create')->name('vat.create');
    Route::post('vat/store', 'Admin\LanguageController@storevat')->name('vat.store');
   // Route::get('lang/change/status/{id}/{status}', 'Admin\LanguageController@changestatus')->name('lang.changestatus');
    //Route::get('lang/delete/{id}', 'Admin\LanguageController@delete')->name('lang.delete');
    Route::get('vat/edit/{id}', 'Admin\LanguageController@edit')->name('vat.edit');
    Route::patch('vat/update', 'Admin\LanguageController@updatevat')->name('vat.update');

    Route::get('status/array', 'Admin\HomeController@doctoravailableArray')->name('status.array');

    Route::get('bill', 'Admin\MasterController@bill')->name('bill.index');
    Route::get('bill/array', 'Admin\MasterController@billArray')->name('bill.array');

    Route::get('calllog', 'Admin\MasterController@callLog')->name('callLog.index');
    Route::get('calllog/array', 'Admin\MasterController@callLogArray')->name('callLog.array');

    Route::get('followup', 'Admin\MasterController@followup')->name('followup.index');
    Route::get('followup/array', 'Admin\MasterController@followupArray')->name('followup.array');

    Route::get('payment', 'Admin\MasterController@payment')->name('payment.index');
    Route::get('payment/array', 'Admin\MasterController@paymentArray')->name('payment.array');

    

});



Route::get('register_patient','Front\HomeController@register')->name('home.register_patient');

Route::get('refreshcaptcha', 'Front\HomeController@refreshCaptcha');

Route::post('submit','Front\HomeController@submitregister')->name('home.submit');

Route::get('paymentplan','Front\HomeController@paymentplan')->name('home.paymentplan');

Route::name('front.')->prefix('front')->middleware(['auth'])->group(function () {
    Route::get('/index', 'Front\HomeController@customIndex');

    Route::get('dashboard', 'Front\HomeController@index')->name('home.dashboard');

    Route::get('upcomingappointment', 'Front\HomeController@getappointment')->name('home.upcomingappointment');


    Route::get('patientappointment', 'Front\HomeController@doctor_getappointment')->name('home.getappointment');

    Route::get('todayappointment/array', 'Front\HomeController@todayappointmentlist')->name('todayappointment.array');

    Route::get('waitinglist/array', 'Front\HomeController@waitinglist')->name('waitinglist.array');

    Route::get('investigation', 'Front\HomeController@investigation')->name('home.investigation');

    Route::get('uploadcenter', 'Front\HomeController@uploadcenter')->name('home.uploadcenter');

    Route::get('doctorprofile', 'Front\HomeController@doctor_profile')->name('home.doctorprofile');

    Route::get('doctorprofile/array', 'Front\HomeController@doctorfilter_profile_array')->name('doctorprofile.array');

    Route::get('labresults', 'Front\HomeController@labresults')->name('home.labresults');

    Route::get('labresults/array', 'Front\HomeController@labresultsArray')->name('labresults.array');

    Route::get('prescription', 'Front\HomeController@prescription')->name('home.prescription');

    Route::get('prescription/array', 'Front\HomeController@prescriptionArray')->name('prescription.array');

    Route::get('refferal', 'Front\HomeController@refferal')->name('home.refferal');

    Route::get('refferal/array', 'Front\HomeController@refferalArray')->name('refferal.array');

    Route::get('documenttype', 'Front\HomeController@getrecordOfdocumentid')->name('documenttype');

    Route::post('documenttype/store', 'Front\HomeController@updatedocumentcenter')->name('documenttype.store');


    Route::get('profile', 'Front\HomeController@profile')->name('home.profile');
    Route::get('doctor_profile', 'Front\HomeController@profile_doctor')->name('home.doctor_profile');
    Route::post('profile/update', 'Front\HomeController@updateProfile')->name('home.updateprofile');

    Route::get('changepassword', 'Front\HomeController@changepassword')->name('home.changepassword');
    Route::post('changepassword/submit', 'Front\HomeController@passwordchange')->name('home.password');

    Route::get('notification', 'Front\HomeController@changepassword')->name('home.changepassword');

    Route::get('investigation', 'Front\HomeController@investigation')->name('home.investigation');

    Route::get('labreports/array', 'Front\HomeController@labreportstypearray')->name('labreports.array');
    Route::get('xrayreports/array', 'Front\HomeController@xrayreportsarray')->name('xrayreports.array');

    Route::get('bookappointment', 'Front\HomeController@bookAppointment')->name('home.bookappointment');
    Route::get('clinicwisedoctor', 'Front\HomeController@clinicwisedoctor')->name('home.clinicwisedoctor');
    Route::get('doctordetails', 'Front\HomeController@doctor_details')->name('home.doctordetails');

    Route::post('book','Front\HomeController@book_page')->name('home.bookpage');

    Route::post('bookAppointment','Front\HomeController@bookingAppointment')->name('home.bookingappointment');

    Route::post('waitingAppointment','Front\HomeController@waitingAppointment')->name('home.waitingappointment');

    Route::get('upcomingappointment/array', 'Front\HomeController@appointmentArray')->name('upcomingappointment.array');

    Route::get('emr', 'Front\HomeController@getemr')->name('home.emr');

    Route::get('emr/array', 'Front\HomeController@getpatientlistforemr')->name('emr.array');
    Route::get('addemr/save/{id}', 'Front\HomeController@emrAdd')->name('home.addemr');
    Route::post('emr/store', 'Front\HomeController@emrStore')->name('home.emrStore');
    Route::post('store/user/emr/','Front\HomeController@storeUserEmr')->name('home.emrUserStore');
    Route::post('store/user/chatemr/','Front\HomeController@storeChatUserEmr')->name('home.emrChatUserStore');
    Route::get('emr/edit/{id}', 'Front\HomeController@emrEdit')->name('home.emredit');
    Route::patch('emr/update', 'Front\HomeController@updateEmr')->name('home.emrupdate');
    Route::get('emr/delete/{id}', 'Front\HomeController@deleteEmr')->name('home.emrdelete');
    Route::get('emrdetails/save/{id}', 'Front\HomeController@getemrdetails')->name('home.emrdetails');
    Route::get('emrdetails/array/{id}', 'Front\HomeController@getemrdetailsarray')->name('emrdetails.array');

    //New Add Emr
    Route::get('addemr', 'Front\HomeController@newAddEmr')->name('home.newaddemr');
    Route::post('newemr/store', 'Front\HomeController@newemrStore')->name('home.newemrStore');


    Route::get('getprescription', 'Front\HomeController@getPrescription')->name('home.getprescription');
    Route::get('removeprescription', 'Front\HomeController@removeprescription');
    Route::get('getinvestigation', 'Front\HomeController@getinvestigation')->name('home.getinvestigation');
    Route::get('removeinvestigation', 'Front\HomeController@removeinvestigation');
    Route::get('getrefferal', 'Front\HomeController@getrefferal')->name('home.getrefferal');
    Route::get('removerefferal', 'Front\HomeController@removerefferal');

    Route::get('icd_record', 'Front\HomeController@getdiagonis')->name('home.icd_record');
    Route::get('specialitywisedoctor', 'Front\HomeController@getspecialitywiseDoctor')->name('home.specialitywisedoctor');
    Route::get('subinvestigation', 'Front\HomeController@getsubinvestigation')->name('home.getsubinvestigation');

    Route::get('reportsdetails', 'Front\HomeController@getreports');
	Route::get('getdataeducation', 'Front\HomeController@doctoreducation');
    Route::get('getdataexpen', 'Front\HomeController@doctorexperience');
    Route::get('chat/{username}','Front\HomeController@chatmessages')->name('home.chat');
    Route::get('video/{id}','Front\HomeController@videocall')->name('home.video');
    Route::get('video/call/{id}','Front\HomeController@send_request')->name('home.send_request');
    Route::get('send_video_push/{mobile}','Front\HomeController@send_video_push')->name('home.send_video_push');
    Route::get('send_video_pushrequest/{mobile}/{doctor}','Front\HomeController@send_video_push_request')->name('home.send_video_pushrequest');
    Route::get('endcall/{id}','Front\HomeController@endvideocall')->name('home.endcall');


    //avoilabble   web

    Route::get('checkavoilabelweb', 'Front\HomeController@checkavoilable')->name('doctor.avoilabble');
    Route::get('checknotavoilabelweb', 'Front\HomeController@notcheckavoilable')->name('doctor.notavoilabble');

    // call and chat web
    Route::get('callchathistory', 'Front\HomeController@callchathistory')->name('home.callchathistory');
    Route::get('callchathistory/getallcall', 'Front\HomeController@getcallhistory')->name('home.getcallhistory.array');
    Route::get('callchathistory/getallchat', 'Front\HomeController@getchathistory')->name('home.getchathistory.array');

    Route::get('medicalrecord', 'Front\HomeController@medicalrecord')->name('home.medicalrecord');

    Route::get('getnotificationcount', 'Front\HomeController@getnotification')->name('home.getnotification');

    Route::get('getdocumentcount', 'Front\HomeController@getdocument')->name('home.getdocument');
    Route::get('documentcount', 'Front\HomeController@getdocumentcount')->name('home.documentcount');

    Route::get('sendpushnotificationcount', 'Front\HomeController@sendpushnotification')->name('home.sendpushnotification'); 


    //Shared Document
     Route::get('documentvideocall', 'Front\HomeController@documentvideocall')->name('home.documentvideocall');
    Route::get('documentvideocall/array', 'Front\HomeController@videocallArray')->name('documentvideocall.array');

    Route::get('clearnotification','Front\HomeController@clearnotification')->name('home.clearnotification');





});

Route::get('logout', 'Auth\LoginController@logout');


// Twillio Video
