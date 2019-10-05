<?php
include("libs/PHPExcel-1.8/Classes/PHPExcel.php");
include("colltrollers/excel_to_array_char.php");

    $base_url = URL;

    function prepare_data($data) {

        if ($data)
            return $data;
        else
            return "";

    }

    function search_id($item) {
        $chk = false;
        $.ajax({
            url: $base_url + "/upload/check_accession_physical",
            method: "POST",
            async: false,
            data: {
                accession_number: item
            },
            success: function(data) {
                chk = data;
            },
            error: function(data) {
                //console.log("error");
                //console.log(data);                        
            }
        });
        return chk;

    }

    function searchdata(item) {
        var item_data;
        $.ajax({
            url: base_url + "/upload/search_id",
            method: "POST",
            async: false,
            data: {
                accession_number: item
            },
            success: function(data) {
                item_data = data;
                
            },
            error: function(data) {
                //console.log("error");
                //console.log(data);                        
            }
        });
        console.log(item_data);
        return item_data;
      
    }

    function toFixed(num, pre) {
        num *= Math.pow(10, pre);
        num = (Math.round(num, pre) + (((num - Math.round(num, pre)) >= 0.5) ? 1 : 0)) / Math.pow(10, pre);
        return num.toFixed(pre);
    }

    function check_format(array, header, index_accession) {
        if (array[0].length == header.length) {

            var check = true;
            for (var i = 0; i < array[0].length; i++) {
                if (array[0][i] != header[i]) {
                    check = false;
                    break;
                }
            }
            if (check) {
                var duplicate = [];

                for (var i = 0; i < array.length; i++) {
                    for (var j = 0; j < array.length; j++) {
                        if (array[i][index_accession] == array[j][index_accession] && i != j) {
                            if (duplicate.indexOf(array[i][index_accession]) == -1 || duplicate.length == 0)
                                duplicate.push(array[i][index_accession]);
                        }
                    }
                }

                if (duplicate.length != 0) {
                    return [false, duplicate];
                } else {
                    return [true, ""];
                }

            } else {
                return [false, "Invalid excel template.Please download example file and upload again"];
            }

        } else {
            return [false, "Invalid excel template.Please download example file and upload again"];
        }
    }

    var table_value = <?php echo json_encode($table_value); ?>;
    var ex_list = <?php echo json_encode($data_arr); ?>;
    //console.log(table_value);
    console.log(ex_list);
    console.log(5 + 6);
   

    var id = [];
    var acc = [];
    var check_add = 0;
    var chkLength = 0;
    var head = ["accession_number", "hypocotyl_colour", "hypocotyl_colour_intensity", "hypocotyl_pubescence", "primary_leaf_length_mm", "primary_leaf_width_mm", "plant_growth_type", "plant_size", "vine_length_cm", "stem_pubescence_density", "stem_internode_length", "foliage_density", "number_of_leaves_under_1st_inflorescence", "leaf_attitude", "leaf_type", "degree_of_leaf_dissection", "anthocyanin_colouration_of_leaf_veins", "inflorescence_type", "corolla_colour", "corolla_blossom_type", "flower_sterility_type", "petal_length_cm", "sepal_length_cm", "style_position", "style_shape", "style_hairiness", "stamen_length_cm", "dehiscence", "exterior_colour_of_immature_fruit", "presence_of_green_shoulder_trips_on_the_fruit", "intensity_of_greenback", "fruit_pubescence", "predominant_fruit_shape", "fruit_size", "fruit_size_homogeneity", "fruit_weight_g", "fruit_length_mm", "fruit_width_mm", "exterior_colour_of_mature_fruit", "intensity_of_exterior_colour", "ribbing_at_calyx_end", "easiness_of_fruit_to_detach_from_pedicel", "fruit_shoulder_shape", "pedicel_length_mm", "pedicel_length_from_abscission_layer", "presence_absence_of_jiontless_pedicel", "width_of_pedicel_scar_mm", "size_of_corky_area_around_pedicel_scar_cm", "easiness_of_fruit_wall_skin_to_be_peeled", "skin_colour_of_ripe_fruit", "thickness_of_fruit_wall_skin_mm", "thickness_of_pericarp_mm", "flesh_colour_of_peiricarp_interior", "flesh_colour_intensity", "colour_intensity_of_core", "fruit_cross_sectional_shape", "size_of_score_mm", "number_of_locules", "shape_of_pistil_scar", "fruit_blossom_end_shape", "blossom_end_scar_condition", "fruit_firmness_after_storage", "seed_shape", "seed_colour", "1000_seed_weight_g"];
    var format = ["Accession number", "Hypocotyl colour", "Hypocotyl colour intensity", "Hypocotyl pubescence", "Primary leaf length (mm)", "Primary leaf width (mm)", "Plant growth type", "Plant size", "Vine length (cm)", "Stem pubescence density", "Stem internode length", "Foliage density", "Number of leaves under 1st inflorescence", "Leaf attitude", "Leaf type", "Degree of leaf dissection", "Anthocyanin colouration of leaf veins", "Inflorescence type", "Corolla colour", "Corolla blossom type", "Flower sterility type", "Petal length (cm)", "Sepal length (cm)", "Style position", "Style shape", "Style hairiness", "Stamen length (cm)", "Dehiscence", "Exterior colour of immature fruit", "Presence of green (shoulder) trips on the fruit", "Intensity of greenback", "Fruit pubescence", "Predominant fruit shape", "Fruit size", "Fruit size homogeneity", "Fruit weight (g)", "Fruit length (mm)", "Fruit width (mm)", "Exterior colour of mature fruit", "Intensity of exterior colour", "Ribbing at calyx end", "Easiness of fruit to detach from pedicel", "Fruit shoulder shape", "Pedicel length (mm)", "Pedicel length from abscission layer", "Presence/absence of jiontless pedicel", "Width of pedicel scar (mm)", "Size of corky area around pedicel scar (cm)", "Easiness of fruit wall (skin) to be peeled", "Skin colour of ripe fruit", "Thickness of fruit wall (skin) (mm)", "Thickness of pericarp (mm)", " Flesh colour of peiricarp (interior)", " Flesh colour intensity", "Colour (intensity) of core", "Fruit cross-sectional shape", "Size of score (mm)", "Number of locules", "Shape of pistil scar", "Fruit blossom end shape", "Blossom end scar condition", "Fruit firmness (after storage)", "Seed shape", "Seed colour", "1,000 seed weight (g)"];
    var int_value = ["primary_leaf_length_mm", "primary_leaf_width_mm", "vine_length_cm", "petal_length_cm", "sepal_length_cm", "stamen_length_cm", "fruit_weight_g", "fruit_length_mm", "fruit_width_mm", "pedicel_length_mm", "pedicel_length_from_abscission_layer", "width_of_pedicel_scar_mm", "size_of_corky_area_around_pedicel_scar_cm", "thickness_of_fruit_wall_skin_mm", "thickness_of_pericarp_mm", "size_of_score_mm", "number_of_locules", "1000_seed_weight_g"];
    $("#data").on("click", "td.table-danger,td.bg-danger", function() {
        
        var str = $(this).find('input[type="checkbox"]').val();
        var res = str.split("@");
       
        var id = $(this)[0].id;

        $("#title_edit").empty();
        $(".select-form").empty();
        $("#title_edit").append(res[0].replace(/_/g, " "));
        $("#title_edit").attr("data-target-value", id);
        if (int_value.indexOf(res[0]) != -1) {
            $(".select-form").append(`<input type="text" data-col= "` + res[0] + `" value="` + res[1] + `" class="form-control select-modal">`);
        } else {
            $(".select-form").append(`<select class="form-control select-modal" data-col= "` + res[0] + `">`);
            for (var x in table_value[res[0]]) {
                if (table_value[res[0]][x] == res[1]) {
                    $(".select-modal").append(`<option selected value="` + table_value[res[0]][x] + `"> ` + table_value[res[0]][x] + `</option>`);
                } else {
                    $(".select-modal").append(`<option value="` + table_value[res[0]][x] + `"> ` + table_value[res[0]][x] + `</option>`);
                }
            }
            $(".select-form").append("</select>");
        }
        $("#edit-modal").modal();
    });
    $("#data").on("click", "td.bg-danger-add,td.table-danger-add", function() {
       
        var str = $(this).attr("data-dataval");
        var val_data = $("#" + str).val();
        var res = val_data.split("@");
        $("#title_edit-add").empty();
        $(".select-form-add").empty();
        $("#title_edit-add").append(res[0].replace(/_/g, " "));
        $("#title_edit-add").attr("data-target-value", str);
        $("#title_edit-add").attr("data-target-html", "add-" + str);
        if (int_value.indexOf(res[0]) != -1) {
            $(".select-form-add").append(`<input type="text" data-col= "` + res[0] + `" value="` + res[1] + `" class="form-control select-modal-add">`);
        } else {
            $(".select-form-add").append(`<select class="form-control select-modal-add" data-col= "` + res[0] + `">`);
            for (var x in table_value[res[0]]) {
                if (table_value[res[0]][x] == res[1]) {
                    $(".select-modal-add").append(`<option selected value="` + table_value[res[0]][x] + `"> ` + table_value[res[0]][x] + `</option>`);
                } else {
                    $(".select-modal-add").append(`<option value="` + table_value[res[0]][x] + `"> ` + table_value[res[0]][x] + `</option>`);
                }
            }
            $(".select-form-add").append("</select>");
        }
        $("#edit-modal-add").modal();
    });
    $("#edit-modal").on("click", ".btn-success", function() {
        var value = $(".select-modal").val();
        var colum = $(".select-modal").attr("data-col");
        var target = $("#title_edit").attr("data-target-value");
        var value2 = value;
        $(".check_input_edit").remove();
        if (value && value2.toString().replace("-", "").trim().length > 0) {
            if (int_value.indexOf(colum) != -1 && !($.isNumeric(value))) {
                $(".select-modal").after(`<br><span class="text-danger check_input_edit mt-1" style="font-size:0.75rem;"> Please enter value number,Value can't be space or - </span>`);
            } else {
                $("#" + target).addClass("table-danger");
                $("#" + target).removeClass("bg-danger");
                $("#" + target).find('lable[class="new"]').html(value);
                $("#" + target).find('input[type="checkbox"]').val(colum + "@" + value);

                $("#" + target).find('div').find('span[class="new"]').html(value);
                $("#" + target).tooltip("dispose");
                $("#edit-modal").modal('hide');
            }

        } else {
            $(".select-modal").after(`<span class="text-danger check_input_edit mt-1" style="font-size:0.75rem;"> value can't be space or - </span>`)
        }

    });
    $("#edit-modal-add").on("click", ".btn-success-add", function() {
        var value = $(".select-modal-add").val();
        var colum = $(".select-modal-add").attr("data-col");
        var target = $("#title_edit-add").attr("data-target-value");
        var target2 = $("#title_edit-add").attr("data-target-html");
        var value2 = value;
        $(".check_input_edit").remove();
        if (value && value2.toString().replace("-", "").trim().length > 0) {
            if (int_value.indexOf(colum) != -1 && !($.isNumeric(value))) {
                $(".select-modal-add").after(`<span class="text-danger check_input_edit mt-1" style="font-size:0.75rem;"> Please enter value number,Value can't be space or - </span>`);
            } else {
                $("#" + target2).addClass("table-danger-add");
                $("#" + target2).removeClass("bg-danger-add");
                $("#" + target).val(colum + "@" + value);
                $("#" + target2).html(value);
                $("#" + target2).tooltip("dispose");
                $("#edit-modal-add").modal('hide');
            }

        } else {
            $(".select-modal-add").after(`<span class="text-danger check_input_edit mt-1" style="font-size:0.75rem;"> value can't be space or - </span>`);
        }

    });
    var input_check = check_format(ex_list, format, 0);
    console.log(input_check[0]);
    if (input_check[0]) {
        for (var i = 0; i < ex_list[0].length; i++) {
            var num_id = 1;
            if (i == 0) {
                $("thead").append("<tr id='col_" + i + "'>");
                for (var j = 0; j < ex_list.length; j++) {
                    ex_list[j][i] = prepare_data(ex_list[j][i]);
                    acc.push(searchdata(ex_list[j][i]));
                    if (i == 0 && j == 0)
                        $("#col_" + i).append("<th>" + ex_list[j][i] + "</th>");
                    else if (search_id(ex_list[j][i]) && i == 0) {
                        id.push(ex_list[j][i]);
                        $("#col_" + i).append(`<th>` + ex_list[j][i] + `<lable style="font-weight:normal">  Replace All</lable> <input data-colum="NO` + j + `"class="NO_All NO_All` + j + `_check" type="checkbox" checked/></th>`);
                    } else if (i == 0) {
                        $("#col_" + i).append(`<th>` + ex_list[j][i] + `<lable style="font-weight:normal">  Add </lable> <input data-colum="NO` + j + `" class="NO` + j + `_INSERT NO_All` + j + `_check" type="checkbox" checked/></th>`);
                    }
                }
            } else {

                $("tbody").append("<tr id='col_" + i + "'>");
                for (var j = 0; j < ex_list.length; j++) {
                    ex_list[j][i] = prepare_data(ex_list[j][i]);
                   
                    if (j == 0) {
                        $("#col_" + i).append("<td>" + ex_list[j][i] + "</td>");
                    } else if (ex_list[j][0] == id[num_id - 1]) {
                        num_id++;
                        if (ex_list[j][i] != acc[j][head[i]]) {

                            var data1 = acc[j][head[i]];
                            var data2 = ex_list[j][i];
                            if ($.isNumeric(acc[j][head[i]]))
                                data1 = toFixed(acc[j][head[i]], 2);
                            if ($.isNumeric(ex_list[j][i]))
                                data2 = toFixed(ex_list[j][i], 2);

                            if (data1 !== data2 && data1 != null && data2 != null) {
                                var oob = null;
                                var check_value_table = true;
                                if (table_value[head[i]]) {
                                    oob = Object.values(table_value[head[i]]);

                                    if (oob.indexOf(data2) == -1) {
                                        check_value_table = false;

                                    }


                                }
                                if (!check_value_table) {

                                    $("#col_" + i).append(`<td class='bg-danger' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
                           <input type='hidden' name="NO` + j + `[]" value="update">
                           <input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
                           <input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked><lable style="font-weight:normal" class='new'>` + data2 + `</lable>
                           <div>` + data1 + `,<span class='new'>` + data2 + `</span>
                           </div></td>`);
                                } else {
                                    if ($.isNumeric(data2) && data2.toString().trim().length != 0 && int_value.indexOf(head[i]) != -1) {

                                        $("#col_" + i).append(`<td class='table-danger ' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
                           <input type='hidden' name="NO` + j + `[]" value="update">
                           <input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
                           <input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked><lable style="font-weight:normal" class='new'>` + data2 + `</lable>
                           <div>` + data1 + `,<span class='new'>` + data2 + `</span>
                           </div></td>`);
                                    } else if (int_value.indexOf(head[i]) == -1) {

                                       
                                        $("#col_" + i).append(`<td class='table-danger ' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
                           <input type='hidden' name="NO` + j + `[]" value="update">
                           <input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
                           <input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked><lable style="font-weight:normal" class='new'>` + data2 + `</lable>
                           <div>` + data1 + `,<span class='new'>` + data2 + `</span>
                           </div></td>`);
                                    } else {
                                        $("#col_" + i).append(`<td class='bg-danger ' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
                           <input type='hidden' name="NO` + j + `[]" value="update">
                           <input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
                           <input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked><lable style="font-weight:normal" class='new'>` + data2 + `</lable>
                           <div>` + data1 + `,<span class='new'>` + data2 + `</span>
                           </div></td>`);
                                    }

                                }



                                if (chkLength == 0) {
                                    chkLength++;
                                    $("#col_" + i).append(`<input type='hidden' name='length' value='` + (ex_list.length) + `'>`);
                                }
                            } else if (data1 == null && data2 == '') {
                                $("#col_" + i).append(`<td></td>`);
                            } else if (data1 == null && data2 != '') {
                                $("#col_" + i).append(`<td class='table-danger' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
                           <input type='hidden' name="NO` + j + `[]" value="update">
                           <input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
                           <input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked><lable style="font-weight:normal" class='new'>` + data2 + `</lable>
                           <div> ,<span class='new'>` + data2 + `</span>
                           </div></td>`);
                                if (chkLength == 0) {
                                    chkLength++;
                                    $("#col_" + i).append(`<input type='hidden' name='length' value='` + (ex_list.length) + `'>`);
                                }
                            } else {
                                $("#col_" + i).append(`<td>` + data1 + `</td>`);
                            }



                        } else {
                            $("#col_" + i).append("<td>" + acc[j][head[i]] + "</td>");
                        }
                    } else {
                        $("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="insert">`);
                        if (i == 1) {
                            $("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="` + head[0] + `@` + ex_list[j][0] + `">`);
                            $("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="insert">`);

                        }
                        if (chkLength == 0) {
                            chkLength++;
                            $("#col_" + i).append(`<input type='hidden' name='length' value='` + (ex_list.length) + `'>`);
                        }
                        var oob = null;
                        var check_value_table = true;
                        if (table_value[head[i]]) {
                            oob = Object.values(table_value[head[i]]);
                            if (oob.indexOf(ex_list[j][i]) == -1) {
                                check_value_table = false;
                            }
                        }


                        if (!check_value_table) {
                            $("#col_" + i).append(`<input type='hidden' id="` + ex_list[j][0] + `-` + head[i] + `" name="NO` + j + `[]" value="` + head[i] + `@` + ex_list[j][i] + `">`);
                            $("#col_" + i).append(`<td class='bg-danger-add' id="add-` + ex_list[j][0] + `-` + head[i] + `" data-dataval="` + ex_list[j][0] + `-` + head[i] + `">` + ex_list[j][i] + `</td>`);

                        } else {

                            if ($.isNumeric(ex_list[j][i]) && ex_list[j][i].toString().trim().length != 0 && int_value.indexOf(head[i]) != -1) {

                                $("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="` + head[i] + `@` + ex_list[j][i] + `">`);
                                $("#col_" + i).append(`<td class='table-primary'>` + ex_list[j][i] + `</td>`);
                            } else if (int_value.indexOf(head[i]) == -1) {
                                $("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="` + head[i] + `@` + ex_list[j][i] + `">`);
                                $("#col_" + i).append(`<td class='table-primary'>` + ex_list[j][i] + `</td>`);
                            } else {
                                $("#col_" + i).append(`<input type='hidden' id="` + ex_list[j][0] + `-` + head[i] + `" name="NO` + j + `[]" value="` + head[i] + `@` + ex_list[j][i] + `">`);
                                $("#col_" + i).append(`<td class='bg-danger-add' id="add-` + ex_list[j][0] + `-` + head[i] + `" data-dataval="` + ex_list[j][0] + `-` + head[i] + `">` + ex_list[j][i] + `</td>`);
                            }
                        }


                    }

                }
            }
        }
    } else {
        $("#form_check").empty();
        if (Array.isArray(input_check[1])) {
            $("#form_check").append(` <div class="alert alert-danger" role="alert"> <i class="mdi mdi-close-circle-outline"></i>  Accession is duplicate. Please edit and upload again.</div> `);
            $("#form_check").append(`<div class="alert alert-light" id="detail-accession">`);
            input_check[1].forEach(function(element, index) {
                $("#detail-accession").append(`<span class="text-danger">` + element + "</span>");
                if (index != input_check[1].length - 1)
                    $("#detail-accession").append(`<span> , </span>`);
            });
        } else {
            $("#form_check").append(`  <div class="alert alert-danger" role="alert"> <i class="mdi mdi-close-circle-outline"></i> ` + input_check[1] + `</div>
            <div class="button-left">
                    <input type="button" class="btn btn-success" onclick="location.href='<?php echo URL ?>upload';" value="Back" />
                </div>`);
        }


    }

    $('#btn-sub').click(function() {
        var num = 0;
        var num2 = 0;
        for (var j = 0; j < ex_list.length; j++) {
            var x = $(".NO_All" + j + "_check").prop("checked");
            if (x == false) {
                $("input[name*=NO" + j + "]").remove();
                num++;
                num2++;
            } else if (x) {
                num2++;
            }
        }
        if (num == num2) {
            $("input[name='length']").remove();
        }
        var array_config = $(".bg-danger,.bg-danger-add");
        if (array_config.length > 0) {
            for (var x = 0; x < array_config.length; x++) {
                var id = array_config[x].id;
                $("#" + id).attr("title", "Please change value !");
                $("#" + id).find("input[type='checkbox']").focus();
                $("#" + id).tooltip('show');
                break;
            }
        } else {
            $("#form_upload").submit();
        }

    });
</script>
<script>
    $(document).ready(function() {
        $('#data').DataTable({
            fixedColumns: {
                leftColumns: 1
            },
            scrollY: "400px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false,
            columnDefs: [{
                searchable: false,
                targets: 0
            }]
        });
        $(".NO_All").click(function() {
            var s = $(this).attr("data-colum");
            var x = $(this).prop("checked");
            if (x) {
                $("input[name='" + s + "[]']").prop("checked", true);
            } else {
                $("input[name='" + s + "[]']").prop("checked", false);
            }
        });
    });
</script>

?>