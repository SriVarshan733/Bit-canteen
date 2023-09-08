<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_35KB49UYo7xAQa", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "BIT-CANTEEN",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="finalout.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>

</head>
<body>

   
<div class="heading">
   <h3>Payment dashboard</h3>
   <p><a href="home.php">home</a> <span> / pay now</span></p>
</div>

<section class="form-container">

   <form action="" method="post">
      <h3>Pay Here</h3>
      <h1 style="color:red;">Disclaimer : Enter the name and grand total as shown in the checkout page</h1>
      <input type="textbox" name="name" id="name" required placeholder="enter your name" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="textbox" name="amt" id="amt" required placeholder="grand total" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()" class="btn">
   </form>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>