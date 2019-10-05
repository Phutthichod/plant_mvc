$(document).ready(function () {  
    //Start Data table            
    // var x = 0;
    // if (x == 0) {
    //     var table = $('#owner').DataTable();
    //     var table2 = $('#share').DataTable();
    //     x++;
    // }
    var table = $('#owner').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 25
    } );
   
    $('#owner thead tr').clone(true).appendTo( '#owner thead' );
    $('#owner thead tr:eq(1) th').each( function (i) {
        
        var title = $(this).text();
        if(i==0 )
        {
            $(this).html( '<input class="border-re" type="text" placeholder="Search '+title+'" />' );
            
        }
        else if(i==1){
            $(this).html( '<select\
                class="form-control font-weight " id="searching-status" >"\
                <option class = "font-weight" value=2 selected>Not select</option>\
                <option class = "font-weight" value=1>Private</option>\
                <option class = "font-weight" value=0 >Public</option>\
            </select>');
        }
        else if(i==2){
            $(this).html( '<select\
                class="form-control font-weight " id="searching-share" >"\
                <option class = "font-weight" value=2 selected>Not select</option>\
                <option class = "font-weight" value=Yes>Yes</option>\
                <option class = "font-weight" value=No >No</option>\
            </select>');
        }
        else if(i==3 || i==4){
            $(this).html( '<input class="border-re" type="hidden" placeholder="Search '+title+'" />' );
        }
        
        
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        });
        $( 'select#searching-status', this ).on( 'change', function () {
            let test = $('#searching-status').val();
            console.log(test);
            if( test == 2 )
            {
                console.log('2***')
                table
                    .column(i)
                    .search( 'p' )
            }
            else if ( table.column(i).search() !== test) {
                console.log('3***')
                table
                    .column(i)
                    .search( test )
                    .draw();
            }
        });
        $( 'select#searching-share', this ).on( 'change', function () {
            let test = $('#searching-share').val();
            console.log(test);
            if( test == 2 )
            {
                table
                    .column(i)
                    .search( 'All' )
            }
            else if ( table.column(i).search() !== test) {
                table
                    .column(i)
                    .search( test )
                    .draw();
            }
        });

        
    } );
    //End Data table 
   
    // start evan หลังปิด modal จะโหลด ใหม่หมดเพราะในหน้าหลักมีการตรวจสอบ stastus shared
    $('#static_modal2').on('hidden.bs.modal', function () {

        $('.content_tr0').remove();
        $('.ajax_append').append('<tbody class="content_tr0">');
        $.ajax({
                    url: base_url+"/data_share/modal_share_close",
                    method: "POST",
                    success: function (data) {
                        let data_aj_home = data;
                        let i =0;
                        //data_aj_home.length
                        for(i = 0; i < data_aj_home.length; i++){
                            $('.content_tr0').append('<tr class= content_td'+i+' >');
                            $('.content_td'+i).append('<td class=A'+i+'>'+data_aj_home[i]['accession_number']+'</td>');  
                            if(data_aj_home[i]['status_ow'] == "Public"){
                                $('.content_td'+i).append('<td class=St'+i+'>\
                                                  <select class="form-control font-weight shared_pub" id="chang_PrPu"'+data_aj_home[i]['accession_number']+' disabled>"\
                                                            <option class = "font-weight" value=1>Private</option>\
                                                            <option class = "font-weight" value=0 selected>Public</option>\
                                                        </select>\
                                                    </td>');
                            }
                            else{
                                $('.content_td'+i).append('<td class=St'+i+'>\
                                                  <select class="form-control  font-weight shared_pub" id="chang_PrPu"'+data_aj_home[i]['accession_number']+' >"\
                                                            <option class = "font-weight" value=1>Public</option>\
                                                            <option class = "font-weight" value=0 selected>Private</option>\
                                                        </select>\
                                                    </td>');
                            }
                            if(data_aj_home[i]['status_sh']=="shared" || data_aj_home[i]['status_ow']== "Public"){ 
                                $('.content_td'+i).append('<td class=Sh'+i+'>\
                                    <p class = "text-center" id="status_sh"'+data_aj_home[i]['accession_number']+' >Yes</p>\
                                                    </td>');
                            } 
                            else{
                                $('.content_td'+i).append('<td class=Sh'+i+'>\
                                    <p class = "text-center" id="status_sh"'+data_aj_home[i]['accession_number']+' >No</p>\
                                                    </td>');
                            }
                            if(data_aj_home[i]['status_ow']== "Public")
                            {
                                $('.content_td'+i).append('<td class=Bt'+i+'>  <div class="form-group row"><div class="col-md-12 button_center">\
                                    <button class="  static btn  btn-rounded btn-fw " id="'+data_aj_home[i]['accession_number']+'" data-id-owner="'+data_aj_home[i]['id_member']+'" data-fact="'+data_aj_home[i]['id_fact_tomato']+'" data-a="'+data_aj_home[i]['accession_number']+'" type="button"  disabled>\
                                    <i class="mdi mdi-share-variant" data-name="mdi-share-variant"></i>Share</button>\
                                </div></div></td>');
                                                           
                            }
                            else
                            {
                                $('.content_td'+i).append('<td class=Bt'+i+'>  <div class="form-group row"><div class="col-md-12 button_center">\
                                    <button class="  static btn btn-success btn-rounded btn-fw " id="'+data_aj_home[i]['accession_number']+'" data-id-owner="'+data_aj_home[i]['id_member']+'" data-fact="'+data_aj_home[i]['id_fact_tomato']+'" data-a="'+data_aj_home[i]['accession_number']+'" type="button"  >\
                                    <i class="mdi mdi-share-variant" data-name="mdi-share-variant"></i>Share</button>\
                                </div></div></td>');                                               
                            }
                            $('.content_td'+i).append('<td class=detail_'+i+'>  <div class="form-group row"><div class="col-md-12 button_center">\
                                    <button class="detail_acc btn btn-info btn-rounded " id="detail_'+data_aj_home[i]['accession_number']+'" data-id-owner="'+data_aj_home[i]['id_member']+'"  data-a="'+data_aj_home[i]['accession_number']+'" type="button"  >\
                                    <i class="menu-icon mdi mdi-leaf" data-name="mdi-share-variant"></i>Click here</button>\
                                </div></div></td>');  
                            $('.content_td'+i).after('</tr>');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
                
        //window.location.reload();
    });
    // end evan หลังปิด modal จะโหลด ใหม่หมดเพราะในหน้าหลักมีการตรวจสอบ stastus shared

}); 
// start ปุ่มเปลี่ยนสถานะ จาก public หรือ private เช็คการยืนยัน
$('#owner').on("change",'.shared_pub',function(e){
//$(document).delegate(".shared_pub", "change", function(e) {
    var le_id =  $(this).attr('data-acc');
    var c = $(e)[0].currentTarget.id;
    swal({
        text: 'Do you want to chang "Public"  ?',
        icon: 'warning',
        buttons: {
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-success",
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
    }).then(function (z) {
        if (z) {
            document.getElementById(c).selectedIndex = 0;
            document.getElementById(c).disabled = true;  
            document.getElementById("status_sh"+le_id).innerHTML = "yes";
            document.getElementById(le_id).disabled = true;
            $.ajax({
                url: base_url+"/data_share/chang_status",
                method: "POST",
                data: { aj_l: le_id },
                success: function (data) {

                    //console.log(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });

        }
        else {
            document.getElementById(c).selectedIndex = 1;
        }
    });
});
// end ปุ่มเปลี่ยนสถานะ จาก public หรือ private เช็คการยืนยัน
$('#owner').on("click",'.detail_acc',function(){
//$(document).delegate( ".detail_acc", "click", function() {
    // stared evan show detail_accession modal
    $(".detail_acc").click(function () {
        let accession = $(this).attr('data-a');
        $('.card-description').text("Accession number : "+accession);   
        $.ajax({
                    url: base_url+"/data_share/accession_detail",
                    method: "POST",
                    data: { accession: accession },
                    success: function (data) 
                    {
                        console.log(data[0]);
                        let str =  Object.keys(data[0]); 
                        let flower_key = /flower_/i;
                        let plant_key =  /plant_/i;;
                        let fruit_key = /fruit_/i;;
                        let seed_key = /seed_/i;;
                        let seeding_key = /seeding_/i;;
                        let value,key,flower =[],plant =[],seed =[],seeding =[],fruit =[],chatagory = ['fruit','plant','seeding','flower','seed'],chatagory_Image = ["card-icon mdi mdi-food-apple","card-icon mdi mdi-tree","card-icon mdi mdi-leaf","card-icon mdi mdi-flower","card-icon mdi mdi-google-circles-communities"];
                        str.forEach(function(element) {
                            if(element.match(flower_key)){
                                value = data[0][element];
                                key = element.substr(7);
                                flower.push({[key]:value});
                            }
                            else if(element.match(plant_key)){
                                value = data[0][element];
                                key = element.substr(6);
                                plant.push({[key]:value});
                            }
                            else if(element.match(seed_key)){
                                value = data[0][element];
                                key = element.substr(5);
                                seed.push({[key]:value});
                            }
                            else if(element.match(fruit_key)){
                                value = data[0][element];
                                key = element.substr(6);
                                fruit.push({[key]:value});
                            }
                            else if(element.match(seeding_key)){
                                value = data[0][element];
                                key = element.substr(8);
                                seeding.push({[key]:value});
                            }
                        });
                                seeding.push({[key]:value});
                                seeding.push({[key]:value});
                        var objArr = { flower: flower, plant: plant, seed:seed,fruit:fruit,seeding:seeding};
                        $('.rm-acc').remove();
                        for (let index = 0; index <= 4; index++) {
                            $('#accordion').append('\
                                <div class="card rm-acc">\
                                    <div class="card-header" role="tab" id="'+chatagory[index]+'">\
                                        <h6 class="mb-0">\
                                            <a data-toggle="collapse" href="#collapse'+chatagory[index]+'" aria-expanded="false" aria-controls="collapseOne" class="collapsed">\
                                            <i class="'+chatagory_Image[index]+'"></i>'+chatagory[index]+'</a>\
                                        </h6>\
                                    </div>\
                                    <div id="collapse'+chatagory[index]+'" class="collapse" role="tabpanel" aria-labelledby="'+chatagory[index]+'" data-parent="#accordion" style="">\
                                        <div class="card-body">\
                                            <div class="row">\
                                              \
                                                <div class="col-md-12 acc">\
                                                    <table id="tb_'+chatagory[index]+'" class="table table-striped table-bordered modal-acc">\
                                                        <thead>\
                                                            <tr>\
                                                                <th>Attribute</th>\
                                                                <th>Value</th>\
                                                            </tr>\
                                                        </thead>\
                                                        <tbody id="tr_'+chatagory[index]+'">\
                                                        </tbody>\
                                                    </table>\
                                ');
                                                //objArr[key_tb].length
                                                let key_tb =  chatagory[index];
                                                for (let i = 0; i < 5; i++) {
                                                    $('#tr_'+chatagory[index]+'').append('\
                                                        <tr>\
                                                            <td>\
                                                                '+Object.keys(objArr[key_tb][i])+'\
                                                            </td>\
                                                            <td>\
                                                                '+Object.values(objArr[key_tb][i])+'\
                                                            </td>\
                                                        </tr>\
                                                    ');
                                                }
                                $('#collapse'+chatagory[index]+'').append('\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            ');
                            
                        }
                    }
        });

        $("#accession_detail").modal('show');
    });
    //end evan show detail_accession modal
});
 // stared evan เมื่อกดปุ่ม shared จะสร้าง modal สำหรับเลือกคนที่จะ shared
$('#owner').on("click",'.static',function(){
//$(document).delegate( ".static", "click", function() {
        var Lexx = $(this).attr('data-a');
        document.getElementById('acc_n').innerHTML = 'Accession number : '+Lexx;
        var sesio_id = member;
        console.log(base_url+"data_share/modal_share");
               $.ajax({
                    url: base_url+"data_share/modal_share",
                    method: "POST",
                    data: { LExx: Lexx, User_id: sesio_id },
                    success: function (data) 
                    {
                        console.log(data);
                       $('#profile-list-right1').empty();
                       $('#profile-list-left1').empty();
                       $('#profile-list-right2').empty();
                       $('#profile-list-left2').empty();
                       var js2 = data;
                       var i = 0;
                       var tog1 = true;
                       var tog2 = true;
                       let person_shared = 0;
                        let person_Unshared = 0;
                       for (i = 0; i < js2.length; i++) {
                           if(js2[i]['id_member_owner']!=null)
                           {
                                let date_sh = new Date(js2[i]['date_shared']);
                                js2[i]['date_shared']  = date_sh.getDate() + "/" + (date_sh.getMonth() + 1) + "/" + date_sh.getFullYear()
                                if (tog1) {
                                $('#profile-list-left1').append('\
                                    <div class="card card-member rounded mb-2">\
                                        <div class="card-body p-3">\
                                            <div class="media">\
                                                <img  src="theme/assets/images/faces/face5.jpg" alt="image" class="img-sm mr-3 rounded-circle">\
                                                <div class="media-body">\
                                                    <p class="mb-1 f_name">' + js2[i]['firstname'] +' '+ js2[i]['lastname'] + '</p>\
                                                    <p  class="mb-0  date-sh ">Date  : ' + js2[i]['date_shared'] + '</p>\
                                                    <p  class="mb-0 text-muted  "  data_id_ow=' + js2[i]['id_member_owner'] + ' data_id_sh=' + js2[i]['id_member'] + '></p>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>');
                                    tog1 = false;
                                }
                                else {
                                   $('#profile-list-left2').append('\
                                    <div class="card  card-member rounded mb-2">\
                                        <div class="card-body p-3">\
                                            <div class="media">\
                                                <img  src="theme/assets/images/faces/face5.jpg" alt="image" class="img-sm mr-3 rounded-circle">\
                                                <div class="media-body"><p class="mb-1 f_name">' + js2[i]['firstname'] +' '+ js2[i]['lastname'] + '</p>\
                                                    <p  class="mb-0   date-sh ">Date  : ' + js2[i]['date_shared'] + '</p>\
                                                    <p  class="mb-0 text-muted  " data_id_ow=' + js2[i]['id_member_owner'] + ' data_id_sh=' + js2[i]['id_member'] + '></p>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>');
                                    tog1 = true;
                                }
                               person_shared++;
                           }
                            else
                            {
                                if (tog2) {
                                    $('#profile-list-right1').append('\
                                        <div class="card card-member rounded mb-2">\
                                            <div class="card-body p-3">\
                                                <div class="media">\
                                                    <img  src="theme/assets/images/faces/face5.jpg" alt="image" class="img-sm mr-3 rounded-circle">\
                                                    <div class="media-body">\
                                                        <p class="mb-1 f_name">' + js2[i]['firstname'] +' '+ js2[i]['lastname'] + '</p>\
                                                        <p  class="mb-0   date-sh "></p>\
                                                        <p  class="mb-0 text-muted  " data_id_ow=' + js2[i]['id_member_owner'] + ' data_id_sh=' + js2[i]['id_member'] + '  ></p>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>');
                                    tog2 = false;
                                }
                                else {
                                    $('#profile-list-right2').append('\
                                        <div class="card card-member rounded mb-2">\
                                            <div class="card-body p-3">\
                                                <div class="media">\
                                                    <img  src="theme/assets/images/faces/face5.jpg" alt="image" class="img-sm mr-3 rounded-circle">\
                                                    <div class="media-body">\
                                                        <p class="mb-1 f_name">' + js2[i]['firstname'] +' '+ js2[i]['lastname'] + '</p>\
                                                        <p  class="mb-0   date-sh "></p>\
                                                        <p  class="mb-0 text-muted  " data_id_ow=' + js2[i]['id_member_owner'] + ' data_id_sh=' + js2[i]['id_member'] + '></p>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>');
                                    tog2 = true;
                                }
                               person_Unshared++;
                           }
                           
                       }
                        $('#shared_num').attr('data_shared_num',person_shared);
                        $('#unshared_num').attr('data_unshared_num',person_Unshared);
                        document.getElementById('shared_num').innerHTML = person_shared;
                        document.getElementById('unshared_num').innerHTML = person_Unshared;  
                   },
                   error: function (data) 
                   {
                       console.log(data);
                   }
               });
               // end evan เมื่อกดปุ่ม shared จะสร้าง modal สำหรับเลือกคนที่จะ shared
               $("#static_modal2").modal('show');
});   
 // End evan เมื่อกดปุ่ม shared จะสร้าง modal สำหรับเลือกคนที่จะ shared
/// strat_ dragula
'use strict';

    var shareTochange,shareTochangeUn;
    var d = new Date();
    var date_sh = (d.getFullYear()) + '-' + (d.getMonth() + 1) + '-' + d.getDate();
    var id_fa,id_m_o,id_m_s,LE;
    $(document).ready(function () {
        $('#owner').on("click",'.static',function(){
            LE = $(this).attr('data-a');
            id_fa = $(this).attr('data-fact');
            id_m_o = $(this).attr('data-id-owner');
        });
    });
    dragula([document.getElementById("profile-list-left1"), document.getElementById("profile-list-right1"), document.getElementById("profile-list-left2"), document.getElementById("profile-list-right2")])
        .on('drop', function (el) {
            shareTochange = $(el).find('.text-muted');
            shareTochangeUn = $(el).find('.date-sh');
           // console.log(shareTochangeUn[0].outerText);
            //console.log($($(el)[0].parentNode)[0].id);
            id_m_s = shareTochange[0].attributes[2].value;
            let person_shared =  $('#shared_num').attr('data_shared_num');
            let person_Unshared = $('#unshared_num').attr('data_unshared_num');
            if(( $($(el)[0].parentNode)[0].id =='profile-list-right1' || $($(el)[0].parentNode)[0].id =='profile-list-right2') && shareTochangeUn[0].outerText !='')
            {
                person_Unshared++;
                console.log( person_Unshared );
                person_Unshared = person_Unshared.toString();
                document.getElementById('unshared_num').innerHTML = person_Unshared;
                $('#unshared_num').attr('data_Unshared_num',person_Unshared);

                $('#shared_num').attr('data_shared_num',--person_shared);
                person_shared = person_shared.toString();
                document.getElementById('shared_num').innerHTML = person_shared;
                $.ajax({
                        url: base_url+"/data_share/unshare_user",
                        method: "POST",
                        data: { aj_f: id_fa, aj_o: id_m_o, aj_s: id_m_s, aj_l: LE, aj_d: date_sh },
                        success: function (data) {

                        },
                        error: function () {
                            alert('failure1');
                        }
                    });
                shareTochangeUn.empty();
               
                
            }
            else if(shareTochangeUn[0].outerText == '' && ( $($(el)[0].parentNode)[0].id =='profile-list-left2' || $($(el)[0].parentNode)[0].id =='profile-list-left1') ) //ย้ายซ้ายไปขวา sh -> Unsh
            {
                person_shared++;
                person_shared = person_shared.toString();
                document.getElementById('shared_num').innerHTML = person_shared;
                $('#shared_num').attr('data_shared_num',person_shared);

                $('#unshared_num').attr('data_unshared_num',--person_Unshared);
                person_Unshared = person_Unshared.toString();
                document.getElementById('unshared_num').innerHTML = person_Unshared;

                $(shareTochangeUn).append('Date : ' + date_sh + '');
                console.log(id_fa+' '+id_m_o+' '+id_m_s+' '+LE+' '+date_sh);
                $.ajax({
                            url: base_url+"/data_share/share_user",
                            method: "POST",
                            data: { aj_f: id_fa, aj_o: id_m_o, aj_s: id_m_s, aj_l: LE, aj_d: date_sh },
                            success: function (data) {
                            },
                            error: function () {
                                alert('failure2');
                            }
                        });
            }     
        });
/// end_dragula