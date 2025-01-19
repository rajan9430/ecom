$(document).ready(function () {
    // Initialize bxSlider for the slider element
    $('.slider').bxSlider({
        auto: true // Enable automatic slide transition
    });

    // Initialize Owl Carousel for the carousel element
    $('.owl-carousel').owlCarousel({
        loop: true, // Enable loop
        margin: 20, // Set margin between items
        nav: true, // Enable navigation arrows
        responsiveClass: true,
        // Add Font Awesome icons for navigation
        navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1, // Set number of items to show at 0px screen width
                nav: true
            },
            600: {
                items: 3, // Set number of items to show at 600px screen width
                nav: false
            },
            1000: {
                items: 4, // Set number of items to show at 1000px screen width
                nav: true,
                loop: false // Disable loop at 1000px screen width
            },
            1300: {
                items: 5, // Set number of items to show at 1300px screen width
                nav: true,
                loop: false // Disable loop at 1300px screen width
            }
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    var dropdownMenu = document.querySelector(".dropdown-menu");

    // Dropdown menu ko hover karte hi band karna
    dropdownMenu.addEventListener("mouseleave", function () {
        dropdownMenu.classList.remove("show");
    });

    // this is for add our product to cart
    $('.product-add-cart-btn').click(function () {
        let product_id = $(this).data('product-id');
        // Create ajax request
        $.ajax({
            url: "action/add-to-cart.php",
            type: "POST",
            data: {
                product_id: product_id
            },
            dataType: "json",
            success: function (response) {
                if (response.status == false) {
                    window.location.href = 'login.php';
                }

                if (response.status == true) {
                    console.log(response)
                    const toastLiveExample = document.getElementById('liveToast')
                    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                    $('.toast-message').text(response.message)
                    toastBootstrap.show()
                    $("#loginForm")[0].reset();
                }

            }
        })
    });

    $(".place_order").click(function(){
        let address_id = $('.address:checked').val();
        let payment_method = $('input[name="payment_method"]:checked').val();
        
        if (!address_id) {
            alert("Please select a delivery address.");
            return;
        }

        if (payment_method === 'cod') {
            // Handle COD Order
            $.ajax({
                url: 'action/place_order.php',
                type: 'POST',
                data: {
                    address_id: address_id,
                    payment_method: payment_method
                },
                success: function(response) {
                    alert("Order placed successfully using COD!");
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("An error occurred while placing the order.");
                    console.log(errorThrown);
                }
            });
        }
    });


});

