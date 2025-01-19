<?php 
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<div class="card">
    <div class="card-body">
        <div class="container">
            <h1 class="text-center py-5">Registration</h1>
            <div class="border p-4">
                <form id="registractionForm" action="user_registration_action.php" method="post">
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <div class="form-grpup">
                                <label for="first_name"><b>First Name</b></label>
                                <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="first_name_error"></div>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <div class="form-grpup">
                                <label for="last_name"><b>Last Name</b></label>
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="last_name_error"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3" style="margin-top: 8px;">
                            <div class="form-grpup">
                                <label for="email"><b>Email</b></label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="email_error"></div>
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div class="col-md-6 mb-3" style="margin-top: 8px;">
                            <div class="form-grpup">
                                <label for="mobile"><b>Mobile No.</b></label>
                                <input type="tel" id="mobile" name="mobile" placeholder="Mobile No." class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="mobile_error"></div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3" style="margin-top: 8px;">
                            <div class="form-grpup">
                                <label for="password"><b>Password</b></label>
                                <input type="password" id="password" name="password" placeholder="Please Enter Password" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="password_error"></div>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3" style="margin-top: 8px;">
                            <div class="form-grpup">
                                <label for="comfirm_password"><b>Confirm Password</b></label>
                                <input type="password" id="comfirm_password" name="comfirm_password" placeholder="Please Confirm your Password" class="form-control py-3" style="margin-top: 8px;">
                                <div class="text-danger" id="comfirm_password_error"></div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="col-md-12 mb-3">
                            <input type="checkbox" id="terms" style="margin-top: 20px;">
                            <label for="terms">Agree with user's terms & conditions.</label>
                            <div class="text-danger" id="terms_error"></div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            <button type="reset" class="btn btn-warning btn-lg ms-4 px-4">Reset</button>
                        </div>

                        <div>
                            <p class="text-center mt-4">Already have an account? <a href="login.php">Click here for login</a></p>
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
        $("#registractionForm").on("submit", function(event) {
            event.preventDefault();
            $('.text-danger').html(""); // Clear previous errors

            // Collect form data
            const fields = {
                first_name: $("#first_name").val(),
                last_name: $("#last_name").val(),
                email: $("#email").val(),
                mobile: $("#mobile").val(),
                password: $("#password").val(),
                comfirm_password: $("#comfirm_password").val(),
                terms: $("#terms")
            };

            let valid = true;
            const errors = {};

            // Validation checks
            if (fields.first_name.trim() === "") {
                valid = false;
                errors.first_name_error = "First name is required";
            }
            if (fields.last_name.trim() === "") {
                valid = false;
                errors.last_name_error = "Last name is required";
            }
            if (fields.email.trim() === "") {
                valid = false;
                errors.email_error = "Email is required";
            }
            if (fields.mobile.trim() === "") {
                valid = false;
                errors.mobile_error = "Mobile number is required";
            }
            if (fields.password.trim() === "") {
                valid = false;
                errors.password_error = "Password is required";
            }
            if (fields.comfirm_password.trim() === "") {
                valid = false;
                errors.comfirm_password_error = "Confirm Password is required";
            } else if (fields.comfirm_password !== fields.password) {
                valid = false;
                errors.comfirm_password_error = "Passwords do not match";
            }
            if (!fields.terms.is(":checked")) {
                valid = false;
                errors.terms_error = "You must agree to the terms and conditions";
            }

            if (!valid) {
                for (const [key, value] of Object.entries(errors)) {
                    $("#" + key).html(value); // Show errors
                }
                return;
            }

            let fd = $("#registractionForm").serialize();
            $.ajax({
                url: "action/user_registration_action.php",
                type: "POST",
                data: fd,
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        $("#message").html('<div class= "alert alert-success">' + response.message + '</div>');
                        $("#registractionForm")[0].reset();
                    }
                    if (response.status == false) {
                        $.each(response.errors, function(key, value) {
                            $("#" + key).html(value);
                        });
                    }
                }
            });
        });
    });
</script>
