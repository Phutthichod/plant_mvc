<link rel="stylesheet" href="<?php echo URL; ?>/views/user_plant/grid_item.css">

                <div class="grid_item">


                </div>

<div class="modal fade" id="myModal" role="dialog"  >
    <div class="modal-dialog" >

        <!-- Modal content *** style="background-color: #181824" -->
        <div class="modal-content"  >
            <div class="modal-header">
                <h3 class="modal-title">Option</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="card link"  link=1 style="width:445px" >
                    <div class="card-body" >
                        <div class="preview">
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="icon-drop"  style="color:blue; "></i></button>
                            <!-- <p>123</p> -->
                            <i   ></i>CHARACTER</div>
                    </div>
                </div>
                <br>


                <div class="card link" link=2  style="width:445px">
                    <div class="card-body">
                        <div class="preview">
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" >
                                <i class="icon-hourglass" style="color:green;"></i></button>
                            <i ></i>LOCATION</div>
                    </div>
                </div>
                <br>


                <div class="card link"  link=3 style="width:445px">
                    <div class="card-body">
                        <div class="preview">
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="icon-location-pin"  style="color:red;"></i></button>
                            <i   type="text"value="  "></i>GENOME</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
let base_url = "<?php echo URL; ?>";
    loaddata();
    function loaddata() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               let data = JSON.parse(this.responseText);
                // console.log(this.responseText);
                let text = ""
                for (i in data) {
                    text += ` <div class="card">
              <img data-toggle="modal" data-target="#myModal" plant_id=${data[i].p_id}  src= "${base_url}views/user_plant/tomato/${data[i].p_icon}">
              <div class="text-bottommiddle">${data[i].p_alias}</div>
            </div> `
                }
                $(".grid_item").append(text);
             }
            
        };
        xhttp.open("POST",base_url+"user_plant/loadData", true);
        xhttp.send();
    }
</script>

<script>
    $(document).on({
        mouseenter: function() {
            //stuff to do on mouse enter
            $(this).addClass("shadow-image");
        },
        mouseleave: function() {
            //stuff to do on mouse leave
            $(this).removeClass("shadow-image");
        }
    }, "img");
    // $(document).onClick({
    //   $('#myModal').modal('show');
    // })

    $(document).on('click','img',function(){
        let p_id = $(this).attr("plant_id");
        console.log(p_id);
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // window.location.href = './plant_manage.php';
                console.log(this.responseText);
            }
        };
        xhttp.open("POST", base_url+"user_plant/setPlant_id", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`p_id=${p_id}`);

    })
    $('.link').click(function(){
        let link = $(this).attr('link');
        console.log(link);
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = base_url+"upload_history/";
                console.log(this.responseText);
            }
        };
        xhttp.open("POST", base_url+"user_plant/setPlant_type", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`p_type=${link}`);
        

    })
</script>
