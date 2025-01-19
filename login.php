<?php 
session_start();
if (isset($_SESSION['loggedIn'])) {
    header('Location:index.php');
}

// Include required files
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<div class="card">
    <div class="card-body">
        <div class="container">
            <h1 class="text-center py-5">Login</h1>
            <div class="border p-4 login-card">
                <form id="loginForm" action="user_registration_action.php" method="post">
                    <div class="row">
                        <!-- Email Input -->
                        <div class="col-md-12 mb-3" style="margin-top: 8px;">
                            <div class="form-grpup">
                                <label for="email"><b>Email</b></label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="email_error"></div>
                            </div>
                        </div>
                        <!-- Password Input -->
                        <div class="col-md-12 mb-3" style="margin-top: 8px;">
                            <div class="form-grpup">
                                <label for="password"><b>Password</b></label>
                                <input type="password" id="password" name="password" placeholder="Please Enter Password" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="password_error"></div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                        <div>
                            <p class="text-center mt-4">Don't have an account ? <a href="register.php">Create Account.</a></p>
                        </div>
                        <div class="col-md-12" id="message"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    $(document).ready(function() {
        // Handle login form submission
        $("#loginForm").on("submit", function(event) {
            event.preventDefault();
            $('.text-danger').html(""); // Clear previous errors
            const fields = {
                email: $("#email").val(),
                password: $("#password").val(),
            }
            let valid = true;
            const errors = {};
            if (fields.email.trim() === "") {
                valid = false;
                errors.email_error = "Email is required";
            }
            if (fields.password.trim() === "") {
                valid = false;
                errors.password_error = "Password field is required";
            }
            if (!valid) {
                for (const [key, value] of Object.entries(errors)) {
                    $("#" + key).html(value);
                }
                return;
            }
            let fd = $("#loginForm").serialize();
            $.ajax({
                url: "action/user_login_action.php",
                type: "POST",
                data: fd,
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        const toastLiveExample = document.getElementById('liveToast')
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                        $('.toast-message').text(response.message)
                        toastBootstrap.show()
                        $("#loginForm")[0].reset();
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 1000);
                    }
                    if (response.status == false) {
                        $.each(response.errors, function(key, value) {
                            $("#" + key).html(value);
                        })
                    }
                }
            })
        });
    });
</script>
