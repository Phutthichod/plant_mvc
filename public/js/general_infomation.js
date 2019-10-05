$(document).ready(function() {
    $("#preview").hide();
	$('#summernote').summernote({
            height: 200
    });
    $('#save').on('click',function(){
        Array_src();
        let content = $('#summernote').summernote('code');
        console.log(content);
        $.ajax({
            url:  base_url+"/general_infomation/C_HPS",
            method: "post",
            data: { content: content },
            success: function(data) {
                $('#append_content').append("\
                    <div id='card-"+data[0]['id_hps']+"' data-id = '"+data[0]['id_hps']+"' data-position = '"+data[0]['position']+"' class='card content_HPS'>\
                        <div class='card-body '>\
                            <div class='row '>\
                                <div class='col-lg-12'>\
                                    "+$('#summernote').summernote('code')+"\
                                    <button type='button' id = '"+data[0]['id_hps']+"' class='btn U_content btn-success btn-md' data = '"+data[0]['content']+"'>Edit</button>\
                                    <button type='button' id = '"+data[0]['id_hps']+"' class='btn D_content btn-danger btn-md'  >Delete</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>");  
            },
            error: function (error) {
                console.log('$(#log).click(function(){ ');
            }
        }); 
    });
});
$('.U_content').on('click',function(){       //  UPDATE content U_content
    var HTMLstring = $(this).attr('data');
    $("#save").hide();
    $("#preview").show();
    $("#preview").attr('data_id',$(this).attr('data_id'))
    $('#summernote').summernote('code', HTMLstring);
});
$('.D_content').on('click',function(){ //DELETE content
    let id = $(this).attr('data_id');
    $.ajax({
        url:  base_url+"/general_infomation/D_HPS",
        method: "POST",
        data: { id : id },
        success: function(data) {
            $('#card-'+id).remove();
        },
        error: function (error) {
            
        }
    });

});
$('#preview').on('click',function(){  
    let id = $(this).attr('data_id');
    Array_src();
    $('#preview_body').empty();
    $('#preview_body').append($('#summernote').summernote('code'));
    $('#preview_modal').modal('show');
    $('#preview').attr('data_id',id);
   
});
$('#U_HSP').on('click',function(){   //U_HSP
    let id = $('#preview').attr('data_id');
    let content = $('#summernote').summernote('code');
    $.ajax({
        url:  base_url+"/general_infomation/U_HPS",
        method: "post",
        data: { content: content ,id : id },
        success: function(data) {
            //console.log(data[0].content);
             $('#'+id).empty();
             $('#'+id).append(data[0].content);
             $('#preview_modal').modal('hide');
        },
        error: function (error) {
            console.log('$(#log).click(function(){ ');
        }
    });
});

function CU_code(id) 
{
    let content = $('#summernote').summernote('code');
    $.ajax({
        url:  base_url+"/general_infomation/U_HPS",
        method: "post",
        data: { content: content ,id : id },
        success: function(data) {
            console.log(data);
        },
        error: function (error) {
            console.log('$(#log).click(function(){ ');
        }
    });
}
$('#reset').on('click',function(){ //RESET summernote
    $('#summernote').summernote('code', '');
});
function Array_src() 
{
    Array.from($('.note-editor').find('img')).forEach(
        function(element, index, array) {
                        if((element.attributes['src'].value).length > 1000){
                            //console.log((element.attributes['src'].value).length);
                            //console.log((element.attributes['data-filename'].value));
                            $.ajax({
                                url:  base_url+"/general_infomation/C_chang_path",
                                method: "post",
                                async: false,
                                data: { imagebase64: element.attributes['src'].value , file_name: element.attributes['data-filename'].value },
                                success: function(data) {
                                    $('img[src = "'+element.attributes['src'].value+'"]').attr('src',base_url+data);
                                },
                                error: function (error) {
                                    console.log('error updat');
                                }
                            });
                        }   
                    }
    );
}
  
/// strat_ dragula
'use strict';
    //profile-list-left1 : dragular-card
    dragula([document.getElementById("dragular-card")])
        .on('drop', function (el) {
            console.log($(el));
            let id,position; 
            id =  $(el)[0].attributes['data-id'].value;
            if($(el)[0].previousElementSibling == null){
                position = 0;
            } 
            else{
                position = $(el)[0].previousElementSibling.attributes['data-position'].value;
            }
           
             console.log(id);
             console.log(position);
             $.ajax({
                url:  base_url+"/general_infomation/U_positionHPS",
                method: "POST",
                data: { id: id , position: position},
                success: function(data) {
                    data.map((element)=>{
                        $('#card-'+element['id_hps']).attr('data-position',element['position']);
                    });  
                },
                error: function (error) {
                }
             });
        });
/// end_dragula
