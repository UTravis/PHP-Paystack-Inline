<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Initialize Payment</title>
</head>
<body>
    <div class="container">
        <div class="offset-lg-4 col-lg-4 mt-5">
            <form id="paymentForm" >
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email-address" name="email-address" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="tel" id="amount" name="amount" class="form-control" required />
                </div>
                <div class="form-submit">
                    <button type="submit" onclick="payWithPaystack()" class="btn btn-secondary btn-block"> Pay </button>
                </div>
            </form>
        </div>
    </div>

    <button id="btn">Check</button>
</body>
<script src="https://js.paystack.co/v1/inline.js"></script> 
    <script>

        $("#btn").click(function(){
            alert('Jquery is working');
        });

        var paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener('submit', payWithPaystack);

        function payWithPaystack(e) {
            e.preventDefault();
            
            var handler = PaystackPop.setup({

                    key: 'pk_test_b3e254392ba5d8f8382e46733a0d438990b10969', // Replace with your public key
                    email: document.getElementById('email-address').value,
                    amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
                    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
                    ref: 'TX'+Math.floor((Math.random() * 1000000000) + 1), // Replace with a reference you generated
                    callback: function(response) {
                        // Make an AJAX call to your server with the reference to verify the transaction
                        var reference = response.reference;

                        $.ajax({
                            url: "/verify.php",
                            method: "POST",
                            type: "json",
                            data: {
                                reference
                            },
                            success: function (response) {
                                console.log(JSON.parse(response))
                            },
                            error: function (error){
                                console.log(error)
                            }
                        });

                    },
                    onClose: function() {
                        alert('Transaction was not completed, window closed.');
                    },
                });

                handler.openIframe();

            
        }

        
    </script>
</html>