<script src="https://js.stripe.com/v3/"></script>
<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('<?php echo $this->publish_key; ?>');

    // Select payment button
    const payBtn = document.querySelector("#button_submit_payment");
    payBtn.addEventListener("click", function(evt) {
        try {
            stripe.redirectToCheckout({
                sessionId: '<?php echo $this->session_payment['sessionId'] ?>',
            });
        }
        catch(err) {
            alert('Payment section can`t open');
        }
        
    });

    // Create a Checkout Session with the selected product
    // Handle any errors returned from Checkout
    // const handleResult = function(result) {
    //     if (result.error) {
    //         showMessage(result.error.message);
    //     }

    //     setLoading(false);
    // };

    // Show a spinner on payment processing
    // function setLoading(isLoading) {
    //     if (isLoading) {
    //         // Disable the button and show a spinner
    //         payBtn.disabled = true;
    //         document.querySelector("#spinner").classList.remove("hidden");
    //     } else {
    //         // Enable the button and hide spinner
    //         payBtn.disabled = false;
    //         document.querySelector("#spinner").classList.add("hidden");
    //     }
    // }
</script>