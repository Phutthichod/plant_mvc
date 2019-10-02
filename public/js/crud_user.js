                 $('#example').DataTable({
                  responsive: true,
                  "ordering": true
                 });
                 
                 $(".btn-update").click(function(){
                 
                var id =   $("#edit_id").val();
                var firstname =   $("#edit_firstname").val();
                var lastname =  $("#edit_lastname").val();
                var email =   $("#edit_email").val();
                var permission = $("#edit_permission").val();
                var status =  $("#edit_status").val();
                    
              $.ajax({
                url: base_url+"/user_manage/edit",
                    type: "POST",
                    data: { id: id,
                      firstname: firstname,
                      lastname: lastname,
                      email: email,
                      permission: permission,
                      status: status},
                    success: function(data) {                     
                      if(data)
                      {
                        $("#"+id).empty();
                        $("#"+id).append(`<td>`+firstname+`</td>
                        <td>`+lastname+`</td>
                        <td>`+email+`</td>`);
                        if(permission == 'member')
                        $("#"+id).append(`<td>user</td>`);
                        else
                        $("#"+id).append(`<td>`+permission+`</td>`);
                        if(status =='Active')
                        $("#"+id).append("<td><center> <span class='badge badge-success badge'>Active</span> </center>  </td>");
                        else if(status =='Blocked')
                        $("#"+id).append("<td><center><span class='badge badge-danger badge'>Blocked</span></center></td>");
                        else if(status =='Waiting')
                        $("#"+id).append("<td><center><span class='badge badge-warning badge'>Waiting</span></center></td>");
                        $("#"+id).append(`<td><center><button type="button" class='btn-edit btn btn-outline-warning' data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`">Edit</button>
                        <span style="padding-left:10px;"></span><button type='button' class='btn-delete btn btn-outline-danger' data-id ="`+id+`" data-firstname="`+firstname+`">Delete</button></center></td>`);
                        if(status =='Blocked')
                        {
                          $("#"+id).append(`<td><center> <button type="button" data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-google btn_lock">
                            <i class="fa fa-lock"></i>
                          </button>
                          </center></td>`);
                        }
                        else
                        {
                          $("#"+id).append(` <td><center> <button type="button" data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-social-outline-google btn_lock">
                            <i class="fa fa-unlock"></i>
                          </button>
                          </center> </td>`);
                      
                        }
                        swal({
                          text:'Edit User Success',
                          icon: 'success',
                          timer: 1500,
                          button: false
                        });
                      }
                      else
                      {
                        swal({
                          text:'Edit User Fail',
                          icon: 'error',
                          timer: 1500,
                          button: false
                        });
                      }
                       //console.log(data);       
                    },
                    error: function(data){
                        console.log("error");
                        //console.log(data);
                        swal({
                          text:'Edit User Fail',
                          icon: 'error',
                          timer: 1500,
                          button: false
                        });
                    }
              });
              $("#static_modal").modal('hide');
              
            });

            $("#example").on('click','.btn-edit',function() {
                          var id =$(this).attr("data-id");
                          var firstname =  $(this).attr("data-firstname");
                          var lastname =  $(this).attr("data-lastname");
                          var email =  $(this).attr("data-email");
                          var permission =  $(this).attr("data-permission");
                          var status =  $(this).attr("data-status");
                          $("#edit_id").val(id);
                          $("#edit_firstname").val(firstname);
                          $("#edit_lastname").val(lastname);
                          $("#edit_email").val(email);
                          $("#edit_permission").val(permission);
                          $("#edit_status").val(status);
                          $("#static_modal").modal('show');
                 }); 

                $("#example").on('click','.btn-delete',function() {
                          var id =$(this).attr("data-id");
                          var firstname =  $(this).attr("data-firstname");
                          swal({
                text:'Do you want to delete '+firstname+' ?',
                icon: 'error',
                buttons: {
                  confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                  },
                  cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-default",
                    closeModal: true,
                  }
                 
                }
              }).then(function(z) {
                if(z)
                {
                        $.ajax({
                        url: base_url+"/user_manage/delete",
                            method: "POST",
                            data: { id: id},
                            success: function(data) {
                              if(data)
                              {
                                $("#"+id).remove();
                                swal({
                                  text:'Delete User Success',
                                  icon: 'success',
                                  timer: 1500,
                                  button: false
                                });
                              }
                              else
                              {
                                swal({
                                  text:'Delete User Fail',
                                  icon: 'error',
                                  timer: 1500,
                                  button: false
                                });
                              }
                                //console.log(data);
                            },
                            error: function(data){
                                console.log("error");
                                //console.log(data);
                                swal({
                                  text:'Delete User Fail',
                                  icon: 'error',
                                  timer: 1500,
                                  button: false
                                });
                            }
                          });
                }
                });
            });
          
            
         
            $("#example").on('click','.btn_lock',function(){
                          var id =$(this).attr("data-id");
                          var firstname =  $(this).attr("data-firstname");
                          var lastname =  $(this).attr("data-lastname");
                          var email =  $(this).attr("data-email");
                          var permission =  $(this).attr("data-permission");
                          var status =  $(this).attr("data-status");
              if(status == 'Blocked')
              {
                swal({
                text:'Do you want to unblock '+firstname+' ?',
                icon: 'warning',
                buttons: {
                  confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-warning",
                    closeModal: true
                  },
                  cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-default",
                    closeModal: true,
                  }
                 
                }
              }).then(function(z) {
                if(z)
                {
                  status = "Active";
                        $.ajax({
                      url: base_url+"/user_manage/change_status_block",
                          method: "POST",
                          data: { id: id,
                            status: status},
                          success: function(data) {
                            if(data)
                              {
                              $("#"+id).empty();
                              $("#"+id).append(`<td>`+firstname+`</td>
                              <td>`+lastname+`</td>
                              <td>`+email+`</td>`);
                              if(permission == 'member')
                              $("#"+id).append(`<td>user</td>`);
                              else
                              $("#"+id).append(`<td>`+permission+`</td>`);
                              if(status =='Active')
                              $("#"+id).append("<td><center> <span class='badge badge-success badge'>Active</span> </center>  </td>");
                              else if(status =='Blocked')
                              $("#"+id).append("<td><center><span class='badge badge-danger badge'>Blocked</span></center></td>");
                              else if(status =='Waiting')
                              $("#"+id).append("<td><center><span class='badge badge-warning badge'>Waiting</span></center></td>");
                              $("#"+id).append(`<td><center><button type="button" class='btn-edit btn btn-outline-warning' data-id="`+id+`" data-firstname="`+firstname+`"
                              data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`">Edit</button>
                              <span style="padding-left:10px;"></span><button type='button' class='btn-delete btn btn-outline-danger' data-id ="`+id+`" data-firstname="`+firstname+`">Delete</button></center></td>`);
                              if(status =='Blocked')
                              {
                                $("#"+id).append(`<td><center> <button type="button" data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-google btn_lock">
                                  <i class="fa fa-lock"></i>
                                </button>
                                </center></td>`);
                              }
                              else
                              {
                                $("#"+id).append(` <td><center> <button type="button" data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-social-outline-google btn_lock">
                                  <i class="fa fa-unlock"></i>
                                </button>
                                </center> </td>`);
                            
                              }
                              swal({
                                text:'UnBlock User Success',
                                icon: 'success',
                                timer: 1500,
                                button: false
                              });
                            }
                            else
                            {
                              swal({
                                text:'UnBlock User Fail',
                                icon: 'error',
                                timer: 1500,
                                button: false
                              });
                            }
                              //console.log(data);
                          },
                          error: function(data){
                              console.log("error");
                              //console.log(data);
                              swal({
                                text:'UnBlock User Fail',
                                icon: 'error',
                                timer: 1500,
                                button: false
                              });
                          }
                    });
                }
                      });

              }
              else
              {
                swal({
                text:'Do you want to block '+firstname+' ?',
                icon: 'error',
                buttons: {
                  confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                  },
                  cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-default",
                    closeModal: true,
                  }
                 
                }
              }).then(function(z) {
                if(z)
                {
                  status = "Blocked";
                        $.ajax({
                      url: base_url+"/user_manage/change_status_block",
                          method: "POST",
                          data: { id: id,
                            status: status},
                          success: function(data) {
                            if(data)
                              {
                              $("#"+id).empty();
                              $("#"+id).append(`<td>`+firstname+`</td>
                              <td>`+lastname+`</td>
                              <td>`+email+`</td>`);
                              if(permission == 'member')
                              $("#"+id).append(`<td>user</td>`);
                              else
                              $("#"+id).append(`<td>`+permission+`</td>`);
                              if(status =='Active')
                              $("#"+id).append("<td><center> <span class='badge badge-success badge'>Active</span> </center>  </td>");
                              else if(status =='Blocked')
                              $("#"+id).append("<td><center><span class='badge badge-danger badge'>Blocked</span></center></td>");
                              else if(status =='Waiting')
                              $("#"+id).append("<td><center><span class='badge badge-warning badge'>Waiting</span></center></td>");
                              $("#"+id).append(`<td><center><button type="button" class='btn-edit btn btn-outline-warning' data-id="`+id+`" data-firstname="`+firstname+`"
                              data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`">Edit</button>
                              <span style="padding-left:10px;"></span><button type='button' class='btn-delete btn btn-outline-danger' data-id ="`+id+`" data-firstname="`+firstname+`">Delete</button></center></td>`);
                              if(status =='Blocked')
                              {
                                $("#"+id).append(`<td><center> <button type="button" data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-google btn_lock">
                                  <i class="fa fa-lock"></i>
                                </button>
                                </center></td>`);
                              }
                              else
                              {
                                $("#"+id).append(` <td><center> <button type="button" data-id="`+id+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-social-outline-google btn_lock">
                                  <i class="fa fa-unlock"></i>
                                </button>
                                </center> </td>`);
                            
                              }
                              swal({
                                text:'Block User Success',
                                icon: 'success',
                                timer: 1500,
                                button: false
                              });
                            }
                            else
                            {
                              swal({
                                text:'Block User Fail',
                                icon: 'error',
                                timer: 1500,
                                button: false
                              });
                            }
                           
                              //console.log(data);
                          },
                          error: function(data){
                              console.log("error");
                              //console.log(data);
                              swal({
                                text:'Block User Fail',
                                icon: 'error',
                                timer: 1500,
                                button: false
                              });
                          }
                    });
                }
                      });
              }
              

            });
           
            $(".btn-create").click(function(){
              $("#create_member").modal("show");
            });
            $(".btn-create-member").click(function(){
              var username =   $("#create_username").val();
              var password =   $("#create_password").val();
                var firstname =   $("#create_firstname").val();
                var lastname =  $("#create_lastname").val();
                var email =   $("#create_email").val();
                var permission = $("#create_permission").val();
                var status =  $("#create_status").val();
                $.ajax({
                url: base_url+"/user_manage/create",
                    method: "POST",
                    data: {
                      username: username,
                      password: password,
                      firstname: firstname,
                      lastname: lastname,
                      email: email,
                      permission: permission,
                      status: status},
                    success: function(data) {
                      if(data)
                      {
                        $("#tbody_start").prepend(`<tr id="`+data+`"><td>`+firstname+`</td>
                        <td>`+lastname+`</td>
                        <td>`+email+`</td></tr>`);
                        if(permission == 'member')
                        $("#"+data).append(`<td>user</td>`);
                        else
                        $("#"+data).append(`<td>`+permission+`</td>`);
                        if(status =='Active')
                        $("#"+data).append("<td><center> <span class='badge badge-success badge'>Active</span> </center>  </td>");
                        else if(status =='Blocked')
                        $("#"+data).append("<td><center><span class='badge badge-danger badge'>Blocked</span></center></td>");
                        else if(status =='Waiting')
                        $("#"+data).append("<td><center><span class='badge badge-warning badge'>Waiting</span></center></td>");
                        $("#"+data).append(`<td><center><button type="button" class='btn-edit btn btn-outline-warning' data-id="`+data+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`">Edit</button>
                        <span style="padding-left:10px;"></span><button type='button' class='btn-delete btn btn-outline-danger' data-id ="`+data+`" data-firstname="`+firstname+`">Delete</button></center></td>`);
                        if(status =='Blocked')
                        {
                          $("#"+data).append(`<td><center> <button type="button" data-id="`+data+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-google btn_lock">
                            <i class="fa fa-lock"></i>
                          </button>
                          </center></td>`);
                        }
                        else
                        {
                          $("#"+data).append(` <td><center> <button type="button" data-id="`+data+`" data-firstname="`+firstname+`"
                        data-lastname="`+lastname+`" data-email="`+email+`" data-permission="`+permission+`"  data-status="`+status+`" class="btn social-btn btn-social-outline-google btn_lock">
                            <i class="fa fa-unlock"></i>
                          </button>
                          </center> </td>`);
                      
                        }
                        swal({
                          text:'Create User Success',
                          icon: 'success',
                          timer: 1500,
                          button: false
                        });
                      }
                      else
                      {
                        swal({
                          text:'Create User Fail',
                          icon: 'error',
                          timer: 1500,
                          button: false
                        });
                      }
                      
                      //console.log(data);
                    },
                    error: function(data){
                        console.log("error");
                        //console.log(data);
                        swal({
                          text:'Create User Fail',
                          icon: 'error',
                          timer: 1500,
                          button: false
                        });
                    }
              });
             $("#create_username").val('');
             $("#create_password").val('');
              $("#create_firstname").val('');
             $("#create_lastname").val('');
             $("#create_email").val('');
              $("#create_member").modal('hide');
            });

            
     
     