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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
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
                                                        <label for="name">Name</label>
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
            $("#createAccount").unbind("click").click(function(){
                if ($("#username").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input username.',
                      timer: 5000
                    })
                    $("#username").focus();
                    return;
                }

                if ($("#name").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input name.',
                      timer: 1500
                    })
                    $("#name").focus();
                    return;
                }

                if ($("#email").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input email.',
                      timer: 1500
                    })
                    $("#email").focus();
                    return;
                }

                if ($("#mobile").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input mobile.',
                      timer: 1500
                    })
                    $("#mobile").focus();
                    return;
                }

                if ($("#contribution").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input contribution.',
                      timer: 1500
                    })
                    $("#contribution").focus();
                    return;
                }

                if ($("#address").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input address.',
                      timer: 1500
                    })
                    $("#address").focus();
                    return;
                }

                if ($("#confirm_pass").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input confirm password.',
                      timer: 1500
                    })
                    $("#confirm_pass").focus();
                    return;
                }

                if ($("#password").val() != $("#confirm_pass").val()) {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: "Password don't match!",
                      timer: 1500
                    })
                    $("#password").val("");
                    $("#confirm_pass").val("");
                    $("#password").focus();
                    return;
                }

                var formdata = $("#registration").serialize();
                
                $.ajax({
                    url : "<?=site_url("Main_/registerUser")?>",
                    type : "POST",
                    data : formdata,
                    success : function(response){
                        
                        if(response.trim() == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Registration Success!',
                                text: 'We will redirect you to registration',
                                timer: 2500
                            })
                            setTimeout(function() {
                                window.location.href = "<?= base_url() ?>index.php/Main_/loginPage";
                            }, 3500);
                        }else{
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
