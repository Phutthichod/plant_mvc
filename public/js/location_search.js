// สำหรับผู้พัฒนาต่อ : เช็คสิทเเล้วว่ามีสิทเข้าถึงไหมผ่าน file index แล้ว  อาจมีส่วน เช็คซ้ำว้อน บันทัด find (bug)
var accessData =''; 
accessData = findPermission;
var sessionMember = '';
sessionMember = sessionM;

console.log(arrJ);

var arrJ_temp = '';
arrJ_temp = arrJ

var id_FKmarker = 1;
var map,marker,infowindow,infobubble,areaNear = [];
var searchArea,searchAreaRadius,startLat,startLng;
$( document ).ready(function() {
        $("#acce").change(function() {
            $("#lat").val('');
            $("#lon").val('');
        });
        $("#lat").change(function() {
            $("#acce").val('');
        });
        $("#clear_content_search").click(function() {
            $("#acce").val('');
            $("#lat").val('');
            $("#lon").val('');
        });
        $("#search-acc").click(function() {
            marker.setMap(null);  // clear marker from search


           var lat_in = $("#lat").val();//distance_search
           var lon_in = $("#lon").val();  
           var acce = $("#acce").val();
           let country = $("#country_DD").val(); 
           let province = $("#province_DD").val(); 
           let district = $("#district_DD").val(); 
           let sub_district = $("#sub_district_DD").val(); 
           var i_ta =0;
           if(lat_in != '' && lon_in != '')
           {  
                    let found_search = false;
                    for (i_ta=1; i_ta<Object.keys(arrJ).length ;i_ta++)
                    {
                        if((arrJ[i_ta]['lat'] == lat_in & arrJ[i_ta]['long']== lon_in) )
                        {
                                find_posi(arrJ[i_ta]['lat'],arrJ[i_ta]['long'],arrJ[i_ta]['accession'],i_ta ) ;
                                found_search =  true;  
                                break;
                        }
                    }
                    if(!found_search)
                    {
                        swalAlert('not_found','Target search not found');
                    }
           }
           else if(acce !='')
           {
                    let found_search = false;
                    for (i_ta=1; i_ta<Object.keys(arrJ).length ;i_ta++)
                    {
                        var sp = [];
                        sp = arrJ[i_ta]['accession'].split(",");
                        
                        for (i_ta2=0; i_ta2<sp.length ;i_ta2++)
                        {
                            //alert(sp[i_ta2]);
                            if(sp[i_ta2] == acce)
                            {
                                find_posi(arrJ[i_ta]['lat'],arrJ[i_ta]['long'],arrJ[i_ta]['accession'],i_ta ) ;  
                                i_ta = Object.keys(arrJ).length+2;
                                found_search =  true;  
                                break;
                            }        
                        }  
                    } 
                    if(!found_search)
                    {
                        swalAlert('not_found','Accession number search not found');
                    }
           }
           else if(sub_district != -1)
           {
                let arrJ2 = [];
                for (let index = 1; index <= Object.keys(arrJ_temp).length; index++) 
                {
                    if (arrJ_temp[index]['sub_district'] == sub_district)
                    {
                        arrJ2[Object.keys(arrJ2).length+1] = arrJ_temp[index];
                    }   
                }
                arrj = [];
                arrJ = arrJ2;
                asree();
           }
           else if(district != -1)
           {
                let arrJ2 = [];
                for (let index = 1; index <= Object.keys(arrJ_temp).length; index++) 
                {
                    if (arrJ_temp[index]['district'] == district)
                    {
                        arrJ2[Object.keys(arrJ2).length+1] = arrJ_temp[index];
                    } 
                }
                arrj = [];
                arrJ = arrJ2;
                asree();
           }
           else if(province != -1)
           {
                let arrJ2 = [];
                for (let index = 1; index <= Object.keys(arrJ_temp).length; index++) 
                {
                    if (province == arrJ_temp[index]['province'])
                    {
                        arrJ2[Object.keys(arrJ2).length+1] = arrJ_temp[index];
                    }  
                }
                arrj = [];
                arrJ = arrJ2;
                asree();
           }
           else if(country != -1)
           {
               let arrJ2 = [];
               for (let index = 1; index <= Object.keys(arrJ_temp).length; index++) 
               {
                   if (arrJ_temp[index]['country'] == country)
                   {
                        arrJ2[Object.keys(arrJ2).length+1] = arrJ_temp[index];
                   } 
               }
               arrj = [];
               arrJ = arrJ2;
               asree();
           }
           else if(acce =='' && lat_in == '' && lon_in == '')
           {
                swalAlert('not_found','Please enter a valid search')
           }
        });
       
});
$('#myImageA1').on("click",'.link-detail',function(){ // ส่ง detail ให้ ฟังชั่น jump แสดง ข้อมูลรายละเอียดสายพันธุ์
    var acc = $(this).data("acc");
    $("#sent_acc_number").val(acc);
    $('#sent_form').submit();
})
$('#myImageF1').on("click",'.link-detail2',function(){ // ส่ง detail ให้ ฟังชั่น jump แสดง ข้อมูลรายละเอียดสายพันธุ์
    var acc = $(this).data("acc");
    $("#sent_acc_number").val(acc);
    $('#sent_form').submit();
})
var mapAccU =(data)=>{
    let dataMap = accessData;
    let temp =[];
    temp.push(data.map((index,i)=> {
        let findD = dataMap.find(x => x.accession == index);
        if(findD){
            return {
                le   : index,
                owner: findD
            };
        }
        else { // ไม่พบ
            return {
                le   : index,
                owner: {idMemberShare : [-1]}
            };
        } 
    }));
    return temp;
}
function showimg(acs,mem,path) // Accession Number found : Show image and Link to detail
    {
        let SplitPath = path.split(",");
        $(".remo").empty();
        var sp = acs.split(","); 
        let mapAccessionWithUser = mapAccU(sp);     
        var i;
        for (i = 1; i <= sp.length; i++) {
            $('#myImageA1').append("\
            <div class='img-card col-xl-2 col-lg-2 col-md-2 col-sm-2'>\
                                <figure class='effect-text-in'>\
                                    <img  id='myImageA" + (i + 1) + "'   alt='image'>\
                                    <figcaption>\
                                        <div id='acs" + i + "' ></div>\
                                        <div id='acsLink_" + i + "' ></div>\
                                    </figcaption>\
                                </figure>\
            </div>");
            if (i>7) {
                $('#myImageA' + (i + 1)).attr({ src: SplitPath[i-1] });
                
            } else {
                $('#myImageA' + (i + 1)).attr({ src: SplitPath[i-1] });
            }
            let findma = mapAccessionWithUser[0].find(x => x.le == sp[(i - 1)]);
            if(findma){
                let ownerName = findma.owner.firstname;
                let ownerLastname = findma.owner.lastname;
                let ownerEmail = findma.owner.email;
                // < bug> ไม่ต้อง if แล้ว
                    // if( findma.owner.id_member == sessionMember || typeof(findma.owner.idMemberShare.find(z => z == sessionMember)) != "undefined" ){
                    //     $('#acsLink_' + (i)).append("\
                    //         <p style='color:black' >Name :  "+ownerName +" <br> Lastname : "+ownerLastname+" </p>\
                    //     ");
                    //     $('#acs' + i ).append("\
                    //         <a href='javascript:void(0)' style='color:black' class='link-detail' id='detail'  data-acc='"+sp[(i - 1)]+"'><h4>"+sp[(i - 1)]+"</h4></a>\
                    //     ");
                    // }
                    // else {
                    //     $('#acsLink_' + (i)).append("\
                    //         <p style='color:black'>Name :   "+ownerName +" <br> Lastname :  "+ownerLastname+" </p>\
                    //     ");
                    //     $('#acs' + i ).append("\
                    //         <h4 style='color:black'>"+sp[(i - 1)]+"</h4>\
                    //     ");
                    // }
                // </bug>
                $('#acsLink_' + (i)).append("\
                        <p style='color:black' >Name :  "+ownerName +" <br> Lastname : "+ownerLastname+" </p>\
                    ");
                    $('#acs' + i ).append("\
                        <a href='javascript:void(0)' style='color:black' class='link-detail' id='detail'  data-acc='"+sp[(i - 1)]+"'><h4>"+sp[(i - 1)]+"</h4></a>\
                ");
            }    
        }
        $('#gene_total').html(' / '+accessData.length+'&nbsp accession');
}


function showimg_Sp(acs,path) //Accession Number found in area : Show image and Link to detail
{
    let conCate = '';
    for (let index = 0; index < path.length; index++) {
       
        conCate += ','+path[index];
    }
    let SplitPath = conCate.split(",");
        $(".found_area").empty();
        if(acs.length !== 0)
        {
            var sp = acs.join(","); //////// ทำ array LExx ให้เป็นสติงตัวเดียว
            sp = sp.split(",");
            let mapAccessionWithUser = mapAccU(sp);
            document.getElementById('Sp').innerHTML = sp.length;
            var i;
            for (i = 1; i <= sp.length; i++) 
            {
                $('#myImageF1').append("\
                <div class='img-card col-xl-2 col-lg-2 col-md-2 col-sm-2'>\
                    <div class='card-pic1 '>\
                            <div class='clearfix'>\
                                <center>\
                                    <figure class='effect-text-in'>\
                                        <img  id='myImageF" + (i + 1) + "'  alt='image'>\
                                        <figcaption>\
                                        <div id='acsF" + i + "' ></div>\
                                        <div id='acsFLink_" + i + "' ></div>\
                                    </figcaption>\
                                    </figure>\
                                </center> \
                            </div>\
                    </div>\
                </div>");
                if (i>7) {
                    $('#myImageF' + (i + 1)).attr({ src: SplitPath[i] });
                    
                } else {
                    $('#myImageF' + (i + 1)).attr({ src:  SplitPath[i] });
                }
                let findma = mapAccessionWithUser[0].find(x => x.le == sp[(i - 1)]);
                if(findma){
                    let ownerName = findma.owner.firstname;
                    let ownerLastname = findma.owner.lastname;
                    let ownerEmail = findma.owner.email;
                     // < bug> ไม่ต้อง if แล้ว
                        // if( findma.owner.id_member == sessionMember || typeof(findma.owner.idMemberShare.find(z => z == sessionMember)) != "undefined" ){
                        //     $('#acsFLink_' + (i)).append("\
                        //         <p style='color:black' >Name :  "+ownerName +" <br> Lastname : "+ownerLastname+" </p>\
                        //     ");
                        //     $('#acsF' + i ).append("\
                        //         <a href='javascript:void(0)' style='color:black' class='link-detail2' id='detail'  data-acc='"+sp[(i - 1)]+"'><h4>"+sp[(i - 1)]+"</h4></a>\
                        //     ");
                        // }
                        // else {
                        //     $('#acsFLink_' + (i)).append("\
                        //         <p style='color:black'>Name :   "+ownerName +" <br> Lastname :  "+ownerLastname+" </p>\
                        //     ");
                        //     $('#acsF' + i ).append("\
                        //         <h4 style='color:black'>"+sp[(i - 1)]+"</h4>\
                        //     ");
                        // }
                    // < /bug>
                    $('#acsFLink_' + (i)).append("\
                        <p style='color:black' >Name :  "+ownerName +" <br> Lastname : "+ownerLastname+" </p>\
                        ");
                        $('#acsF' + i ).append("\
                            <a href='javascript:void(0)' style='color:black' class='link-detail2' id='detail'  data-acc='"+sp[(i - 1)]+"'><h4>"+sp[(i - 1)]+"</h4></a>\
                        ");
                    }   
            }
        }
        else
            document.getElementById('Sp').innerHTML = '0';
        
       
}
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
        else if (type === 'invalid') {
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

function asree() 
{
        searchAreaRadius = $("#distance_search").val(); // metres$("#lat").val();//distance_search
        // startLat = 9.215077,
        // startLng = 99.266872;
        if(arrJ == null){
            startLat = 13.7244416;
            startLng = 100.3529157;
        }
        else
        {
            startLat = parseFloat(arrJ[1]['lat']);
            startLng = parseFloat(arrJ[1]['long']);
        }
        
       
        searchAreaRadius = parseFloat(searchAreaRadius,10);;
        var startLatLng = new google.maps.LatLng(startLat, startLng);
         map = new google.maps.Map(document.getElementById('map'), {
            // center: { lat: 13.7244416, lng: 100.3529157 },
            center:  startLatLng ,
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        searchArea = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.5,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.2,
            map: map,
            center: startLatLng,
            radius: searchAreaRadius
        });
        //infobubble = new google.maps.InfoBubble();
        //infowindow = new google.maps.InfoWindow();
        infowindow = new google.maps.InfoWindow();
        map.markers = [];
        var  i,res;
        for (i = 1; i <= Object.keys(arrJ).length; i++) 
        { //////// set แต่ละ mark
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(arrJ[i]['lat'], arrJ[i]['long']),
                map: map,
                title:arrJ[i]['accession']
            });
            marker['path'] = arrJ[i]['path'];
            //'country :' +arrJ[i]['country']+' province :'+arrJ[i]['province']+' district :'+arrJ[i]['district']+' sub_district :'+arrJ[i]['sub_district']

            map.markers.push(marker);
               google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    $("#lat_c").empty();
                    $("#long_c").empty();
                    $("#acce").empty();
                  
                    res = arrJ[i]['accession'].split(",");
                    document.getElementById('lat_c').innerHTML = arrJ[i]['lat'];
                    document.getElementById('lon_c').innerHTML = arrJ[i]['long'];
                    document.getElementById('gene').innerHTML = res.length;//////ส่ง ขนาดไปให้แสดงจำนวนที่พบ
                    showimg(arrJ[i]['accession'],arrJ[i]['id_member'],marker['path']);
                    typeof(arrJ[i]['country']) == "undefined" ? arrJ[i]['country']=" ":"null";
                    typeof(arrJ[i]['province']) == "undefined" ? arrJ[i]['province']=" ":"null";
                    typeof(arrJ[i]['district']) == "undefined" ? arrJ[i]['district']=" ":"null";
                    typeof(arrJ[i]['sub_district']) == "undefined" ? arrJ[i]['sub_district']=" ":"null";


                    infowindow.setContent('<div class="content_map" >'
                        +'<div class = "row">'
                            +'<div class = "col-lg-6 width_h">'
                                +'<p class="H_content_map Country">'+'Country :</p>'
                            +'</div>'
                            +'<div class = "col-lg-6 width_c">'
                                +'<p class ="conten_map">'+arrJ[i]['country']+'</p><br>'
                            +'</div>'
                        +'</div>'
                         +'<hr class="hr_map"><div class = "row">'
                            +'<div class = "col-lg-6 width_h">'
                                +'<p class="H_content_map Province">'+'Province :</p>'
                            +'</div>'
                            +'<div class = "col-lg-6 width_c">'
                                +'<p class ="conten_map">'+arrJ[i]['province']+'</p><br>'
                            +'</div>'
                        +'</div>'
                        +'<hr class="hr_map"><div class = "row">'
                            +'<div class = "col-lg-6 width_h">'
                                +'<p class="H_content_map District">'+'District :</p>'
                            +'</div>'
                            +'<div class = "col-lg-6 width_c">'
                                +'<p class ="conten_map">'+arrJ[i]['district']+'</p><br>'
                            +'</div>'
                        +'</div>'
                        +'<hr class="hr_map"><div class = "row">'
                            +'<div class = "col-lg-6 width_h">'
                                +'<p class="H_content_map Sub_district">'+'Sub_district :</p>'
                            +'</div>'
                            +'<div class = "col-lg-6 width_c">'
                                +'<p class ="conten_map">'+arrJ[i]['sub_district']+'</p><br>'
                            +'</div>'
                        +'</div>'
                        +'<hr class="hr_map"><div class = "row">'
                            +'<div class = "col-lg-6 width_h" >'
                                +'<p class="H_content_map ">'+'Accession Number  :</p>'
                            +'</div>'
                            +'<div class = "col-lg-6 width_c">'
                                +'<p class ="conten_map">'+arrJ[i]['accession']+'</p><br>'
                            +'</div>'
                        +'</div>'
                    +'</div>');
                    infowindow.open(map, marker);
                    if (marker.getAnimation() !== null) //////// set animation
                    {
                        marker.setAnimation(null);
                    } 
                    else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }               
                }
            })(marker, i));   
            google.maps.event.addListener(marker, 'click', function(e) {
                startLatLng = e.latLng;
                searchArea.setOptions({
                center: startLatLng
                });
                      map.panTo(e.latLng);
                      areaNear = [];
                      areaNearImg = [];
                      var i_na=0;//////// ตัวแปรเพิ่มขนาดอาเรย์ คำตอบ
                        // find markers in area
                        for (var i_n = 0; i_n <map.markers.length; i_n++)
                        {
                            if(map.markers[i_n].getPosition() != searchArea.getCenter() )
                            {
                                    //console.log('Marker: ' + map.markers[i_n].title + ', position: ' + map.markers[i_n].getPosition());
                                    // ---------- Here comes the error: 
                                    // TypeError: e is undefined
                                    if (google.maps.geometry.spherical.computeDistanceBetween(map.markers[i_n].getPosition(), searchArea.getCenter()) <= searchArea.getRadius()) 
                                    { 
                                        areaNear[i_na] = map.markers[i_n].title;
                                        areaNearImg[i_na] = map.markers[i_n]['path'];
                                        i_na++;
                                        //console.log('=> is in searchArea');
                                    } 
                                    else
                                    {
                                        //console.log('=> is NOT in searchArea');
                                    }
                            }   
                        }
                        showimg_Sp(areaNear,areaNearImg);
            });
            google.maps.event.addDomListener(window, 'load', asree);
        
        }
}
function rad(x) {return x*Math.PI/180;}
function find_posi(l,o,c_acc,i_p) {  
        var latLng = new google.maps.LatLng(l, o);  
        marker = new google.maps.Marker({
                                position: new google.maps.LatLng(l, o),
                                map: map,
                                icon: 'pic/search_location/finger.png'    
        });
        marker.set("finker",1);
        marker.setAnimation(google.maps.Animation.BOUNCE);
        map.panTo(latLng);
        google.maps.event.addListener(marker, 'click', function () {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            marker.setMap(null);  
        }); 
        id_FKmarker++;   
}
$(document).on("change", "#huge-value", function() {
    $("#distance_search").val($("#huge-value").val()*1000);
    asree(); 
});
(function($) {
  'use strict';
  // Range Slider
  if ($("#value-range").length) {
    var bigValueSlider = document.getElementById('value-range'),
      bigValueSpan = document.getElementById('huge-value');

    noUiSlider.create(bigValueSlider, {
      start: 1,
      step: 0,
      range: {
        min: 0,
        max: 200
      }
    });
    var i=0,j=0;
    var range = [];
    for(i=0;i<=200;i+=0.5)
    {
        range[j] = i.toString();
        j++;
    }
    
    bigValueSlider.noUiSlider.on('update', function(values, handle) {
      //console.log(range[Math.floor(values)]);
      $("#distance_search").val(range[Math.floor(values)]*1000);
      asree();  
      $("#huge-value").val(range[Math.floor(values)].toString());
    });
  }
  if ($("#skipstep").length) {
    var skipSlider = document.getElementById('skipstep');
    noUiSlider.create(skipSlider, {
      range: {
        'min': 0,
        '10%': 10,
        '20%': 20,
        '30%': 30,
        // Nope, 40 is no fun.
        '50%': 50,
        '60%': 60,
        '70%': 70,
        // I never liked 80.
        '90%': 90,
        'max': 100
      },
      snap: true,
      start: [20, 90]
    });
    var skipValues = [
      document.getElementById('skip-value-lower'),
      document.getElementById('skip-value-upper')
    ];

    skipSlider.noUiSlider.on('update', function(values, handle) {
      skipValues[handle].innerHTML = values[handle];
    });
  }
})(jQuery);
    
   
