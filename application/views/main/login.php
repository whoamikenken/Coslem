<?php 
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
); 
?>
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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">LOGIN</h3></div>
                                    <div class="card-body">
                                        <form id="loginForm">
                                            <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="" />
                                                <label for="#username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button class="btn btn-primary" id="login" type="button">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="<?= base_url(); ?>index.php/Main_/signUpPage">Need an account? Sign up!</a></div>
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
                            <div class="text-muted">Copyright &copy; COMSLEM 2021</div>
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
        <script src="<?= base_url(); ?>js/scripts.js"></script>
        <script type="text/javascript">
            $("#login").unbind("click").click(function(){
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

                if ($("#password").val() == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Please input password.',
                      timer: 1500
                    })
                    $("#password").focus();
                    return;
                }

                var formdata = $("#loginForm").serialize();

                $.ajax({
                    url: "<?php echo site_url("Main_/sendSecurityCode")?>",
                    data: {username: $("#username").val()},
                    type: "POST",
                    success: function(res) {
                      Swal.fire({
                          title: 'Security Code',
                          html: '<span id="verificator">Please input the code sent to your number</span>',
                          input: 'text',
                          inputAttributes: {
                            autocapitalize: 'off'
                          },
                          showCancelButton: true,
                          confirmButtonText: 'Verify',
                          showLoaderOnConfirm: true,
                          preConfirm: (login) => {
                            console.log(login)
                            if(login == res){
                                $.ajax({
                                    url : "<?=site_url("Main_/validateLogin")?>",
                                    type : "POST",
                                    data : formdata,
                                    success : function(response){
                                        
                                        if(response.trim() == "success"){
                                             window.location.href = "<?= base_url() ?>";
                                        }else if(response.trim() == "failed"){
                                            Swal.fire({
                                              icon: 'error',
                                              title: 'Login Failed!',
                                              text: 'Please check password and username.',
                                              timer: 2500
                                            })
                                        }else if(response.trim() == "Unverified"){
                                          Swal.fire({
                                            icon: 'error',
                                            title: 'Login Failed!',
                                            text: 'Your Account is not yet verified.',
                                            timer: 2500
                                          })
                                      }
                                    }
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Wrong OTP!',
                                    text: '',
                                    timer: 2500
                                  })
                            }
                                
                            return false;
                          },
                          allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            console.log(result)
                        })
                        
                    }
                });
            });
        </script>
    </body>
</html>
