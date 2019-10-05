<link rel="stylesheet" href="<?php echo URL ?>views/user_manage/style.css">
        <h3>User Manangement</h3>
          <div class="card shadow">
            <div class="card-body">
              

<table id="example" class="table table-responsive table-dark " style="width:100%">

                    <thead>

                      <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Sername</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Permission</th>
                        <th scope='col'>able plant</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Edit</th>
                        <th scope='col'>Block</th>
                      </tr>

                    </thead>

                    <tbody class="fetch-data">
                  
                     

                    </tbody>
                  </table>
               

            

             

            </div>
          </div>


          <!------------------------ edit_modal------------------------------------>
          <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Firstname</label>
                        <input type="text" class="form-control" id="InputFirstname" placeholder="Firstname">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Surname</label>
                        <input type="text" class="form-control" id="InputSurname" placeholder="Surname">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="Email">
                      </div>
                      <label for="">permission</label></label>
                      
                      <select id='permission' class="js-example-basic-single" style="width:100%">
                        <option value="member">member</option>
                        <option value="admin">admin</option>
                        <option value="expert">expert</option>
                      </select><br><br>
                      <label for="">status</label></label>
                      <span class="" style="width: 100%;">
                      
                      <select id='status' class="js-example-basic-single s2" style="width:100%">
                        <option value="Active">Active</option>
                        <option value="Waiting">Wait</option>
                        <option value="Blocked">Block</option>
                      </select>
                    </form>
                <div class="modal-footer"style="padding-right:0;">
                  <button type="button" class="btn btn-primary btn-submit-update" data-dismiss="modal">OK</button>
                  <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal">Cancle</button>
                </div>
              </div>
            </div>
          </div>

          <!------------------------ edit_modal------------------------------------>







      
 




</html>
<!-- <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
let base_url = "<?php echo URL; ?>";
  $(document).ready(function() {
    let data;
    let user_id;
    let name;
    let surname;
    let email;
    let permission;
    let status;
      //  $(document).on('click','.btn-outline-danger',function(){
      //     delClick();
      //   })
      $(document).on('click','.btn-block',function(){
  let id = $(this).attr('data-id');
  let status = $(this).attr('data-status');
  if(status!='Blocked'){
    status = 'Blocked';
  }
  else{
    status = 'Active';
  }

      delClick(id,status);
 
  
})
function editBlock(id,status){
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(JSON.parse(this.responseText));
            loaddata()
        }
    };
    xhttp.open("POST", "edit_block.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${id}&status=${status}`);
}
  
        function delClick(id,status){
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              editBlock(id,status);
              swal("data has been deleted!", {
                icon: "success",
                
              });
            } else {
              swal("Your data is safe!");
            }
});
        }
        $('.btn-submit-update').click(function(){
          // var xhttp = new XMLHttpRequest();
          //   xhttp.onreadystatechange = function() {
          //   if (this.readyState == 4 && this.status == 200) {
          //     console.log()
          //     // loaddata();

          //     }
          //   }
          //   xhttp.open("POST", "update.php", true);
          //   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          //   xhttp.send(`firstname=${name}&lastname=${surname}&email=${email}&permission=${permission}&status=${status}&id=${user_id}`);
          var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(JSON.parse(this.responseText));
            loaddata()
        }
    };
    xhttp.open("POST", "update.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`firstname=${$("#InputFirstname").val()}&lastname=${$("#InputSurname").val()}&email=${$("#InputEmail").val()}&permission=${$('#permission').val()}&status=${$('#status').val()}&id=${user_id}`);
        })
        $(document).on('click',".btn-edit",function() {
          let index = $(this).attr('id');
          user_id = data[index].user_id;
          name = data[index].firstname;
          surname = data[index].lastname;
          email = data[index].email;
          permission = data[index].permission;
          status = data[index].status;

          $("#InputFirstname").val(name);
          $("#InputSurname").val(surname);
          $("#InputEmail").val(email);
          $("#e_email").val(email);
          console.log(index);


          $('#permission').val(data[index].permission);
          $('#permission').trigger('change');
          $('#status').val(data[index].status);
          $('#status').trigger('change');
        })
        
    
    $('#example').dataTable( {
    "order": [0,'asc']
} );
    loaddata();
   
  function loaddata() {
    // $('#example').DataTable().destroy();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               let data = JSON.parse(this.responseText);
                console.log(data);
                let color_status = '';
                let btn_color = '';
                let icon = '';
                let text = ""
                for(i in data){
                  btn_color = '';;
                  icon = 'icon-lock-open';
                  switch(data[i].status){
                    case 'Active':
                    color_status = 'badge-success';
                    break;
                    case 'Blocked':
                    color_status = 'badge-danger';
                    icon = 'icon-lock';
                    btn_color = 'btn-danger'
                    break;
                    case 'Waiting':
                    color_status = 'badge-warning';
                    break;
                    default : color_status = 'badge-warning';
                  }
                    text+=`<tr id = ${data[i].user_id}><td>${data[i].firstname}</td>
                          <td>${data[i].lastname}</td>
                          <td>${data[i].email}</td>
                          <td>${data[i].permission}</td>

                          <td><a class="link" href="#" data-id=${data[i].user_id}>${data[i].number}</a></td>

                        
                                 <td><center><span class='badge ${color_status} badge'>${data[i].status}</span></center></td>
                          <td>
                          <button type="button" id='${i}' class="btn btn-outline-warning btn-fw btn-edit" style="min-width: 100px;" data-toggle="modal" data-target="#edit_modal">edit</button>
                              <span style='padding-left:10px'></span>

                              <button type="button" class="btn btn-outline-danger btn-fw" style="min-width: 100px;">delete</button>
                          </td>

                            <td>
                            <center><button type="button"data-status=${data[i].status} data-id=${data[i].user_id} class="btn btn-outline-danger ${btn_color} btn-fw btn-block" style="min-width: 100px;"><i class='${icon} icon-b'></i></button> </center>
                            </td></tr>`

                }
                $(".fetch-data").html(text);
                $('#example').DataTable();
                // $('#example').DataTable( {
                //         "order": [[ 0, "asc" ]]
                //     } );

            }
        };
        xhttp.open("POST", base_url+"user_manage/loadData", true);
        xhttp.send();
  }
  function editBlock(id,status){
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(JSON.parse(this.responseText));
            loaddata()
        }
    };
    xhttp.open("POST",base_url+"user_manage/blockUser", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${id}&status=${status}`);
}
function delClick(id,status){
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              editBlock(id,status);
              swal("data has been deleted!", {
                icon: "success",
                
              });
            } else {
              swal("Your data is safe!");
            }
          })
          
}
$(document).on('click','.link',function(){
  sessionStorage.setItem("id", $(this).attr('data-id'));
  console.log($(this).attr('data-id'));
  location.href = base_url+"user_manage/listPlant";
})
  })
</script>