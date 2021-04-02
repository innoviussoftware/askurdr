<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Prescription - clinic </title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #003366;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>


<div class="information">
    <table width="100%">
        <tr>
            <td align="center" >
                <img src="logo.png" alt="Logo" width="100" class="logo"/>
            </td>
        </tr>
    </table>
</div>
<body>
    <div class="cashmemo" style="">

       
        
        <div class="mid_body">
            <center style="font-size: 2.5em;">Referral</center>
            <br>
            <center>
              <label><b> </b> </label>
            </center>
            <br>
            @foreach($visit_referral as $vr)
            <label style="float: left;margin-left: 10px;"><b>Speciality Name:</b> {{isset($vr->speciality->name)?$vr->speciality->name:null}}</label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>Doctor Name:</b> 
            {{isset($vr->doctor->first_name)?$vr->doctor->first_name:null}}
            {{isset($vr->doctor->last_name)?$vr->doctor->last_name:null}}
            </label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>Diagnosis :</b> {{isset($vr->diagnosis)?$vr->diagnosis:null}}</label>
            <br>
            <br>
            <label style="float: left;margin-left: 10px;"><b>Reason :</b>{{isset($vr->reason)?$vr->reason:null}}</label>
            @endforeach
            <br>
            <br>
            <br>
        </div> 
    </div> 
    <div class="information" style="position: absolute; bottom: 0;padding-left: 2.2em;">
              <div class="row">
                  <div class="col-xs-12">
                    <label style="padding-left: 1em;">{{isset($clinic->clinic->name)?$clinic->clinic->name:''}}</label>
                  </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <label style="padding-left: 1em;">{{isset($visit_prescription->doctor->first_name)?$visit_prescription->doctor->first_name:''}}  {{isset($visit_prescription->doctor->last_name)?$visit_prescription->doctor->last_name:''}}</label>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <label style="padding-left: 1em;">{{isset($visit_prescription->doctor->mobile)?$visit_prescription->doctor->mobile:''}}</label>
                </div>
              </div>
</div>    
  </body>
</html>