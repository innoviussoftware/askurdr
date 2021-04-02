<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}" style="background-color: transparent;">
    <div class="sidebar-brand-icon">
      <img src="{!! asset('public/logo.png') !!}" class="img-fluid" width="100"/>
    </div>
    <!-- <div class="sidebar-brand-text mx-3">Omnee <sup>1.0</sup></div> -->
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <!-- <li class="nav-item active">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li> -->

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <!-- <div class="sidebar-heading">
    Interface
  </div> -->

  <!-- Nav Item - Home Collapse Menu -->
  
  <li class="nav-item {{ Route::currentRouteName() === 'admin.home' ? 'active' : '' }} ">
    <a class="nav-link collapsed" href="{{ route('home') }}"aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-home"></i>
      <span>Home</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('home') }}"><i class="fas fa-home"> </i> &nbsp;Dashboard</a>
      </div>
    </div>
  </li>
  
  <!-- Nav Item - Usermanagement Collapse Menu -->
  <li class="nav-item {{ Route::currentRouteName() === 'admin.doctor.index' ? 'active' : '' }} ">

    <a class="nav-link collapsed " href="{{ route('admin.doctor.index') }}" aria-expanded="true" aria-controls="collapseUsermanage">
      <i class="fas fa-user-md"></i>
      <span>Doctors</span>
    </a>

   
    <div id="collapseUsermanage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.doctor.index') }}"><i class="fas fa-user"> </i> &nbsp;&nbsp;Doctors</a>
        
      </div>
    
    </div>
    
  </li>
<?php 
?>
  <li class="nav-item {{ Route::currentRouteName() === 'admin.patientlist.index' ? 'active' : '' }} ">
     
     <a class="nav-link collapsed " href="{{ route('admin.patientlist.index') }}" aria-expanded="true" aria-controls="collapseUsermanage">
      <i class="fas fa-user"></i>
      <span>Patients</span>
    </a>
   
    <div id="collapsePatientmanage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item " href="{{ route('admin.patientlist.index') }}"><i class="fas fa-user"> </i> &nbsp;&nbsp;Patient</a>
      </div>
    
    </div>
    
  </li>
  
  <!-- <li class="nav-item {{ Route::currentRouteName() === 'admin.appointmentdetails.index' ? 'active' : '' }} ">

    <a class="nav-link collapsed " href="{{ route('admin.appointmentdetails.index') }}" aria-expanded="true" aria-controls="collapseUsermanage">
      <i class="fas fa-user-md"></i>
      <span>Appointments</span>
    </a>

   
    <div id="collapseUsermanage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.appointmentdetails.index') }}"><i class="fas fa-user"> </i> &nbsp;&nbsp;Appointments</a>
        
      </div>
    
    </div>
    
  </li> -->
  

  <!-- Nav Item - Master Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
      <i class="fas fa-fw fa-wrench" style="transform: rotate(260deg);"></i>
      <span>Master</span>
    </a>
    <div id="collapseMaster" class="collapse {{ Route::currentRouteName() === 'admin.speciality.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.document_type.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.clinic.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.medicines.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.investigation.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.patient.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.refreal.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.insurance.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.prescriptionreport.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.investigationreport.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.plan.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.paymentdetails.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.insurancedetails.index' ? 'show' : '' }}{{ Route::currentRouteName() === 'admin.master.setting.fees' ? 'show' : '' }}{{ Route::currentRouteName() === 'admin.lang.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.wallet.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.doctorcommsion.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.clinicwallet.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.vat.index' ? 'show' : '' }} {{ Route::currentRouteName() === 'admin.askclinicwallet.index' ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">

        <a class="collapse-item {{ Route::currentRouteName() === 'admin.hospital.index' ? 'active' : '' }}" href="{{ route('admin.hospital.index') }}"><i class="fas fa-hospital" style="padding-right: 1em;font-weight: 700;">&nbsp;</i>Hospital</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.insurance.index' ? 'active' : '' }}" href="{{ route('admin.insurance.index') }}"><i class="fas fa-industry" style="padding-right: 1em;font-weight: 700;">&nbsp;</i>Insurance Company</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.document_type.index' ? 'active' : '' }}" href="{{ route('admin.document_type.index') }}"><i class="fas fa-file" style="padding-right: 1em;">&nbsp;</i>Document Type</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.investigation.index' ? 'active' : '' }}" href="{{ route('admin.investigation.index') }}"><i class="fas fa-search" style="padding-right: 1em;"></i>Investigation</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.medicines.index' ? 'active' : '' }}" href="{{ route('admin.medicines.index') }}"><i class="fas fa-medkit" style="padding-right: 1em;"></i>Medicines</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.prescriptionreport.index' ? 'active' : '' }}" href="{{ route('admin.prescriptionreport.index') }}"><i class="fas fa-prescription" style="padding-right: 1em;">&nbsp;</i>Prescription</a>
        <!-- <a class="collapse-item {{ Route::currentRouteName() === 'admin.prescriptionlistall.index' ? 'active' : '' }}" href="{{ route('admin.prescriptionlistall.index') }}"><i class="fas fa-prescription" style="padding-right: 1em;">&nbsp;</i>Prescription</a> -->
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.refreal.index' ? 'active' : '' }}" href="{{ route('admin.refreal.index') }}"><i class="fas fa-user-plus"style="padding-right: 0.8em;"></i>Referral</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.speciality.index' ? 'active' : '' }}" href="{{ route('admin.speciality.index') }}"><i class="fas fa-stethoscope"style="padding-right: 0.7em;">&nbsp;</i>Speciality</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.investigationreport.index' ? 'active' : '' }}" href="{{ route('admin.investigationreport.index') }}"><i class="fas fa-search" style="padding-right: 1em;"></i>Investigation Report</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.plan.index' ? 'active' : '' }}" href="{{ route('admin.plan.index') }}"><i class="fa fa-credit-card" style="padding-right: 1em;"></i>Package</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.paymentdetails.index' ? 'active' : '' }}" href="{{ route('admin.paymentdetails.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Payment Details</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.insurancedetails.index' ? 'active' : '' }}" href="{{ route('admin.insurancedetails.index') }}"><i class="fa fa-shield-alt" style="padding-right: 1em;"></i>Insurance Details</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.master.setting.fees' ? 'active' : '' }}" href="{{ route('admin.master.setting.fees') }}"><i class="fa fa-shield-alt" style="padding-right: 1em;"></i>Wallet Setting</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.lang.index' ? 'active' : '' }}" href="{{ route('admin.lang.index') }}"><i class="fa fa-language" style="padding-right: 1em;"></i>Language</a>
        <!-- <a class="collapse-item {{ Route::currentRouteName() === 'admin.wallet.index' ? 'active' : '' }}" href="{{ route('admin.wallet.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Commission Wallet</a> -->
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.clinicwallet.index' ? 'active' : '' }}" href="{{ route('admin.clinicwallet.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Hospital Wallet</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.askclinicwallet.index' ? 'active' : '' }}" href="{{ route('admin.askclinicwallet.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Ask Hospital Wallet</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.doctorcommsion.index' ? 'active' : '' }}" href="{{ route('admin.doctorcommsion.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Doctor Commission</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.vat.index' ? 'active' : '' }}" href="{{ route('admin.vat.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Vat</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.vat.index' ? 'active' : '' }}" href="{{ route('admin.bill.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Bill</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'payment.index' ? 'active' : '' }}" href="{{ route('admin.payment.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Payment</a>
        <a class="collapse-item {{ Route::currentRouteName() === 'admin.callLog.index' ? 'active' : '' }}" href="{{ route('admin.callLog.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Call Log</a>

        <a class="collapse-item {{ Route::currentRouteName() === 'admin.followup.index' ? 'active' : '' }}" href="{{ route('admin.followup.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Followup Record</a>


        <a class="collapse-item {{ Route::currentRouteName() === 'admin.mastersettings.index' ? 'active' : '' }}" href="{{ route('admin.mastersettings.index') }}"><i class="fa fa-wallet" style="padding-right: 1em;"></i>Setting</a>
      </div>
    </div>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
