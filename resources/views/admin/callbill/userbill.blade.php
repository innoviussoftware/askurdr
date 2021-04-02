<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{!! asset('public/pdf/pdfstyle.css') !!}" media="all" />
  </head>
  <body>
    <header class="clearfix">
        <div id="logo" style="text-align: center;">
          <img src="logo.png">
        </div>
    </header>
    <main>
            <div id="details" class="clearfix">
              <div id="client">
                <div class="to"><b>Customer:</b></div>
                <h2 class="name">John Doe</h2>
                <!-- <div class="address">796 Silver Harbour, TX 79273, US</div> -->
                <!-- <div class="email"><a href="mailto:john@example.com">john@example.com</a></div> -->
              </div>
              <div id="client" style="float: right;">
                <div class="to"><b>Ship To:</b></div>
               <!--  <h2 class="name">John Doe</h2> -->
                <div class="address">796 Silver Harbour, TX 79273, US</div>
                <!-- <div class="email"><a href="mailto:john@example.com">john@example.com</a></div> -->
              </div>
              
            </div>
           <!--  <div id="detailstable">
              <table>
                <tr>
                  <th></th>
                  <th>Order No</th>
                  <th>Document No</th>
                  <th>Document Type</th>
                </tr>
                <tr>
                  <td>a</td>
                  <td>a</td>
                  <td>a</td>
                  <td>a</td>
                </tr>
                <tr>
                  <th>Your Order No</th>
                  <th>Account No</th>
                  <th>Document Date</th>
                  <th>Salesman</th>
                </tr>
                <tr>
                  <td>a</td>
                  <td>a</td>
                  <td>a</td>
                  <td>a</td>
                </tr>
              </table>
            </div> -->
            <table border="0" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th class="no">No</th>
                  <th class="desc">DESCRIPTION</th>
                  <th class="unit">Unit</th>
                  <th class="qty">QTY</th>
                  <th class="total">Unit Price</th>
                  <th class="total">TOTAL</th>

                  

                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="no">01</td>
                  <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
                  <td class="unit">$40.00</td>
                  <td class="qty">30</td>
                  <td class="total">$1,200.00</td>
                  <td class="total">$1,200.00</td>
                </tr>
               
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="3">Total Before VAT</td>
                  <td>$5,200.00</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="3">VAT Amount</td>
                  <td>$1,300.00</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="3">TOTAL</td>
                  <td>$6,500.00</td>
                </tr>
              </tfoot>
            </table>
      
        <div id="signature">
          <p><b>Signature:</b> aaa </p> 
          <p><b>Date:</b> aaa </p> 
        </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>