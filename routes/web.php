<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageUpload;
use App\Http\Controllers\SpecilizationController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\AgoraVideoController;

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

Route::get('/',function(){
	return redirect('login');
});
Route::get('socket-check',function(){
	return view('test-socket');
});
Route::get('login',[AuthController::class,'login']);
Route::get('forget_password',[AuthController::class,'forget_password']);
Route::get('change-password/{id}',[AuthController::class,'changePassword']);
Route::post('reset_password',[AuthController::class,'reset_password']);

Route::post('forget_password',[AuthController::class,'sendResetMail'])->name('forget.password');
Route::post('/authenticate', [AuthController::class,'authenticateData'])
	   ->name('authenticate');

Route::group(['middleware' => 'basicAuth'], function()
{   
	 Route::post('/fcm-token', [HomeController::class, 'updateToken'])->name('fcmToken');
	Route::get('/',[HomeController::class,'index']);
	Route::resource('specialization',SpecilizationController::class)->name('*','specialization');	
    Route::post('/inlinedelete',[AjaxController::class,'inlinedelete'])->name('inlinedelete');
	Route::get('logout',[HomeController::class,'logout'])->name('logout');
	Route::get('home',[HomeController::class,'index']);
	Route::resource('employee',EmployeeController::class)->name('*','employee');	
    Route::post('/changeEmpStatus',[EmployeeController::class,'changeEmpStatus'])->name('changeEmpStatus');
    Route::post('/changePassword',[EmployeeController::class,'changePassword'])->name('changePassword');
    Route::get('change_password',[EmployeeController::class,'change_password']);
    // Route::post('/changePassword',[EmployeeController::class,'changePassword'])->name('changePassword');

    Route::resource('hospital',HospitalController::class)->name('*','hospital');
     Route::post('/changeHospStatus',[HospitalController::class,'changeHospStatus'])->name('changeHospStatus')
     ;
	
	Route::resource('patient',PatientController::class)->name('*','patient');
	Route::get('/upload-patient',[PatientController::class,'getUploadFile'])->name('patient.upload');
	Route::post('upload-patient',[PatientController::class,'UploadFile'])->name('patient.uploadfile');
	Route::post('/changePatientStatus',[PatientController::class,'changePatientStatus']);

	Route::resource('employee',EmployeeController::class)->name('*','employee');
	Route::resource('profile',ProfileController::class)->name('*','profile');

	Route::get('pending-list',[EmployeeController::class , 'pendingList'])->name('employee.pending');
	Route::get('change-status/{id}/{status}',[EmployeeController::class , 'changeStatus'])->name('employee.changeStatus');
	// Route::get('profileUpdate/{id}',[EmployeeController::class,'profileUpdate']);
	
	
	Route::resource('blog',BlogController::class)->name('*','blog');
	Route::post('/changeBlogStatus',[BlogController::class,'changeBlogStatus'])->name('changeBlogStatus');
	
	Route::resource('policy',PolicyController::class)->name('*','policy');
	
	Route::get('notificationCount',[NotificationController::class , 'notificationCount']);

	Route::resource('faq',FaqController::class)->name('*','faq');
	Route::post('/changefaqStatus',[FaqController::class,'changefaqStatus'])->name('changefaqStatus');
	
	Route::resource('privacy',PrivacyController::class)->name('*','privacy');
	Route::post('/changepoliciesStatus',[PrivacyController::class,'changepolicyStatus'])->name('changepolicyStatus');

	Route::resource('category',CategoryController::class)->name('*','category');
	Route::resource('plan',PlanController::class)->name('*','plan');
	Route::post('/changePlanStatus',[PlanController::class,'changePlanStatus'])->name('changePlanStatus');

	Route::resource('promocode',PromoController::class)->name('*','promocode');
	Route::post('/changepromocodeStatus',[PromoController::class,'changepromocodesStatus'])->name('changepromocodeStatus');

	Route::resource('notifications',NotificationController::class)->name('*','notifications');

	Route::resource('roles',RoleController::class)->name('*','roles');

	Route::resource('schedule',ScheduleController::class)->name('*','schedule');
	Route::post('/doctorSchedule',[ScheduleController::class,'doctorSchedule'])->name('doctor.schedule');
	
	Route::post('/changescheduleStatus',[ScheduleController::class,'changescheduleStatus'])->name('changescheduleStatus');
	Route::get('/doctorsList',[ScheduleController::class,'doctorsList'])->name('schedule.doctorslist');

	Route::get('/patient-history/{id}',[PatientController::class,'patientHistory'])->name('patient.history');

	Route::get('/patient-list',[PatientController::class,'patientList'])->name('patient.list');

	Route::get('/optics-create/{id}',[AppointmentController::class,'opticsCreate'])->name('optics.create');

	Route::post('/optics-create',[AppointmentController::class,'opticsStore'])->name('optics.store');

	Route::get('appointment-upgrade/{id}',[AppointmentController::class,'upgradeAppointment'])->name('appointment.more');

	Route::get('appointment-details/{id}',[AppointmentController::class,'detailAppointment'])->name('appointment.details');
	
	Route::get('cancelled-appointment',[AppointmentController::class,'cancelledAppointment'])->name('appointment.cancelled');

	Route::get('appointment-history',[AppointmentController::class,'historyAppointment'])->name('appointment.history');

	Route::get('diagnosis-create/{id}',[AppointmentController::class,'createDiagnosis'])->name('diagnosis.create');
	Route::post('diagnosis-add',[AppointmentController::class,'storeDiagnosis'])->name('diagnosis.store');

	Route::get('diagnosis-edit/{id}',[AppointmentController::class,'editDiagnosis'])->name('diagnosis.edit');
	Route::put('diagnosis-update/{id}',[AppointmentController::class,'updateDiagnosis'])->name('diagnosis.update');

	Route::get('prescription-create/{id}',[AppointmentController::class,'createPrescription'])->name('prescription.create');
	Route::post('prescription-add',[AppointmentController::class,'storePrescription'])->name('prescription.store');

	Route::get('prescription-edit/{id}',[AppointmentController::class,'editPrescription'])->name('prescription.edit');
	Route::put('prescription-update/{id}',[AppointmentController::class,'updatePrescription'])->name('prescription.update');

	Route::post("add-casestudy",[AppointmentController::class,'addCaseStudy'])->name('casestudy.add');

	Route::resource('appointment',AppointmentController::class)->name('*','appointment');
	Route::get('doctorsBySpecification/{id}', [EmployeeController::class,'doctorsBySpecification'])->name("doctorsBySpecification");
	Route::get('doctorsByDate/{id}/{date}', [EmployeeController::class,'doctorsByDate'])->name("doctorsByDate");

	Route::post('/cancelBooking',[AppointmentController::class,'cancelBooking'])->name('cancelBooking');

	Route::post('/changeappointmentStatus',[AppointmentController::class,'changeappointmentStatus'])->name('changeappointmentStatus');
	
	Route::get('payment-page/{id}',[AppointmentController::class,'paymentPage'])->name('payment.page');
	Route::get('family-members/{id}',[PatientController::class,'familyMembers'])->name('patient.family');
	Route::get('patient-details/{id}',[PatientController::class,'patientDetails'])->name('patient.details');
	Route::get('specializationDoctor/{id}',[EmployeeController::class,'specializationDoctor']);
	Route::post('payment',[AppointmentController::class,'payment'])->name('payment');
	Route::get('print-prescription/{id}',[AppointmentController::class,'printPrescription']);
	Route::get('notification',[PushNotificationController::class,'index']);
	Route::get('end-consultation/{id}',[AppointmentController::class,'endConsultation']);
	Route::get('medicines/{keyword}',[AppointmentController::class,'medicines']);
	Route::get('appointment-call/{id}',[AppointmentController::class,'appointmentCall']);
	Route::get('/agora-chat', [AgoraVideoController::class,'index']);
    Route::post('/agora/token', [AgoraVideoController::class,'token']);
    Route::post('/agora/call-user', [AgoraVideoController::class,'callUser']);
});


