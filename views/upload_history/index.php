 <style>
     #tabname {
         color: black;
         background-color: red;
     }

     #upload ul li span {
         width: 15px;
         height: 12px;
         background: url('./public/icon/icons.png') no-repeat;
         position: absolute;
         top: 30px;
         right: 33px;
         cursor: pointer;
     }

     #upload ul li.working span {
         height: 16px;
         background-position: 0 -12px;
     }

     #upload ul li.error p {
         color: red;
     }

     #upload {
         width: 100%;
         padding: 30px;
         border-radius: 3px;
         margin: 0px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
     }


     #drop {
         border-style: dotted;
         border-width: 2px;
         margin-bottom: 15px;
         color: #6c757d;
     }

     #drop a {
         background-color: #ff6258;
         padding: 12px 26px;
         color: #fff;
         font-size: 14px;
         border-radius: 2px;
         cursor: pointer;
         display: inline-block;
         margin-top: 5px;
         margin-left: 5px;
         margin-bottom: 5px;
         line-height: 1;
     }

     #drop a:hover {
         /* background-color: #ff0017; */
     }

     #drop input {
         display: none;
     }

     #upload ul {
         list-style: none;
         margin: 0 -30px;
         border-top: 0px;
         border-bottom: 0px;
     }

     #upload ul li {
         border: 1px 1px solid #3d4043;
         padding: 15px;
         height: 52px;
         margin-bottom: 30px;
         position: relative;
     }

     #upload ul li input {
         display: none;
     }

     #upload ul li p {
         width: 70%;
         overflow: hidden;
         white-space: nowrap;
         color: #212529;
         font-size: 16px;
         font-weight: bold;
         position: absolute;
         top: 20px;
         left: 100px;
     }

     #upload ul li i {
         font-weight: normal;
         font-style: normal;
         color: #7f7f7f;
         display: block;
     }

     #upload ul li canvas {
         top: 15px;
         left: 32px;
         position: absolute;
     }

     .font-20 {
         font-size: 0.875rem;
     }

     .padding-left-10 {
         padding-left: 10px;
     }

     a.green:hover {
         color: #19d895;

     }

     a.green {
         color: #3bd949;
     }

     .red {
         color: red;
     }

     .tomato {
         color: #ff0017;
     }

     .tab-solid {
         margin-bottom: 0px;
     }

     .tab-solid-danger {
         border-style: solid;
         border-width: 0px 0px 2px 0px;
         color: #ff6258;

     }

     .tab-content-solid {
         border-style: solid;
         border-width: 2px;
         border-color: #ff6258;
     }
 </style>
 <!-- หน้าเว็บ -->
 <div class="card">
     <div class="card-body">

         <!-- Start Tab Name Type -->

         <ul class="nav nav-tabs tab-solid tab-solid-danger" role="tablist">
             <li class="nav-item">
                 <a class="nav-link" id="tabname" role="tab" aria-controls="home-5-1"><?php echo $this->name_type; ?> </a>
             </li>
         </ul>

         <!-- Stop Tab Name Type -->

         <div class="tab-content tab-content-solid">
             <div class="tab-pane fade active show" id="home-5-1" role="tabpanel" aria-labelledby="tab-5-1">
                 <div class="m-4">
                     <h2>Upload <?php echo $this->name_type; ?> File </h2>

                     <form id="upload" method="post" action="<?php echo URL ?>upload_history/checkAll_location" enctype="multipart/form-data">

                         <div id="drop">
                             <a>Browse</a> <span class="font-20 padding-left-10"> Please select a file to upload.</span>
                             <input id="file_upload" type="file" name="upl" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                         </div>
                         <p>**example file to upload<a class="green" href="<?php echo URL ?>public/example.xlsx" target="_blank" download="char_data"><span class="padding-left-10"><i class="font-20 fas fa-file-upload"></i>download </span></a></p>

                         <button type="button" class="btn btn-success btn-block btn-upload">Upload</button>
                     </form>
                 </div>
             </div>

             <!-- <div class="tab-pane fade" id="profile-5-2" role="tabpanel" aria-labelledby="tab-5-2">
                 <div class="m-4">
                     <h2>Upload Location File </h2>
                     <form id="upload_location" method="post" action="<?php echo URL ?>upload/check_data_location" enctype="multipart/form-data">
                         <div id="drop">
                             <a>Browse</a> <span class="font-20 padding-left-10 upload_location"> Please select a file to upload.</span>
                             <input id="file_upload_location" type="file" name="upl" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                         </div>
                         <p>**example file to upload<a class="green" href="<?php echo URL ?>public/example_location.xlsx" target="_blank" download="passport_data"><span class="padding-left-10"><i class="font-20 fas fa-file-upload"></i>download </span></a></p>

                         <button type="button" class="btn btn-success btn-block btn-upload-location">Upload</button>
                     </form>
                 </div>
             </div>
             <div class="tab-pane fade" id="contact-5-3" role="tabpanel" aria-labelledby="tab-5-3">
                 <div class="m-4">
                     <h2>Upload Genome File </h2>
                     <form id="upload_genome" method="post" action="<?php echo URL ?>upload/check_data_genome" enctype="multipart/form-data">
                         <div id="drop">
                             <a>Browse</a> <span class="font-20 padding-left-10 upload_genome"> Please select a file to upload.</span>
                             <input id="file_upload_genome" type="file" name="upl" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                         </div>
                         <p>**example file to upload<a class="green" href="<?php echo URL ?>public/testUploadGenome.xlsx" target="_blank" download="genome_data"><span class="padding-left-10"><i class="font-20 fas fa-file-upload"></i>download </span></a></p>

                         <button type="button" class="btn btn-success btn-block btn-upload-genome">Upload</button>
                     </form>
                 </div>
             </div> -->

         </div>

     </div>
 </div>

 <script>
     var base_url = "<?php echo URL; ?>";
 </script>
 <script>
     $("#file_upload_genome").change(function() {
         $(".font-20.padding-left-10.upload_genome").empty();
         var file = $("#file_upload_genome").prop("files")[0];
         $(".font-20.padding-left-10.upload_genome").append(file.name);
     });
     $(".btn-upload-genome").click(function() {
         $(".btn-upload-genome").attr("disabled", true);


         var file = $("#file_upload_genome").prop("files")[0];

         if (file) {
             $(".progress.progress-lg.mt-2.genome").remove();
             $(".btn-upload-genome").before(`
            <div class="progress progress-lg mt-2 genome" style="margin-bottom:20px;">
                <div id="progressBar_genome" class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>          
                </div>`);
             var formdata = new FormData();
             formdata.append("file_upload_genome", file);
             var ajax = new XMLHttpRequest();
             ajax.upload.addEventListener("progress", progressHandler3, false);
             ajax.addEventListener("load", completeHandler3, false);
             ajax.addEventListener("error", errorHandler3, false);
             ajax.addEventListener("abort", abortHandler3, false);
             ajax.open("POST", base_url + "upload");
             ajax.send(formdata);
         } else {
             swal({
                 text: 'Please select file',
                 icon: 'warning',
                 timer: 1500,
                 button: false
             });
             $(".btn-upload-genome").attr("disabled", false);
         }
     });

     function progressHandler3(event) {
         var percent = (event.loaded / event.total) * 100;
         $("#progressBar_genome").text(Math.round(percent) + "%");
         $("#progressBar_genome").css('width', Math.round(percent) + '%');
     }

     function completeHandler3(event) {
         $("#progressBar_genome").text("complete");
         setTimeout(function() {
             $("#upload_genome").submit();
         }, 1000);

     }


     function errorHandler3(event) {
         $(".progress.progress-lg.mt-2.genome").remove();
         $(".btn-upload-genome").before(`<span id="status_upload" class="red">Upload Failed</span>`);
     }

     function abortHandler3(event) {
         $(".progress.progress-lg.mt-2.genome").remove();
         $(".btn-upload-genome").before(`<span id="status_upload" class="red">Upload Failed</span>`);
     }
 </script>
 <script>
     $("#file_upload_location").change(function() {
         $(".font-20.padding-left-10.upload_location").empty();
         var file = $("#file_upload_location").prop("files")[0];
         $(".font-20.padding-left-10.upload_location").append(file.name);
     });
     $(".btn-upload-location").click(function() {
         $(".btn-upload-location").attr("disabled", true);


         var file = $("#file_upload_location").prop("files")[0];

         if (file) {
             $(".progress.progress-lg.mt-2.location").remove();
             $(".btn-upload-location").before(`
            <div class="progress progress-lg mt-2 location" style="margin-bottom:20px;">
                <div id="progressBar_location" class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>          
                </div>`);
             var formdata = new FormData();
             formdata.append("file_upload_location", file);
             var ajax = new XMLHttpRequest();
             ajax.upload.addEventListener("progress", progressHandler2, false);
             ajax.addEventListener("load", completeHandler2, false);
             ajax.addEventListener("error", errorHandler2, false);
             ajax.addEventListener("abort", abortHandler2, false);
             ajax.open("POST", base_url + "upload");
             ajax.send(formdata);
         } else {
             swal({
                 text: 'Please select file',
                 icon: 'warning',
                 timer: 1500,
                 button: false
             });
             $(".btn-upload-location").attr("disabled", false);
         }
     });

     function progressHandler2(event) {
         var percent = (event.loaded / event.total) * 100;
         $("#progressBar_location").text(Math.round(percent) + "%");
         $("#progressBar_location").css('width', Math.round(percent) + '%');
     }

     function completeHandler2(event) {
         $("#progressBar_location").text("complete");
         setTimeout(function() {
             $("#upload_location").submit();
         }, 1000);

     }


     function errorHandler2(event) {
         $(".progress.progress-lg.mt-2.location").remove();
         $(".btn-upload-location").before(`<span id="status_upload" class="red">Upload Failed</span>`);
     }

     function abortHandler2(event) {
         $(".progress.progress-lg.mt-2.location").remove();
         $(".btn-upload-location").before(`<span id="status_upload" class="red">Upload Failed</span>`);
     }
 </script>
 <script>
     $('#drop a').click(function() {
         $(this).parent().find('input').click();
     });
     $("#file_upload").change(function() {
         $(".font-20.padding-left-10").empty();
         var file = $("#file_upload").prop("files")[0];
         $(".font-20.padding-left-10").append(file.name);
     });
     $(".btn-upload").click(function() {
         $(".btn-upload").attr("disabled", true);


         var file = $("#file_upload").prop("files")[0];

         if (file) {
             $(".progress.progress-lg.mt-2").remove();
             $(".btn-upload").before(`
            <div class="progress progress-lg mt-2" style="margin-bottom:20px;">
                <div id="progressBar" class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>          
                </div>`);
             var formdata = new FormData();
             formdata.append("file_upload", file);
             var ajax = new XMLHttpRequest();
             ajax.upload.addEventListener("progress", progressHandler, false);
             ajax.addEventListener("load", completeHandler, false);
             ajax.addEventListener("error", errorHandler, false);
             ajax.addEventListener("abort", abortHandler, false);
             ajax.open("POST", base_url + "upload");
             ajax.send(formdata);
         } else {
             swal({
                 text: 'Please select file',
                 icon: 'warning',
                 timer: 1500,
                 button: false
             });
             $(".btn-upload").attr("disabled", false);
         }
     });

     function progressHandler(event) {
         var percent = (event.loaded / event.total) * 100;
         $("#progressBar").text(Math.round(percent) + "%");
         $("#progressBar").css('width', Math.round(percent) + '%');
     }

     function completeHandler(event) {
         $("#progressBar").text("complete");
         setTimeout(function() {
             $("#upload").submit();
         }, 1000);

     }


     function errorHandler(event) {
         $(".progress.progress-lg.mt-2").remove();
         $(".btn-upload").before(`<span id="status_upload" class="red">Upload Failed</span>`);
     }

     function abortHandler(event) {
         $(".progress.progress-lg.mt-2").remove();
         $(".btn-upload").before(`<span id="status_upload" class="red">Upload Failed</span>`);
     }
 </script>