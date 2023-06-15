<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paypal Payment</title>

    <link rel="stylesheet" href="assets/css/shopping_cart.css">
</head>
<body>

    <main id="cart-main">
        <div class="site-title text-center">
            <h1 class="font-title">Shopping Cart</h1>
        </div>
        <?php $total = 0;  
        foreach($user_shopping_cart_items as $a){
            $total=$total+ $a->price;
        } ?>
        <div class="container">
        
        
            <div class="grid">
                <div >
                <?php if(!empty($user_shopping_cart_items)){ 
            
            foreach($user_shopping_cart_items as $n){ ?>   
                    <div class="flex item justify-content-between">
                        <div class="flex">
                            <div class="img text-center">
                                <img src="<?php echo site_url('uploads/thumbnails/'.$n->course_image);?>" width="80" height="80">
                            </div>
                            <div class="title">
                                <h3><?php echo $n->course_name; ?></h3>
                                <span><?php echo $n->course_author; ?></span>
                                <a href="<?php echo site_url('shopping_cart/remove_from_cart/'.$n->item_id); ?>">Delete</a>
                            </div>
                        </div>
                        <div class="price">
                            <h4 class="text-red">$<?php echo $n->price ;?></h4>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
                
                <div >
                    <div >
                        <h3>Price Details</h3>

                        <ul>
                            <li class="flex justify-content-between">
                                <label for="price">( 3 items ) : </label>
                                <span>$<?php echo $total ;?></span>
                            </li>
                        
                            <hr>
                            <li class="flex justify-content-between">
                                <label for="price">Amout Payble : </label>
                                <span class="text-red font-title">$<?php echo $total ;?></span>
                            </li>
                        </ul>
                        <div id="empty_cart_button">
                        <a href="<?php echo site_url('shopping_cart/empty_cart/'.$user_id); ?>">Empty</a>
                        </div>
                        <div id="paypal-payment-button">

                        </div>
                    </div>
                </div>
                
            </div>
            <?php  } ?>
        </div>
    </main>


    <script
    src="https://www.paypal.com/sdk/js?client-id=Aas7PoGj7m8q7QzcKOtkzMJBjNh7Pjs0kBM_Tm9nh4VvFzhj6n8on_6GBaHLkm5TEocMLuuqmlyV40iR&disable-funding=credit,card"> </script>
    <script>paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: '<?php echo $total?>'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            window.location.replace("<?php echo base_url(); ?>shopping_cart/payment_success")
        })
    },
    onCancel: function (data) {
        window.location.replace("<?php echo base_url(); ?>shopping_cart/payment_cancel")
    }
}).render('#paypal-payment-button');</script>
    
</body>
</html>