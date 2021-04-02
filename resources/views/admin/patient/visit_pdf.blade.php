<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="prescription_pdf_header.png" alt="Logo" class="logo" width="100%" height="230px" />
        </header>


        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="padding-top: 3em;">
            <div class="invoice">

    <div class="invoice" style="padding-left: 2.2em;">

      
            <div class="row">
              <div class="col-xs-12">
                  <label>EMR No:</label>
                  <label>{{isset($patient_name)?$patient_name->emr_number:''}}</label>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                  <label>Patient Name:</label>
                  <label>{{isset($patient_name)?$patient_name->first_name:''}} {{isset($patient_name)?$patient_name->last_name:''}}</label>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                  <label>AGE:</label>
                  <label>{{isset($patient_name)?$patient_name->age:''}}</label>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                  <label>Gender:</label>
                  <label>{{isset($patient_name)?$patient_name->gender:''}}</label>
              </div>
            </div>

           
            <div class="row">
              <div class="col-xs-6">
                <label>Doctor Name:</label>
                <label>{{ isset($doctor_name->first_name)? utf8_encode($doctor_name->first_name) :''}}  {{isset($doctor_name->last_name)?$doctor_name->last_name:''}}</label>
              </div>
            </div>
            
            
            <div class="row">
              <div class="col-xs-6">
                <label>Date:</label>
                <label>{{date('d-m-Y')}}</label>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <label>Prescription No:</label>
                <label>{{isset($visit_prescriptionid)?$visit_prescriptionid:''}}</label>
              </div>
            </div>

    </div>
    <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Medicine</th>
                  <th scope="col">Dosage</th>
                  <th scope="col">Unit</th>
                  <th scope="col">Route</th>
                  <th scope="col">Frequency</th>
                  <th scope="col">Duration</th>
                </tr>
              </thead>
              <tbody>
                 <?php
                  foreach ($visit_prescription_data as $key => $value) {
                    ?>
                    <tr>
                           <td scope="col">{{++$key}}</td>
                           <td scope="col">{{isset($value)?$value->medicine_name:''}}</td>
                           <td scope="col">{{isset($value)?$value->dose:''}}</td>
                           <td scope="col">{{isset($value)?$value->unit:''}}</td>
                           <td scope="col">{{isset($value)?$value->route:''}}</td>
                           <td scope="col">{{isset($value)?$value->frequency:''}} - {{isset($value)?$value->frequency2:''}} - {{isset($value)?$value->frequency3:''}}</td>
                           <td scope="col">{{isset($value)?$value->duration:''}}</td>
                           
                       </tr>
                    <?php
                  }
                 ?>
              </tbody>
            </table>
          </div>
        </main>
    </body>
</html>
