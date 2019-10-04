<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo URL ?>views/user_manage/drag_drop.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="grid-item-select">
    <div class="card">
        <!-- <div class="card-header">
            <h3>Select</h3>
            </div> -->
        <div class="card-body">
            <h3>plant of user</h3>

            <ul id="sortable1" class="connectedSortable">

            </ul>

        </div>
    </div>
    <div class="card">
        <!-- <div class="card-header">
            <h3>Unselect</h3>
            </div> -->
        <div class="card-body">
            <h3>plant is not user</h3>

            <ul id="sortable2" class="connectedSortable">
                
            </ul>

        </div>
    </div>
</div>
<script>
    let base_url = "<?php echo URL; ?>";
    let id = sessionStorage.getItem('id');
    loaddata();

    function loaddata() {
        console.log("pinto");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                data = JSON.parse(this.responseText);
                // console.log(data[1].p_id);
                let text = ""
                for (i in data) {
                    text += ` <li  id='${data[i].p_id}' >
                        <img src="${base_url}views/user_plant/tomato/${data[i].p_icon}" alt="">
                        <span style="text-align:center; " >${data[i].p_alias}</span>
                    </li> `
                }
                $("#sortable1").append(text);
            }
        };
        xhttp.open("POST", `${base_url}user_manage/loadDataListPlant_1`, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id=${id}`);
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                data = JSON.parse(this.responseText);
                // console.log(data[1].p_id);
                let text = ""
                for (i in data) {
                    text += ` <li id='${data[i].p_id}'>
                        <img src="${base_url}views/user_plant/tomato/${data[i].p_icon}" alt="">
                        <span style="text-align:center; " >${data[i].p_alias}</span>
                    </li> `
                }
                $("#sortable2").append(text);
            }
        };
        xhttp2.open("POST", `${base_url}user_manage/loadDataListPlant_2`, true);
        xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp2.send(`id=${id}`);
    }
</script>
<?php require $URL."views/user_manage/drag_drop.php" ?>