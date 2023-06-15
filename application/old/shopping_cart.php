<html>  
      <head>  
           <title>Webslesson Tutorial | Simple PHP Mysql Shopping Cart</title>  
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
           <script src="https://www.paypal.com/sdk/js?client-id=Aas7PoGj7m8q7QzcKOtkzMJBjNh7Pjs0kBM_Tm9nh4VvFzhj6n8on_6GBaHLkm5TEocMLuuqmlyV40iR"> 
  </script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:700px;">  
               
                <h1>Shopping Cart Detais</h1>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Course Name</th>  
                               <th width="40%">Price</th>   
                               <th width="20%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($user_shopping_cart_items))  
                          {  
                               $total = 0;  
                               foreach($user_shopping_cart_items as $n)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $n->course_name; ?></td>  
                               <td><?php echo  $n->price; ?></td>  
                               
                               <td><a href="<?php echo site_url('shopping_cart/remove_from_cart/'.$n->course_id); ?>><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + $n->price;  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />  
  <div id="empty_cart_button"><a href="<?php echo site_url('shopping_cart/empty_cart/'.$user_id); ?>><span class="text-danger">Empty</span></a><div>
  <div id="paypal-button-container"></div>
  
<script>
  paypal.Buttons().render('#paypal-button-container');
</script>
<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
</script>

      </body>  
 </html>
