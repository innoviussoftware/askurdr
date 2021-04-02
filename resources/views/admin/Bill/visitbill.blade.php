<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{!! asset('public/pdf/pdfstyle.css') !!}" media="all" />
  </head>
  <body>
    <header class="clearfix">
        <div id="logo">
          <img src="logo.png">
        </div>
         

    </header>
    <div style="text-align: center;border-bottom: 1px solid #AAAAAA;margin-bottom: 20px;">
          <!-- <img src="logo.png"> -->
          <img src="arabic_2.png">        
        </div>
    <main>
            <div id="details" class="clearfix">
              
                    
                        <table border="0" cellspacing="0" cellpadding="0">
                          <thead >
                            <tr>
                                <th style="border: 1px solid black;">Customer Name</th>
                                <th style="border: 1px solid black;">Bill No</th>
                                <th style="border: 1px solid black;">Dr Ask Code</th>
                                <th style="border: 1px solid black;">Date Time</th>
                            </tr>
                          </thead>
                          <tbody>
                                  <tr>
                                    <th style="border: 1px solid black;">{{$receiver_fname.' '.$receiver_lname}}</th>
                                    <th style="border: 1px solid black;">{{$doctorbill->bill_no}}</th>
                                    <th style="border: 1px solid black;">{{$dr_code}}</th>
                                    <th style="border: 1px solid black;">{{$doctorbill->created_at->format('d-m-Y H:i:s')}}</th>
                                  </tr>
                          </tbody>
                      </table>
                    
                  
              
            </div>
         
            <table border="1" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th style="background:none !important;">Sr No</th>
                  <th style="background:none !important;float: left !important;">DESCRIPTION</th>
                  <th style="background:none !important;">Amount (SAR)</th>
                
                  

                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="background:none !important;">01</td>
                  <td style="background:none !important;">e-consultation by Askurdr.com</td>
                  <td style="background:none !important;">{{$doctorbill->discount_fees}}</td>
                  
                </tr>
                <tr>
                 
                    <td style="background:none !important;" colspan="2">Total Before VAT (SAR)</td>
                    <td style="background:none !important;" colspan="2">{{$doctorbill->discount_fees}}</td>
                  </tr>
                  <tr>
                    
                    <td style="background:none !important;" colspan="2">VAT Amount (SAR)</td>
                    <td style="background:none !important;" colspan="2">{{$doctorbill->vat}}</td>
                  </tr>
                  <tr>
                  
                    <td style="background:none !important;" colspan="2">TOTAL With VAT (SAR)</td>
                    <td style="background:none !important;" colspan="2">{{$doctorbill->vat_fees}}</td>
                  </tr>
               
              </tbody>

            
            </table>
      
        <div id="signature" style="float: right;">
            <p><b>Signature:</b>  </p> 
        </div>

        <div id="vat" style="float: left;">
            <p><b>CR Number:</b>  </p>
            <p><b>Telephone Number:</b>  </p>
            <p><b>VAT Number:</b> 310524596800003 </p> 
        </div>

    </main>
    <footer>
      
    </footer>
  </body>
</html>