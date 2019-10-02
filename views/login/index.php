<!DOCTYPE html>
<html lang="en">
  <style>
    .form-control
    {
      height: 44px;
    }
    .auth.auth-bg-1 {
    background: url(pic/bg.jpg);
    background-size: cover;
    }
    .swal-title {
      /* margin: 0px; */
      font-size: 25px;
      /* box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.21); */
      color : red;
    }
    label.text-left {
      text-align: left;
    }
  </style>
 <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">
                

                <form  method="post" id="login" action="login/check_login">
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" name="username" class="form-control" placeholder="Username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="fa fa-user"></i>
                        </span>
                      </div>
                    </div>
            
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="*********">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-key"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>

                  <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
                    </div>
                    <!-- <a href='@Url.Action("Edit", "Student", 
                            new { id = item.DealPostID })'>Hello          </a> -->
                    <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Not a member ?</span>
                    <a href='<?php echo URL ?>login/register' class="text-black text-small">Create new account</a>
                  </div>
                </form>


              </div>
              <ul class="auth-footer">
               
              </ul>
              <p class="footer-text text-center"></p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


     <!-- modal start -->
     <div id="md_forgot_password" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="width:100% ">
                                <div class="modal-body">
                                <form class="cmxform" id="signupForm" method="get" action="#" novalidate="novalidate">
                                <fieldset>
                                    <div class="row">
                                    <div class="col-lg-6 mx-auto">
                                            <h2 class="text-center mb-4">Forgot Password</h2>
                                            <div class="auto-form-wrapper">
                                            
                                              <div class="form-group">
                                                <label for="cname">Name (required, at least 2 characters)</label>
                                                <div class="input-group"> 
                                                  <span class="input-group-text">
                                                      <i class="fa fa-user"></i>
                                                  </span>
                                                  <input id="username" class="form-control" name="username" minlength="2" type="text" required="" placeholder="Username">
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                  <span class="input-group-text">
                                                    <i class="mdi mdi-email"></i>
                                                  </span>
                                                  <input id="email" class="form-control" name="email" type="email" placeholder="Mail"> </div> 
                                                </div>
                                              </div>


                                              <div class="form-group sentEmail">
                                                <button
                                                  type="submit"
                                                  id="check_user"
                                                  class="btn btn-primary submit-btn btn-block"
                                                >
                                                  Send to mail
                                                </button>
                                              </div>
                                              <div class="text-block text-center my-3">
                                                <span class="text-small font-weight-semibold"></span>
                                                <div id="have_key"></div>
                                                <!-- <button  type="button" id="have_key">Click Me!</button> -->
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                              </fieldset>
                              </form>

                            </div>
                        </div>
                    </div>
      <!-- modal End -->
  </body>

</html>
<script>
             var base_url = "<?php echo URL; ?>";
</script>
<script src="<?php echo URL ?>theme/assets/js/shared/alerts.js"></script>
<script src="<?php echo URL ?>theme/assets/js/shared/avgrund.js"></script>
<script src="<?php echo URL ?>theme/assets/js/shared/form-validation.js"></script>
<script src="<?php echo URL ?>theme/assets/js/shared/bt-maxLength.js"></script>
<script src="<?php echo URL ?>public/js/forgot_login.js"></script>

