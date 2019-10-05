
    <link rel='stylesheet' href='<?php echo URL; ?>views/plant_manage/colorselect/spectrum.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link href="<?php echo URL; ?>views/plant_manage/dist/bootstrap-colorselector.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/plant_manage/css/docs.css" />
    <!-- +++++++++++++++++++++++ -->
  


 
   

   



    <!-- <link rel="stylesheet" href="theme/assets/css/shared/style.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <style>
    .dot {
        height: 25px;
        width: 25px;
        border-radius: 50%;
        display: inline-block;
    }

    .picker {
        border-radius: 5px;
        width: 40px;
        height: 40px;
        cursor: pointer;
        border: thin solid #eee;
    }

    /*Styling for errors on form*/
    .form_error span {
        width: 80%;
        height: 35px;
        margin: 3px 10%;
        font-size: 1.1em;
        color: #D83D5A;
    }

    .form_error input {
        border: 1px solid #D83D5A;
    }

    .buttonText {
        color: black;
    }
    
    </style>
   <link rel="stylesheet" href="<?php echo URL; ?>views/plant_manage/style.css">
                <div class="grid-item">
                        <h3>Plant Manangement</h3>
                        <button type="button" class="btn btn-primary btn-icon-text btn-add" data-target="#addplantmodal" data-toggle="modal">
                        <i class="icon-plus btn-icon-prepend" ></i>create plant</button>
                    </div>    
                    <div class="card">
                        <div class="card-body shadow">
                    

                        <table id="example"  class="table table-dark table-responsive"  id="tableplant" style="text-align: center; width:100%">
                                    <colgroup>
                                        <col width=13%>
                                        <col width=13%>
                                        <col width=13%>
                                        <col width=7%>
                                        <col width=7%>
                                        <col width=10%>
                                        <col width=10%>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold"> Species </th>
                                            <th class="font-weight-bold"> Genus </th>
                                            <th class="font-weight-bold"> Alias </th>
                                            <th class="font-weight-bold"> Color </th>
                                            <th class="font-weight-bold"> Icon </th>
                                            <th class="font-weight-bold"> Settng Detail </th>
                                            <th class="font-weight-bold"> Manage </th>
                                        </tr>
                                    </thead>
                                    <tbody class = "fetch-data">
                                      

                                    </tbody>

                                </table>
                            
                        </div>
                    </div>
             

   

           

<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    

    <script src='<?php echo URL; ?>views/plant_manage/colorselect/spectrum.js'></script>

    <script type="text/javascript" src="<?php echo URL; ?>views/plant_manage/addphoto/bootstrap-filestyle.min.js"> </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>


    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>views/plant_manage/dist/bootstrap-colorselector.min.js"></script>

    <!-- table -->

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
     $('#example').DataTable();
let t = "";

// $(document).ready(function() {
//     addColor()
//     console.log(t);
//     // $(".addplant").click(function(){
//     //     alert($("#colorselector_1").attr("name"));


//     // })
// })
</script>
<script>
/*$(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip({
        boundary: 'window',
        trigger: 'hover'
    });
});*/
</script>
<script>
let base_url = "<?php echo URL; ?>";
$(document).ready(function(){
    // addColor();
    loaddata();
   function loaddata() {
     $('#example').DataTable().destroy();
         var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                 console.log("data ="+ data);
                 let text = ""
                 for(i in data){
                     text+=` <tr>
                                            <td>${data[i].p_species} </td>
                                            <td>${data[i].p_genus} </td>
                                            <td>${data[i].p_alias}  </td>
                                            <!-- <input type="hidden" name="p_id" id="p_id1"
                                                        value="${data[i].p_id} "> -->
                                                        <td>
                                                <span class="dot"
                                                    style="background-color:${data[i].code_color} "></span>
                                            </td>
                                            <td>
                                                <img src="<?php echo URL; ?>views/plant_manage/tomato/${data[i].p_icon}"
                                                    style="width: 40px; height: 40px;">
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-square btn-sm active" title="Passport"
                                                    data-toggle="tooltip">
                                                    <b>P
                                                </a>
                                                <a class="btn btn-danger btn-square btn-sm active" title="Charactor"
                                                    data-toggle="tooltip">
                                                    <b>C
                                                </a>
                                                <a class="btn btn-warning btn-square btn-sm active" title="DNA"
                                                    data-toggle="tooltip">
                                                    <b>D
                                                </a>
                                            </td>
                                            <td>

                                                <button class="btn btn-outline-warning btn-fw edit_plant" style="min-width: 100px;"
                                                    data-target="#editplantmodal" data-toggle="modal"
                                                   id=${data[i].p_id}
                                                    d-id="${data[i].p_id}"
                                                    d-species="${data[i].p_species}"
                                                    d-genus="${data[i].p_genus}"
                                                    d-alias="${data[i].p_alias}"
                                                    d-color="${data[i].p_color}"
                                                    d-icon="${data[i].p_icon}"
                                                    d-description="${data[i].p_description}">edit
                                                </button>
                                                <!-- delete_1(${data[i].p_species}) -->
                                                <button class="btn btn-outline-danger btn-fw" style="min-width: 100px;"
                                                    onclick="delfunction('${data[i].p_alias}' , '${data[i].p_id}')">
                                                    delete
                                                </button>
                                                <button class="btn btn-outline-info btn-fw" style="min-width: 100px;">
                                                    export
                                                </button>

                                            </td>
                                        </tr>`
 
                 }
                 $(".fetch-data").html(text);
                 $('#example').DataTable();
                 // $('#example').DataTable( {
                 //         "order": [[ 0, "asc" ]]
                 //     } );
 
             }
         };
         xhttp.open("POST", base_url+"plant_manage/loadData", true);
         xhttp.send();
   }
let p_id;
let p_species;
let p_genus;
let p_alias;
let p_color;
let p_icon;
let p_description;
$(".edit_plant").click(function() {
    //$(this).attr("data-toggle", "modal")
    // console.log('edit');
    p_id = $(this).attr("d-id");
    p_species = $(this).attr("d-species");
    p_genus = $(this).attr("d-genus");
    p_alias = $(this).attr("d-alias");
    p_color = $(this).attr("d-color");
    p_icon = $(this).attr("d-icon");
    p_description = $(this).attr("d-description");

    $("#p_id").val(p_id);
    $("#p_species").val(p_species);
    $("#p_genus").val(p_genus);
    $("#p_alias").val(p_alias);
    $("#p_color").val(p_color);
    $("#p_description").val(p_description);
    //$("#p_icon").val(p_icon);

    console.log(p_color);
 
   
    $("#colorselector2").colorselector("setValue", p_color);
    //$('#colorselector_2').val('p_color').prop('selected','selected');
    //$("option[data-color='#6495ED']").attr("selected","selected");
})
})

</script>
<script language="javascript">
function check1() {
    console.log('tt');
    if (document.form1.p_species.value == "" || document.form1.p_genus.value == "" || document.form1.p_alias.value ==
        "" || document.form1.p_color.value == "") {
        alert('Please complete the information.');
        document.form1.p_species.focus();
        return false;
    } else {
        return true;
    }

}

function check2() {
    console.log('tt');
    if (document.form2.p_species.value == "" || document.form2.p_genus.value == "" || document.form2.p_alias.value ==
        "" || document.form2.p_color.value == "") {
        alert('Please complete the information.');
        document.form2.p_species.focus();
        return false;
    } else {
        return true;
    }

}
</script>
<script>
// let t = "";

// $(document).ready(function() {
//     addColor()
//     console.log(t);
//     // $(".addplant").click(function(){
//     //     alert($("#colorselector_1").attr("name"));


//     // })
// })

function delete_1(_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = 'plant_manage.php';
        }
    };
    xhttp.open("POST", "process_del.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${_id}`);
}

function addColor() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            //   console.log(JSON.parse(JSON.stringify(this.responseText)));
            let text = "";
            for (index in data) {
                console.log(1);
                let value = data[index].p_color;
                let color = data[index].code_color;
                let title = "title";
                $('#colorselector2').append(`<option value=${value} data-color=${color}>pinto</option>`);
                
        }
        $('#colorselector2').colorselector();
   
               // $('#colorselector_2').colorselector(data[index].p_color,data[index].code_color,"title")
        
            }
            // for (index in data) {
            //     $('#colorselector_2').append($('<option>', {
            //         value: `${data[index].p_color}`,
            //         text: `${data[index].code_color}`
            //     }));
            // }
            // console.log(text);
            // $('#colorselector_2').append("<option>ssss</option>");




        
    };
    xhttp.open("POST", "datacolor.php", true);
    xhttp.send();

}


function delfunction(_alias, _id) {

    swal({
            title: "Do you want to delete",
            text: `${_alias} ?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            cancelButtonClass: "btn-secondary",
            confirmButtonText: "confirm",
            cancelButtonText: "cancel",
            closeOnConfirm: false,
            closeOnCancel: function() {
                $('[data-toggle=tooltip]').tooltip({
                    boundary: 'window',
                    trigger: 'hover'
                });
                return true;
            }
        },
        function(isConfirm) {
            if (isConfirm) {

                swal({

                    title: "delete success",
                    type: "success",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ok",
                    closeOnConfirm: false,

                }, function(isConfirm) {
                    if (isConfirm) {
                        delete_1(_id)
                    }

                });
            } else {

            }
        });

}
</script>
<script>
$(function() {

    window.prettyPrint && prettyPrint();

    $('#colorselector_1').colorselector();
    $('#colorselector_2').colorselector({
        callback: function(value, color, title) {
            $("#colorValue").val(value);
            $("#colorColor").val(color);
            $("#colorTitle").val(title);
        }
    });

    $("#setColor").click(function(e) {
        $("#colorselector_2").colorselector("setColor", "#008B8B");
    })

    $("#setValue").click(function(e) {
        $("#colorselector_2").colorselector("setValue", 18);
    })

});
</script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36251023-1']);
_gaq.push(['_setDomainName', 'jqueryscript.net']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
        '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
});

</script>