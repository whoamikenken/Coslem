<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="<?= base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form id="registration">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="username" name="username" type="text" placeholder="Enter your username" />
                                                    <label for="username">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" />
                                                    <label for="name">First Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="" name="" type="text" placeholder="Enter your name" />
                                                    <label for="">Last Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" />
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="mobile" name="mobile" type="text" placeholder="Enter your mobile" />
                                                    <label for="mobile">Mobile Number</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="age" name="age" type="number" placeholder="20" />
                                                    <label for="age">Age</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <label for="gender">Gender</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="contribution" name="contribution" type="number" placeholder="20" />
                                                    <label for="contribution">Contribution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="address" name="address" type="text" placeholder="Enter your address" />
                                                    <label for="address">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" />
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="confirm_pass" type="password" placeholder="Confirm password" />
                                                    <label for="confirm_pass">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><a class="btn btn-primary btn-block" type="button" id="createAccount">Create Account</a></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="<?= base_url() ?>index.php/Main_/loginPage">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; COSLEM 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url(); ?>js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>js/scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {});
        $('#createAccount').on('click', function() {
            var username = $('#username').val();
            var firstname = $('#name').val();
            var lastname = $('#lname').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();
            var age = $('#age').val();
            var contribution = $('#contribution').val();
            var address = $('#address').val();
            var password = $('#password').val();
            var confirm = $('#confirm_pass').val();

            // Check if all fields are filled out
            if (username === '' || firstname === '' || lastname === '' || email === '' ||
                mobile === '' || contribution === '' || address === '' || password === '' || lastname === '' || lastname === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: 'Please fill out all fields'
                });
                return false;
            }

            // Check if email is valid
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter a valid email address'
                });
                return false;
            }

            if (age < 18) {
            }
            else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'under age'
                });
            }

            // Check if password and confirm password match
            if (password !== confirm) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Passwords do not match'
                });
                return false;
            }

            // Check if password meets requirements
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
            if (!passwordRegex.test(password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password must contain at least one capital letter, one small letter, one number, and one symbol and be at least 8 characters long.'
                });
                return false;
            }

            var formdata = $("#registration").serialize();

            $.ajax({
                url: "<?= site_url("Main_/registerUser") ?>",
                type: "POST",
                data: formdata,
                success: function(response) {

                    if (response.trim() == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Success!',
                            text: 'We will redirect you to registration',
                            timer: 2500
                        })
                        setTimeout(function() {
                            window.location.href = "<?= base_url() ?>index.php/Main_/loginPage";
                        }, 3500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed!',
                            text: 'Please check with the admin',
                            timer: 2500
                        })
                    }
                }
            });
        });
    </script>
</body>

</html>