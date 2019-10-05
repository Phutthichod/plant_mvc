$(document).ready(function () {
    $(".forgot-password").click(function () {
          $("#md_forgot_password").modal('show');
    });
});
    // Check user in DB
$(document).ready(function() {
    $("#check_user").click(function() {
      let email = $("#email").val();
      let username = $("#username").val();
      $.ajax({
        url:  base_url+"/login/FP_checkUser",
        method: "POST",
        data: { emailAJ: email, usernameAJ: username },
        success: function(data) {
         
          if (data === false) {   
            swal({
              title: 'Account not found!',
              text: 'Close in 2 seconds.',
              icon: 'warning',
              timer: 2000,
              button: false
            }).then(
              function() {},
              // handling the promise rejection
              function(dismiss) {
                if (dismiss === 'timer') {
                  console.log('I was closed by the timer')
                }
              }
            )
          } 
          else {
            $("#username").prop("disabled", true);
            $("#email").prop("disabled", true);
            $("#check_user").prop("disabled", true);
            sendEmail(data);
          }
        },
        error: function(data) {
          alert("Error");
          console.log(data);
        }
      });
    });
  });
  
$(document).on("click", ".hid_pass1,.hid_pass2", function() {
    let x = document.getElementById("key_chang1");
    if ($(this).hasClass("mdi-eye-off")) {
      $(this).removeClass("mdi-eye-off");
      $(this).addClass("mdi-eye");
    } else {
      $(this).addClass("mdi-eye-off");
      $(this).removeClass("mdi-eye");
    }
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  });

  // check key reset password
$(document).on("click", "#check_key", function() {
    if (($("#key_pass").val() != "") & ($("#key_chang1").val() != "")) {
      let username = $("#username").val();
      let email = $("#email").val();
      let key_pass = $("#key_pass").val();
      $.ajax({
        url: base_url+"/login/FP_checkToken",
        method: "POST",
        data: { emailAJ: email, usernameAJ: username, keyAJ: key_pass },
        success: function(data) {
          let dataQre = data;
          if (dataQre === false) 
          {
            
             swalAlert('not_found','Key not found');
          } 
          else 
          {
            
            let dat_stamp = new Date(dataQre["time_forgetpass"]);
            let dat_current = new Date();
            if (
              dat_stamp.getDay() == dat_current.getDay() &&
              dat_stamp.getHours() == dat_current.getHours()
            ) {
              let min1 = dat_stamp.getMinutes();
              let min2 = dat_current.getMinutes();
              if (min2 - min1 >= 3) {
                //alert("เกิน5นาที หมดอายุ");
                swalAlert('not_found','Expired key');
              } else {
               
                update_pass(data);
              }
            } else {
              swalAlert('not_found','Expired key');
            }
          }
        },
        error: function() {
          //alert("error database");
        }
      });
    } else {
      alert("pleass fill in data");
    }
});
function swalAlert(type,title){
    if (type === 'not_found'){
      swal({
        title: title,
        text: 'Close in 2 seconds.',
        icon: 'warning',
        timer: 2000,
        button: false
      }).then(
        function() {},
        // handling the promise rejection
        function(dismiss) {
          if (dismiss === 'timer') {
            console.log('I was closed by the timer')
          }
        }
      )
    }
    else if (type === 'success') {
      swal({
        title: title,
        text: '',
        icon: 'success',
        button: {
          text: "Continue",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    }
}
function update_pass(data_qurey) {
    let data = data_qurey;
    let email = data.email;
    let username = data.username;
    let pass = $("#key_chang1").val();
    $.ajax({
      url: base_url+"/login/FP_updatPassword",
      method: "POST",
      data: { emailAJ: email, usernameAJ: username, passAJ: pass },
      success: function(data) {
        swalAlert('success','Success');
        //console.log(data);
        $("#md_forgot_password").modal('hide');
      },
      error: function() {
        swalAlert('not_found','error');
      }
    });
}
function sendEmail(data_qurey) {
    let data = data_qurey;
    let email = data.email;
    let username = data.username;
    $.ajax({
      url: base_url+"/login/FP_sentMail",
      method: "POST",
      data: { emailAJ: email, usernameAJ: username ,base_url :base_url},
      success: function(data) {
        $(".sentEmail").empty();
        $("#have_key").append(
                  '\
                  <div class="form-group"  style=" text-align: left;">\
                  <label for="key" >Key reset form mail</label>\
                  <div class="input-group">\
                      <span class="input-group-text">\
                        <i class="mdi mdi-key"></i>\
                      </span>\
                    <input id="key_pass" class="form-control" name="key" type="text" placeholder="Key"> </div> \
                  </div>\
                </div>\
\
                  <div class="form-group"  style=" text-align: left;">\
                  <label for="password" >Password</label>\
                  <div class="input-group">\
                    <span class="input-group-text">\
                      <i id = "hid_pass1" class="mdi mdi-eye-off hid_pass1"></i>\
                    </span>\
                    <input id="key_chang1" class="form-control" name="password" type="password" placeholder="New Password"> </div> \
                  </div>\
                </div>\
                  <button type="submit" id="check_key" class="btn btn-primary submit-btn btn-block" >Confirm</button>'
        );
      },
      error: function(data) {
        console.log("error_sentMail");
        console.log(data);
      }
    });
}