<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">

    <title>Prescription - clinic </title>

<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
</style> -->
<style type="text/css">
    .table{
        width: 100%;
    }
    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
        th, td { 
            border: 1px solid black; 
            border-collapse: collapse; 
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
    <table width="100%" border="1">
 <caption>A complex table</caption>
 <thead>
  <tr>
   <th colspan="3">Invoice #123456789</th>
   <th>14 January 2025
  </tr>
  <tr>
   <td colspan="2">
    <strong>Pay to:</strong><br>
    Acme Billing Co.<br>
    123 Main St.<br>
    Cityville, NA 12345
   </td>
   <td colspan="2">
    <strong>Customer:</strong><br>
    John Smith<br>
    321 Willow Way<br>
    Southeast Northwestershire, MA 54321
   </td>
  </tr>
 </thead>
 <tbody>
  <tr>
   <th>Name / Description</th>
   <th>Qty.</th>
   <th>@</th>
   <th>Cost</th>
  </tr>
  <tr>
   <td>Paperclips</td>
   <td>1000</td>
   <td>0.01</td>
   <td>10.00</td>
  </tr>
  <tr>
   <td>Staples (box)</td>
   <td>100</td>
   <td>1.00</td>
   <td>100.00</td>
  </tr>
 </tbody>
 <tfoot>
  <tr>
   <th colspan="3">Subtotal</th>
   <td> 110.00</td>
  </tr>
  <tr>
   <th colspan="2">Tax</th>
   <td> 8% </td>
   <td>8.80</td>
  </tr>
  <tr>
   <th colspan="3">Grand Total</th>
   <td>$ 118.80</td>
  </tr>
 </tfoot>
</table>      
</body>
</html>