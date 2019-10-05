
  <style>
     .form-control
    {
      height: 44px;
      border: 1px solid #ccc;
    }
    .auth.register-bg-1 {
    background: url(../pic/bg.jpg);
    background-size: cover;
}

  </style>
  <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-6 mx-auto">
              <h2 class="text-center mb-4">Register</h2>
              <div class="auto-form-wrapper">

                <form action='<?php echo URL ?>login/register_insert' method="post">
                  <div class="form-group row">
  
                      <label for="name" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                      <input id="name" name="name" type="text" class="form-control" placeholder="Enter your name">
                      </div>
                      
                    
                  </div>
                  <div class="form-group row">
                      <label for="surname" class="col-sm-3 col-form-label">Surname</label>
                      <div class="col-sm-9">
                      <input id="surname" name="surname" type="text" class="form-control" placeholder="Enter your surname">
                      </div>    
                  </div>
                  <div class="form-group row">
                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                      <div class="input-group">
                      <input id="email" name="email" type="text" class="form-control" placeholder="example@email.co.th">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-email"></i>
                        </span>
                      </div>
                    </div>
                      </div>   
                    
                  </div>
                  <div class="form-group row">
                      <label for="username" class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                      <input id="username" name="username" type="username" class="form-control" placeholder="Enter Username">
                      </div>   
                    
                  </div>
                  <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                      <div class="input-group">
                      <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-key"></i>
                        </span>
                      </div>
                    </div>
                      </div>   
                    
                  </div>
                  <div class="form-group row">
                      <label for="cf_password" class="col-sm-3 col-form-label">Confirm Password</label>
                      <div class="col-sm-9">
                      <div class="input-group">
                      <input id="cf_password" name="cf_password" type="password" class="form-control" placeholder="Confirm Password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-key"></i>
                        </span>
                      </div>
                    </div>
                      </div> 
                  </div>
                  <div class="form-group d-flex justify-content-center">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> I agree to the terms </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Already have and account ?</span>
                    <a href="<?php echo URL.'login' ?>" class="text-black text-small">Login</a>
                  </div>
                </form>


              </div>

              </div>
              </div>
              </div>
              </div>
              </div>

