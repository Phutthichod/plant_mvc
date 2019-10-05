<?php
require 'models/char_data_model.php';
require 'models/location_model.php';
require 'models/genome_data_model.php';
class Upload_history extends Controller
{
	//จาก upload
	private $user_id;
	private $plant_id;
	private $plant_type;
	private $table;

	public function __construct()
	{
		Auth::handleLogin();
		parent::__construct();
		$this->table = Char_data_Model::get_all_table_value();
		$this->user_id = Session::get('member')['id_member'];
		$this->plant_type = Session::get('plant_type');
		$this->plant_id = Session::get('plant_id');
	}

	public function index()
	{
		//Session:init();
		//Session::get([key]);
		//$check =Char_data_Model::update_data();
		//print_r($check);

		$this->view->name_type = $this->check_type();
		$this->view->render('upload_history/index');
	}

	//จาก helper
	public function excel_to_array_char()
	{
		// print_r($this->table) ;
		// echo "<br/>";

		$file = $_FILES['upl'];
		// $table_value = Char_data_Model::get_all_table_value();
		include("libs/PHPExcel-1.8/Classes/PHPExcel.php");
		$tmpFile =$file["tmp_name"];
		$fileName =$file["name"];  // เก็บชื่อไฟล์
		$info = pathinfo($fileName);
		$allow_file = array("csv", "xls", "xlsx");

		//print_r($info);  // ข้อมูลไฟล์   
		//print_r($fileName);

		if ($fileName != "" && in_array($info['extension'], $allow_file)) {
			// อ่านไฟล์จาก path temp ชั่วคราวที่เราอัพโหลด
			$objPHPExcel = PHPExcel_IOFactory::load($tmpFile);

			// ดึงข้อมูลของแต่ละเซลในตารางมาไว้ใช้งานในรูปแบบตัวแปร array
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

			// วนลูปแสดงข้อมูล
			$data_arr = array();
			foreach ($cell_collection as $cell) {
				// ค่าสำหรับดูว่าเป็นคอลัมน์ไหน เช่น A B C ....
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				// คำสำหรับดูว่าเป็นแถวที่เท่าไหร่ เช่น 1 2 3 .....
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				// ค่าของข้อมูลในเซลล์นั้นๆ เช่น A1 B1 C1 ....
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

				// เริ่มขึ้นตอนจัดเตรียมข้อมูล
				// เริ่มเก็บข้อมูลบรรทัดที่ 2 เป็นต้นไป
				$start_row = 1;
				// กำหนดชื่อ column ที่ต้องการไปเรียกใช้งาน
				//$col_name[] = array( "A"=>"0");
				//$col_name[] = array( "B"=>"1");
				//print_r($col_name);
				$col_name = array(
					"A" => "0", "B" => "1", "C" => "2", "D" => "3", "E" => "4", "F" => "5", "G" => "6", "H" => "7", "I" => "8",
					"J" => "9", "K" => "10", "L" => "11", "M" => "12", "N" => "13", "O" => "14", "P" => "15", "Q" => "16",
					"R" => "17", "S" => "18", "T" => "19", "U" => "20", "V" => "21", "W" => "22", "X" => "23", "Y" => "24",
					"Z" => "25", "AA" => "26", "AB" => "27", "AC" => "28", "AD" => "29", "AE" => "30", "AF" => "31", "AG" => "32",
					"AH" => "33", "AI" => "34", "AJ" => "35", "AK" => "36", "AL" => "37", "AM" => "38", "AN" => "39", "AO" => "40",
					"AP" => "41", "AQ" => "42", "AR" => "43", "AS" => "44", "AT" => "45", "AU" => "46", "AV" => "47", "AW" => "48",
					"AX" => "49", "AY" => "50", "AZ" => "51", "BA" => "52", "BB" => "53", "BC" => "54", "BD" => "55", "BE" => "56",
					"BF" => "57", "BG" => "58", "BH" => "59", "BI" => "60", "BJ" => "61", "BK" => "62", "BL" => "63", "BM" => "64"
					// "BN"=>"65","BO"=>"66","BP"=>"67","BQ"=>"68","BR"=>"69","BS"=>"70","BT"=>"71","BU"=>"72",
					// "BV"=>"73","BW"=>"74","BX"=>"75","BY"=>"76","BZ"=>"77","CA"=>"78","CB"=>"79","CC"=>"80",
					// "CD"=>"81","CE"=>"82","CF"=>"83"
				);
					if ($row >= $start_row) {
						$data_arr[$row - $start_row][$col_name[$column]] = $data_value;
					}
				}
			//print_r($data_arr);
			return $data_arr;
		}
		
	}
	
	function check_inva()
	{
		$format = ["Accession number", "Hypocotyl colour", "Hypocotyl colour intensity", "Hypocotyl pubescence", "Primary leaf length (mm)", 
        "Primary leaf width (mm)", "Plant growth type", "Plant size", "Vine length (cm)", "Stem pubescence density", "Stem internode length", 
        "Foliage density", "Number of leaves under 1st inflorescence", "Leaf attitude", "Leaf type", "Degree of leaf dissection", "Anthocyanin colouration of leaf veins",
        "Inflorescence type", "Corolla colour", "Corolla blossom type", "Flower sterility type", "Petal length (cm)", "Sepal length (cm)", 
        "Style position", "Style shape", "Style hairiness", "Stamen length (cm)", "Dehiscence", "Exterior colour of immature fruit", "Presence of green (shoulder) trips on the fruit",
        "Intensity of greenback", "Fruit pubescence", "Predominant fruit shape", "Fruit size", "Fruit size homogeneity", "Fruit weight (g)", 
        "Fruit length (mm)", "Fruit width (mm)", "Exterior colour of mature fruit", "Intensity of exterior colour", "Ribbing at calyx end",
        "Easiness of fruit to detach from pedicel", "Fruit shoulder shape", "Pedicel length (mm)", "Pedicel length from abscission layer", "Presence/absence of jiontless pedicel", 
        "Width of pedicel scar (mm)", "Size of corky area around pedicel scar (cm)", "Easiness of fruit wall (skin) to be peeled", "Skin colour of ripe fruit",
        "Thickness of fruit wall (skin) (mm)", "Thickness of pericarp (mm)", " Flesh colour of peiricarp (interior)", " Flesh colour intensity", 
        "Colour (intensity) of core", "Fruit cross-sectional shape", "Size of score (mm)", "Number of locules", "Shape of pistil scar", "Fruit blossom end shape",
        "Blossom end scar condition", "Fruit firmness (after storage)", "Seed shape", "Seed colour", "1,000 seed weight (g)"];

		$int_value = ["primary_leaf_length_mm", "primary_leaf_width_mm", "vine_length_cm", "petal_length_cm", "sepal_length_cm", "stamen_length_cm", 
        "fruit_weight_g", "fruit_length_mm", "fruit_width_mm", "pedicel_length_mm", "pedicel_length_from_abscission_layer", "width_of_pedicel_scar_mm", 
        "size_of_corky_area_around_pedicel_scar_cm", "thickness_of_fruit_wall_skin_mm", "thickness_of_pericarp_mm", "size_of_score_mm", "number_of_locules",
		"1000_seed_weight_g"];
		
		$arr_excel = $this->excel_to_array_char();

		//echo sizeof($arr_excel);
		// for($i=0 ;$i<=64 ;$i++){
			// for($j=0 ;$j<=8 ;$j++){
			// 	echo $arr_excel[$j][0]."  ";
			// 	echo "<br/>";
			//  }
			
		// }
		$table_value = $this->table;
		$input_check = $this->check_format($arr_excel,$format,0); 
		print_r($input_check);

		// if ($input_check[0]) {
		// 	 for ($i = 0; $i < sizeof($arr_excel[0]) ;$i++) { // i=collum=65
		// 	 	$num_id = 1;
		// 		if ($i == 0) { //เชคแถวแรก
		// 			for ($j = 0; $j < sizeof($arr_excel); $j++) {  // j=row=8
		// 				$ex_list[j][i] = prepare_data($ex_list[j][i]); //แถวขยับ คอลัม 0 
		// 				acc.push(searchdata(ex_list[j][i])); //acc เก็บ data จาก db
	
		// 				// console.log("ex="+ex_list[j][i]);
		// 				// console.log("acc="+acc);
	
		// 				if (i == 0 && j == 0) 
		// 					$("#col_" + i).append("<th>" + ex_list[j][i] + "</th>"); //แสดง head จาก excel ที่ตรงกับ db
	
		// 				else if (search_id(ex_list[j][i]) && i == 0) { //access number จาก excel มีใน db ไหม
		// 					id.push(ex_list[j][i]); //id เก็บ access number 
		// 					$("#col_" + i).append(`<th>` + ex_list[j][i] + `<lable style="font-weight:normal">Replace All</lable> 
		// 					<input data-colum="NO` + j + `"class="NO_All NO_All` + j + `_check" type="checkbox" checked/></th>`);
							
		// 				} else if (i == 0) { //access number ที่ add เพิ่มเข้ามาจาก excel ไม่มีอยู่ใน db
		// 					$("#col_" + i).append(`<th>` + ex_list[j][i] + `<lable style="font-weight:normal">  
		// 					Add </lable> <input data-colum="NO` + j + `" class="NO` + j + `_INSERT NO_All` + j + `_check" type="checkbox" checked/></th>`);
		// 				}
		// 			}
		// 		} 

				// else { //เชคแถวที่2 เป็นต้นไป i>=1
				// 	$("tbody").append("<tr id='col_" + i + "'>");
	
				// 	for (var j = 0; j < ex_list.length; j++) { //data แต่ละคอลัม
				// 		ex_list[j][i] = prepare_data(ex_list[j][i]); 
					   
				// 		if (j == 0) {
				// 			$("#col_" + i).append("<td>" + ex_list[j][i] + "</td>");
	
				// 		} else if (ex_list[j][0] == id[num_id - 1]) { //ถ้าaccess number จาก excel == id[...] ที่ push มาตอนเชคมาตอนเชคว่า else if (search_id(ex_list[j][i]) && i == 0)
				// 			num_id++;
				// 			if (ex_list[j][i] != acc[j][head[i]]) { 
				// 				 console.log("i="+i+" "+head[i]);
				// 				// console.log("ex["+i+"]="+ex_list[j][i]);
				// 				 console.log(acc);
	
				// 				var data1 = acc[j][head[i]];
				// 				var data2 = ex_list[j][i];
	
				// 				if ($.isNumeric(acc[j][head[i]])){ 
				// 					data1 = toFixed(acc[j][head[i]], 2);
				// 					// console.log("data = "+data1);
				// 				}
									
				// 				if ($.isNumeric(ex_list[j][i])){
				// 					data2 = toFixed(ex_list[j][i], 2);
				// 					// console.log("excel ["+j+"]["+i+"]="+data2);
				// 				}
									
				// 				if (data1 != data2 && data1 != null && data2 != null) {
				// 					var oob = null;
				// 					var check_value_table = true;
	
				// 					// console.log("ij["+j+"]["+i+"]="); 
				// 					// console.log(table_value[head[i]]); //object of ตำแหน่งที่ผิดหรือถูกแล้วที่ของไฟล excel แต่ยังไม่ได้ upload
				// 					//print_r(table_value[head[i]]);
									
	
				// 					if (table_value[head[i]]) { //object 
				// 						oob = Object.values(table_value[head[i]]); //Array
				// 						// console.log(oob); 
	
				// 						if (oob.indexOf(data2) == -1) { //ตำแหน่งที่ผิด(สีแดง)ใน excel ค่า
				// 							check_value_table = false;
				// 							// console.log("oob=");
				// 							// console.log(oob.indexOf(data2)); 
				// 						}
				// 					}
	
				// 					if (!check_value_table) { //ถ้าผิดไปทำตารางสีแดง
				// 						$("#col_" + i).append(`<td class='bg-danger' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
				// 						<input type='hidden' name="NO` + j + `[]" value="update">
				// 						<input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
				// 						<input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked>
				// 							<lable style="font-weight:normal" class='new'>` + data2 + `</lable>
				// 						<div>` + data1 + `,<span class='new'>` + data2 + `</span>
				// 						</div></td>`);
				// 					} else { //ถ้าถูก
				// 						if ($.isNumeric(data2) && data2.toString().trim().length != 0 && int_value.indexOf(head[i]) != -1) {
				// 							$("#col_" + i).append(`<td class='table-danger ' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
				// 							<input type='hidden' name="NO` + j + `[]" value="update">
				// 							<input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
				// 							<input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked>
				// 								<lable style="font-weight:normal" class='new'>` + data2 + `</lable>
				// 							<div>` + data1 + `,<span class='new'>` + data2 + `</span>
				// 							</div></td>`);
	
				// 						} else if (int_value.indexOf(head[i]) == -1) {
				// 							$("#col_" + i).append(`<td class='table-danger ' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
				// 							<input type='hidden' name="NO` + j + `[]" value="update">
				// 							<input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
				// 							<input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked>
				// 								<lable style="font-weight:normal" class='new'>` + data2 + `</lable>
				// 							<div>` + data1 + `,<span class='new'>` + data2 + `</span>
				// 							</div></td>`);
	
				// 						} else {
				// 							$("#col_" + i).append(`<td class='bg-danger ' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
				// 							<input type='hidden' name="NO` + j + `[]" value="update">
				// 							<input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
				// 							<input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked>
				// 								<lable style="font-weight:normal" class='new'>` + data2 + `</lable>
				// 							<div>` + data1 + `,<span class='new'>` + data2 + `</span>
				// 							</div></td>`);
				// 						}
				// 					}
	
				// 					if (chkLength == 0) {
				// 						chkLength++;
				// 						$("#col_" + i).append(`<input type='hidden' name='length' value='` + (ex_list.length) + `'>`);
				// 					}
				// 					} else if (data1 == null && data2 == '') {
				// 						$("#col_" + i).append(`<td></td>`);
				// 					} else if (data1 == null && data2 != '') {
				// 						$("#col_" + i).append(`<td class='table-danger' id='` + ex_list[j][0] + `-` + head[i] + `'>                       
				// 						<input type='hidden' name="NO` + j + `[]" value="update">
				// 						<input type='hidden' name="NO` + j + `[]" value="` + ex_list[j][0] + `">                           
				// 						<input type='checkbox' name="NO` + j + `[]" value="` + head[i] + `@` + data2 + `" checked>
				// 							<lable style="font-weight:normal" class='new'>` + data2 + `</lable>
				// 						<div> ,<span class='new'>` + data2 + `</span>
				// 						</div></td>`);
				// 						if (chkLength == 0) {
				// 							chkLength++;
				// 							$("#col_" + i).append(`<input type='hidden' name='length' value='` + (ex_list.length) + `'>`);
				// 						}
				// 					} else {
				// 						$("#col_" + i).append(`<td>` + data1 + `</td>`);
				// 					}
	
				// 			} else {
				// 				$("#col_" + i).append("<td>" + acc[j][head[i]] + "</td>");
				// 				// console.log("acc["+i+"]="+acc[j][head[i]]);
				// 			}
	
				// 		} else { //ถ้าaccess number จาก excel != id[...] ที่ push มาตอนเชคมาตอนเชคว่า else if (search_id(ex_list[j][i]) && i == 0)
				// 				//add เข้ามาใน excel *access numberใหม่ จะทำพื้นหลังเป็นสีฟ้าต่อจากปกติ ที่เหลือก็ทำเหมือนเดิมหมด
				// 			$("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="insert">`);
				// 				if (i == 1) {
				// 					$("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="` + head[0] + `@` + ex_list[j][0] + `">`);
				// 					$("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="insert">`);
				// 				}
	
				// 				if (chkLength == 0) {
				// 					chkLength++;
				// 					$("#col_" + i).append(`<input type='hidden' name='length' value='` + (ex_list.length) + `'>`);
				// 				}
	
				// 				var oob = null;
				// 				var check_value_table = true;
				// 				if (table_value[head[i]]) {
				// 					oob = Object.values(table_value[head[i]]);
				// 					if (oob.indexOf(ex_list[j][i]) == -1) {
				// 						check_value_table = false;
				// 					}
				// 				}
	
				// 				if (!check_value_table) {
				// 					$("#col_" + i).append(`<input type='hidden' id="` + ex_list[j][0] + `-` + head[i] + `" name="NO` + j + `[]" value="` 
				// 					+ head[i] + `@` + ex_list[j][i] + `">`);
	
				// 					$("#col_" + i).append(`<td class='bg-danger-add' id="add-` + ex_list[j][0] + `-` + head[i] + `" data-dataval="` 
				// 					+ ex_list[j][0] + `-` + head[i] + `">` + ex_list[j][i] + `</td>`);
	
				// 				} else {
				// 					if ($.isNumeric(ex_list[j][i]) && ex_list[j][i].toString().trim().length != 0 && int_value.indexOf(head[i]) != -1) {
				// 						$("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="` + head[i] + `@` + ex_list[j][i] + `">`);
				// 						$("#col_" + i).append(`<td class='table-primary'>` + ex_list[j][i] + `</td>`);
				// 					} else if (int_value.indexOf(head[i]) == -1) {
				// 						$("#col_" + i).append(`<input type='hidden' name="NO` + j + `[]" value="` + head[i] + `@` + ex_list[j][i] + `">`);
				// 						$("#col_" + i).append(`<td class='table-primary'>` + ex_list[j][i] + `</td>`);
				// 					} else {
				// 						$("#col_" + i).append(`<input type='hidden' id="` + ex_list[j][0] + `-` + head[i] + `" name="NO` + j + `[]" value="` 
				// 						+ head[i] + `@` + ex_list[j][i] + `">`);
	
				// 						$("#col_" + i).append(`<td class='bg-danger-add' id="add-` + ex_list[j][0] + `-` + head[i] + `" data-dataval="` 
				// 						+ ex_list[j][0] + `-` + head[i] + `">` + ex_list[j][i] + `</td>`);
				// 					}
				// 				}
				// 		}
				// 	}
				// } //จบ else ของการเชคข้อมูล
		// 	 } //จบลูป check 
		// }

	}

	function check_format($array, $header, $index_accession) { //excel,format,0 เป็นฟังชันที่เอาไว้เชค head ของ table
		//print_r(sizeof($array[0])."+++".sizeof($header));
		echo sizeof($array);

        if(sizeof($array[0]) == sizeof($header)){ //มีจำนวนคอลัม excel ตรงกลับใน format ?
            $check = true;
            for ($i = 0 ;$i < sizeof($array[0]) ;$i++) {
				//echo $array[0][$i]."=".$header[$i]."<br>";
				if ($array[0][$i] != $header[$i]) { //เชคว่าคอลัมที่ i แถวแรกของ excel ตรงกลับใน format ?
                    $check = false; //ถ้ามีคอลัมที่ i ผิดตัวเดียวก็ออกจากลูป
                    break;
                }
			}

            if ($check) { //ทุกคอลัมของแถวแรก ตรงกับ format ทุกตัว
				$duplicate = array();
				
                for ($i = 0 ;$i < sizeof($array) ;$i++) { //วนลูปแถวและคอลัม ของ excel ที่โหลดมา 8 แถว
                    for ($j = 0 ;$j < sizeof($array) ;$j++) {
                       if ($array[$i][$index_accession] == $array[$j][$index_accession] && $i != $j) { //เทียบแถว i กับ j คอลัมที่ index_accession = 0
                	       if (array_search($array[$i][$index_accession],$duplicate) == -1 || sizeof($duplicate) == 0) //เชคว่าซ้ำไหม
                               $duplicate.push($array[$i][$index_accession]); //duplicate เก็บค่าของ array[i][index_accession]	
				 		}	
                   	}
				} 
				print_r($duplicate); //=0
                 if (sizeof($duplicate) != 0) { 
                    echo "pin";
                 } else {
                     return [true, "asd"];
                 }
			} 
			 else { //มีคอลัมแถวแรกใน excel ไม่ตรงกับ db
                return [false, "Invalid excel template.Please download example file and upload again"]; 
             }
		} 
		else { //จำนวนคอลัม excel ไม่ตรงกลับใน db
            return [false, "Invalid excel template.Please download example file and upload again"];
        } 
    }
	
	
	function prepare_data($data)
	{
		// กำหนดชื่อ filed ให้ตรงกับ $col_name ด้านบน
		$arr_field = array();
		if (is_array($data)) {
			foreach ($arr_field as $v) {
				if (!isset($data[$v])) {
					$data[$v] = "";
				}
			}
		}
		return $data;
	}

	function search_id($item, $List1)
	{
		$chk = false;
		for ($i = 0; $i < count($List1); $i++) {
			if ($List1[$i]['accession_number'] == $item) {
				$chk = true;
				break;
			}
		}
		return $chk;
	}

	
	public function check_type()
	{
		$check_type = $this->plant_type;
		$name_type = "";
		switch ($check_type) {
			default:
				$name_type = "Genome";
		}
		return $name_type;
	}

	public function excel_upload()
	{
		if (isset($_POST["length"])) {
			$length = $_POST['length'];
			if ($length > 0) {
				$num_row = ["true" => 0, "false" => 0];
				$detail = array();
				for ($i = 1; $i < $length; $i++) {
					if (isset($_POST["NO$i"])) {
						$NO = $_POST["NO$i"];
						//print_r($NO);
						//echo "<br/>";
						$category_list = array();
						$field_value_list = array();
						$insert_category_list = array();
						$insert_field_value_list = array();
						$seedling_list = array();
						$plant_list = array();
						$flower_list = array();
						$fruit_list = array();
						$seed_list = array();

						for ($j = 0; $j < count($NO) - 1; $j++) {
							$seedling = ["hypocotyl_colour", "hypocotyl_colour_intensity", "hypocotyl_pubescence"];
							$plant = [
								"plant_growth_type", "plant_size", "stem_pubescence_density", "stem_internode_length", "foliage_density", "number_of_leaves_under_1st_inflorescence", "leaf_attitude", "leaf_type", "degree_of_leaf_dissection", "anthocyanin_colouration_of_leaf_veins"
							];
							$flower = [
								"inflorescence_type", "corolla_colour", "corolla_blossom_type", "flower_sterility_type", "style_position", "style_shape", "style_hairiness", "dehiscence"
							];
							$fruit = [
								"exterior_colour_of_immature_fruit", "presence_of_green_shoulder_trips_on_the_fruit", "intensity_of_greenback", "fruit_pubescence", "predominant_fruit_shape", "fruit_size", "fruit_size_homogeneity", "exterior_colour_of_mature_fruit", "intensity_of_exterior_colour", "ribbing_at_calyx_end", "easiness_of_fruit_to_detach_from_pedicel", "fruit_shoulder_shape", "presence_absence_of_jiontless_pedicel", "easiness_of_fruit_wall_skin_to_be_peeled", "skin_colour_of_ripe_fruit", "flesh_colour_of_peiricarp_interior", "flesh_colour_intensity", "colour_intensity_of_core", "fruit_cross_sectional_shape", "shape_of_pistil_scar", "fruit_blossom_end_shape", "blossom_end_scar_condition", "fruit_firmness_after_storage"
							];
							$seed = ["seed_shape", "seed_colour"];
							if ($j + 2 <= count($NO) - 1) {
								if ($NO[$j] == 'update' && $NO[$j + 2] != 'update') {

									//echo $NO[$j].$NO[$j + 1].$NO[$j + 2]."<br/>";
									$array_data = explode("@", $NO[$j + 2]);
									$table = $array_data[0];
									$value = $array_data[1];
									if ($this->model->check_table_exit($table)) {
										//echo $table."<br/>";
										$id_value = $this->model->check_data_exit($table, $value);
										if (!$id_value) {
											$id_value = $this->model->insert_data_in_table($table, $value);
										}
										if (in_array("$table", $seedling)) {
											$seedling_list[$table] = $id_value;
										} else if (in_array("$table", $plant)) {
											$plant_list[$table] = $id_value;
										} else if (in_array("$table", $flower)) {
											$flower_list[$table] = $id_value;
										} else if (in_array("$table", $fruit)) {
											$fruit_list[$table] = $id_value;
										} else if (in_array("$table", $seed)) {
											$seed_list[$table] = $id_value;
										}
										$category_list = [
											"seedling" => $seedling_list, "plant" => $plant_list, "flower" => $flower_list, "fruit" => $fruit_list, "seed" => $seed_list
										];
										//print_r($category_list);
										// echo "<br/>";
									} else {
										if (empty($value)) {
											$field_value_list[$table] = NULL;
										} else {
											$field_value_list[$table] = $value;
										}
									}
								}
							}
							if ($j + 1 <= count($NO) - 1) {
								if ($NO[$j] == 'insert' && $NO[$j + 1] != 'insert' && $j + 1 <= count($NO) - 1) {

									$array_data = explode("@", $NO[$j + 1]);
									$table = $array_data[0];
									$value = $array_data[1];
									if ($this->model->check_table_exit($table)) {
										$id_value = $this->model->check_data_exit($table, $value);

										if (!$id_value) {
											$id_value = $this->model->insert_data_in_table($table, $value);
										}

										if (in_array("$table", $seedling)) {
											$seedling_list["id_$table"] = $id_value;
										} else if (in_array("$table", $plant)) {
											$plant_list["id_$table"] = $id_value;
										} else if (in_array("$table", $flower)) {
											$flower_list["id_$table"] = $id_value;
										} else if (in_array("$table", $fruit)) {
											$fruit_list["id_$table"] = $id_value;
										} else if (in_array("$table", $seed)) {
											$seed_list["id_$table"] = $id_value;
										} else if ($table = "accession_number") {
											$access_number = $id_value;
											$name_accession = $value;
										}
										$insert_category_list = [
											"accession_number" => $name_accession, "id_accession_number" => $access_number,
											"seedling" => $seedling_list, "plant" => $plant_list, "flower" => $flower_list, "fruit" => $fruit_list, "seed" => $seed_list
										];
										//print_r($category_list);
										// echo "<br/>";
									} else {
										if (empty($value)) {
											$insert_field_value_list[$table] = NULL;
										} else {
											$insert_field_value_list[$table] = $value;
										}
									}
								}
							}
						}
						if (count($category_list)) {
							$id_accession = $this->model->check_data_exit("accession_number", $NO[1]);
							$tomato = Char_data_Model::get_by_id_accession($id_accession);
							$id_list_group = array();


							if ($tomato) {
								$count = 0;
								//print_r($category_list);
								foreach ($category_list as $key => $value) {
									$check_group_id = false;
									if (count($value) > 0) {
										foreach ($value as $key2 => $value2) {
											if ($value2 != $tomato["id_$key2"]) {
												print_r($value);
												//echo "<br/> excel=> ".$value2."   database => ".$tomato["id_$key2"];
												$check_group_id = true;
												break;
											}
										}
										if ($check_group_id) {
											$id_group = $this->model->check_group($key, $category_list[$key], $tomato["id_$key"]);
											//echo "id group =>".$id_group;
										} else {
											$id_group = $tomato["id_$key"];
											//echo "else id group =>".$id_group;
										}
										$id_list_group["id_$key"] = $id_group;
									}
								}
								$fact_update = $id_list_group + $field_value_list;
								//print_r($id_list_group);
								//print_r($field_value_list);
								$check_num_row = $this->model->update_fact($fact_update, $id_accession, $NO[1]);
								if ($check_num_row["status"]) {
									$num_row["true"]++;
								} else {
									if ($check_num_row["error"] == "no row update") {
										$num_row["true"]++;
									} else {
										$num_row["false"]++;
										$detail[] = $check_num_row["error"];
									}
								}
							}
						} else if (count($field_value_list)) {
							//print_r($field_value_list);
							$id_accession = $this->model->check_data_exit("accession_number", $NO[1]);
							$check_num_row = $this->model->update_fact($field_value_list, $id_accession, $NO[1]);
							if ($check_num_row["status"]) {
								$num_row["true"]++;
							} else {
								//print_r($check_num_row["error"]);
								if ($check_num_row["error"] == "no row update") {
									$num_row["true"]++;
								} else {
									$num_row["false"]++;
									$detail[] = $check_num_row["error"];
								}
							}
						} else if (count($insert_category_list + $insert_field_value_list)) {
							$access["id_fact_tomato"] =  null;
							$access["id_accession_number"] = $insert_category_list["id_accession_number"];
							$access["id_photo"] = 1;
							$accession = $insert_category_list["accession_number"];
							unset($insert_category_list["accession_number"]);
							unset($insert_category_list["id_accession_number"]);
							$id_list_group = array();
							foreach ($insert_category_list as $key => $value) {
								$id_group = $this->model->get_id_group($key, $insert_category_list[$key]);
								$id_list_group["id_$key"] = $id_group;
							}
							$fact = $access + $id_list_group + $insert_field_value_list;
							//print_r($fact);
							$check = $this->model->insert_fact($fact, $accession);
							if ($check["status"]) {
								// echo " id_member => ".$member['id_member']." id_fact_tomato => ".$check["id_fact_tomato"]." accession => ".$accession;
								$member = Session::get("member");
								$check_owner = $this->model->insert_data_owner($member['id_member'], $check["id_fact_tomato"], $accession);
								$num_row["true"]++;
							} else {
								$num_row["false"]++;
								$detail[] = $check["error"];
							}
						}
					} else {
						continue;
					}

					//echo "<br/>";
				}
				$this->view->num_row = $num_row;
				$this->view->detail = $detail;
				$this->view->render('upload/result_upload');
				//print_r($num_row);
				//print_r($detail);
			}
		} else {
			//echo "no row update";
			$this->view->no_row = 1;
			$this->view->render('upload/result_upload');
		}
	}
}
