<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Prescription</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 100%;  
  height: 50%;
  border-bottom: 1px solid 999; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  width: 100%;
  height: 115px;
}

#logo {
  text-align: left;
}

#logo img {
  width: 100px;
}

h1 {
  /*color: #A72326;*/
  color: #FFF;
  font-size: 1.2em;
  line-height: 1.2em;
  padding: 8px 0;
  font-weight: normal;
  text-align: center;
  background: #A72326;
}

#company {
  width: 150px;
  float: right;
  text-align: right;
  margin-right: 5px;
  font-size: 0.9em;
}

#company div {
  white-space: nowrap;        
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

.mid_body
{
    width: 100%;
    float: left;
    padding: 2px 0px;
    text-align: right;
}
footer {
    position: fixed;
    height: 100px;
    bottom: 0;
    width: 100%;
}

</style>



  </head>
  <body>
    <div class="cashmemo" style="">

        <header class="clearfix" style="border-bottom: 1px solid #999;">
          <div id="logo" style="float: left">
            <img src="logo.png" style="width: 15%;">
          </div>
          <div id="company">
            <label>Prescription No: {{$patient->prescription_number}}</label>
          </div>
        </header>
        
        <div class="mid_body">
            <center style="font-size: 2.5em;">Prescription</center>
            
            <br>
            
            <center>
              <label><b> </b> </label>
            </center>
            
            <br>
            <label style="float: left;margin-left: 10px;"><b>EMR No:</b> {{$patient->emr_number}}</label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>Patient Name:</b> {{$patient->emr_number}} </label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>AGE :</b></label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>Diagnosis :</b></label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>Date :</b></label>
            <br>
            <br>
            <br>

          <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Medicine</th>
                  <th scope="col">Dosage</th>
                  <th scope="col">Route</th>
                  <th scope="col">Frequency</th>
                  <th scope="col">Duration</th>
                </tr>
              </thead>
              <tbody>
                @foreach($patient_medicines as $medicines)
                  <tr>
                      <td scope="col">No</th>
                      <td scope="col">Medicine</th>
                      <td scope="col">Dosage</th>
                      <td scope="col">Route</th>
                      <td scope="col">Frequency</th>
                      <td scope="col">Duration</th>
                  </tr>
                @endforeach
              </tbody>
          </table>        
          <br><br>
          <label style="float: left;margin-left: 10px;"><b>Note to Pharmacy :</b></label>
          <br><br>
          <label style="float: left;margin-left: 10px;"><b>Dr.Name :</b></label>
          <br><br>

          <label style="float: left;margin-left: 10px;"><b>Doctor's Sign :</b> <p style="border-bottom: 1px solid #ccc;float: left;margin-left: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p> </label>

        </div> 

    </div>
    <footer class="fixed-bottom" style="border-top: 1px solid #999;padding: 10px;padding-bottom: 0px;">
      <h5><center>Hospital Name:hello</center></h5>
      <h5><center>Doctor Name:hello</center></h5>
      <h5><center>Contact Number:hello</center></h5>
     </footer>
  </body>
</html>