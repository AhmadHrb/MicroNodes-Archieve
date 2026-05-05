<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Buy Points - MicroNodes</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script
    src="https://www.paypal.com/sdk/js?client-id=AVSb7P9lsyPC_ETDMoa-zgpGqip2tOZDTWMGtmgH6P70ts-7PLw4JnfqrBdyMHyWKZnRAHVGvOShjQM0" data-sdk-integration-source="button-factory">
    </head>
    <body>
     <?php require('../nav.php'); ?>
     <div class="container-fluid bg-light">
     <center>
    <h3>Buy 200,000 Points</h3>
    
    $<b>0.99</b>
    <div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'buynow',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":0}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
        },

        onError: function(err) {
          console.error(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>
    </center>    
</div>
<hr class="bg-dark">
                    <center>
                        <h3><b>Need Help?</b></h3>
                        <div class="container">
                        <div class="row">
                            <div class="col text-primary"><a href="../discord/" style="color:unset"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50%;height: 100%" fill="currentColor" class="bi bi-discord" viewBox="0 0 16 16">
                                <path d="M6.552 6.712c-.456 0-.816.4-.816.888s.368.888.816.888c.456 0 .816-.4.816-.888.008-.488-.36-.888-.816-.888zm2.92 0c-.456 0-.816.4-.816.888s.368.888.816.888c.456 0 .816-.4.816-.888s-.36-.888-.816-.888z"/>
                                <path d="M13.36 0H2.64C1.736 0 1 .736 1 1.648v10.816c0 .912.736 1.648 1.64 1.648h9.072l-.424-1.48 1.024.952.968.896L15 16V1.648C15 .736 14.264 0 13.36 0zm-3.088 10.448s-.288-.344-.528-.648c1.048-.296 1.448-.952 1.448-.952-.328.216-.64.368-.92.472-.4.168-.784.28-1.16.344a5.604 5.604 0 0 1-2.072-.008 6.716 6.716 0 0 1-1.176-.344 4.688 4.688 0 0 1-.584-.272c-.024-.016-.048-.024-.072-.04-.016-.008-.024-.016-.032-.024-.144-.08-.224-.136-.224-.136s.384.64 1.4.944c-.24.304-.536.664-.536.664-1.768-.056-2.44-1.216-2.44-1.216 0-2.576 1.152-4.664 1.152-4.664 1.152-.864 2.248-.84 2.248-.84l.08.096c-1.44.416-2.104 1.048-2.104 1.048s.176-.096.472-.232c.856-.376 1.536-.48 1.816-.504.048-.008.088-.016.136-.016a6.521 6.521 0 0 1 4.024.752s-.632-.6-1.992-1.016l.112-.128s1.096-.024 2.248.84c0 0 1.152 2.088 1.152 4.664 0 0-.68 1.16-2.448 1.216z"/>
                            </svg></a></div>
                            <div class="col text-warning"><a href="mailto:support@micronodes.tech" style="color: unset"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50%;height: 100%" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                            </svg></a></div>
                        </div>
                        </div>
                    </center>

                    <hr class="bg-dark">
                    <center>
                        <div class="bg-primary">

                            <br>
                            <p>&copy; 2021 - <b class="rainbow">MicroNodes</b>.</p>
                            <br>
                        </div>
                    </center>
          <script src="../js/bootstrap.js"></script>
    </body>
</html>