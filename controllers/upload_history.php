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

	public function excel_to_array_location()
	{
		$file = $_FILES['upl'];
		include("libs/PHPExcel-1.8/Classes/PHPExcel.php");
		$tmpFile = $file["tmp_name"];
		$fileName = $file["name"];  // เก็บชื่อไฟล์
		$info = pathinfo($fileName);
		$allow_file = array("csv", "xls", "xlsx");
		/*  print_r($info);         // ข้อมูลไฟล์   
    	print_r($_fileup);*/
		if ($fileName != "" && in_array($info['extension'], $allow_file)) {
			// อ่านไฟล์จาก path temp ชั่วคราวที่เราอัพโหลด
			$objPHPExcel = PHPExcel_IOFactory::load($tmpFile);

			// ดึงข้อมูลของแต่ละเซลในตารางมาไว้ใช้งานในรูปแบบตัวแปร array
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

			// วนลูปแสดงข้อมูล
			$data_arr_excel = array();
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
					"Z" => "25", "AA" => "26", "AB" => "27", "AC" => "28", "AD" => "29", "AE" => "30"
					//"AF"=>"31","AG"=>"32",
					// "AH"=>"33","AI"=>"34","AJ"=>"35","AK"=>"36","AL"=>"37","AM"=>"38","AN"=>"39","AO"=>"40",
					// "AP"=>"41","AQ"=>"42","AR"=>"43","AS"=>"44","AT"=>"45","AU"=>"46","AV"=>"47","AW"=>"48",
					// "AX"=>"49","AY"=>"50","AZ"=>"51","BA"=>"52","BB"=>"53","BC"=>"54","BD"=>"55","BE"=>"56",
					// "BF"=>"57","BG"=>"58","BH"=>"59","BI"=>"60","BJ"=>"61","BK"=>"62","BL"=>"63","BM"=>"64"
					// "BN"=>"65","BO"=>"66","BP"=>"67","BQ"=>"68","BR"=>"69","BS"=>"70","BT"=>"71","BU"=>"72",
					// "BV"=>"73","BW"=>"74","BX"=>"75","BY"=>"76","BZ"=>"77","CA"=>"78","CB"=>"79","CC"=>"80",
					// "CD"=>"81","CE"=>"82","CF"=>"83"
				);
				if ($row >= $start_row) {
					$data_arr_excel[$row - $start_row][$col_name[$column]] = $data_value;
				}
			}
			return $data_arr_excel;
		}
	}
	
	public function excel_to_array_char()
	{
		$file = $_FILES['upl'];
		include("libs/PHPExcel-1.8/Classes/PHPExcel.php");
		$tmpFile = $file["tmp_name"];
		$fileName = $file["name"];  // เก็บชื่อไฟล์
		$info = pathinfo($fileName);
		$allow_file = array("csv", "xls", "xlsx");

		if ($fileName != "" && in_array($info['extension'], $allow_file)) {
			// อ่านไฟล์จาก path temp ชั่วคราวที่เราอัพโหลด
			$objPHPExcel = PHPExcel_IOFactory::load($tmpFile);

			// ดึงข้อมูลของแต่ละเซลในตารางมาไว้ใช้งานในรูปแบบตัวแปร array
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

			// วนลูปแสดงข้อมูล
			$data_arr_excel = array();
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
					$data_arr_excel[$row - $start_row][$col_name[$column]] = $data_value;
				}
			}
			//print_r($data_arr_excel);
			return $data_arr_excel;
		}
	}

	function check_invalid_char($data_all_excel){
		$format = ["Accession number", "Hypocotyl colour", "Hypocotyl colour intensity", "Hypocotyl pubescence", 
		"Primary leaf length (mm)", "Primary leaf width (mm)", "Plant growth type", "Plant size", "Vine length (cm)", 
		"Stem pubescence density", "Stem internode length", "Foliage density", "Number of leaves under 1st inflorescence",
		"Leaf attitude", "Leaf type", "Degree of leaf dissection", "Anthocyanin colouration of leaf veins", "Inflorescence type", 
		"Corolla colour", "Corolla blossom type", "Flower sterility type", "Petal length (cm)", "Sepal length (cm)", "Style position", 
		"Style shape", "Style hairiness", "Stamen length (cm)", "Dehiscence", "Exterior colour of immature fruit", 
		"Presence of green (shoulder) trips on the fruit", "Intensity of greenback", "Fruit pubescence", "Predominant fruit shape",
		"Fruit size", "Fruit size homogeneity", "Fruit weight (g)", "Fruit length (mm)", "Fruit width (mm)",
		"Exterior colour of mature fruit", "Intensity of exterior colour", "Ribbing at calyx end", 
		"Easiness of fruit to detach from pedicel", "Fruit shoulder shape", "Pedicel length (mm)",
		"Pedicel length from abscission layer", "Presence/absence of jiontless pedicel", "Width of pedicel scar (mm)", 
		"Size of corky area around pedicel scar (cm)", "Easiness of fruit wall (skin) to be peeled", "Skin colour of ripe fruit", 
		"Thickness of fruit wall (skin) (mm)", "Thickness of pericarp (mm)", " Flesh colour of peiricarp (interior)",
		" Flesh colour intensity", "Colour (intensity) of core", "Fruit cross-sectional shape", "Size of score (mm)",
		"Number of locules", "Shape of pistil scar", "Fruit blossom end shape", "Blossom end scar condition", 
		"Fruit firmness (after storage)", "Seed shape", "Seed colour", "1,000 seed weight (g)"]; //65

		$head = ["accession_number", "hypocotyl_colour", "hypocotyl_colour_intensity", "hypocotyl_pubescence",
		"primary_leaf_length_mm", "primary_leaf_width_mm", "plant_growth_type", "plant_size", "vine_length_cm",
		"stem_pubescence_density", "stem_internode_length", "foliage_density", "number_of_leaves_under_1st_inflorescence", 
		"leaf_attitude", "leaf_type", "degree_of_leaf_dissection", "anthocyanin_colouration_of_leaf_veins", "inflorescence_type", 
		"corolla_colour", "corolla_blossom_type", "flower_sterility_type", "petal_length_cm", "sepal_length_cm", "style_position", 
		"style_shape", "style_hairiness", "stamen_length_cm", "dehiscence", "exterior_colour_of_immature_fruit", "presence_of_green_shoulder_trips_on_the_fruit", 
		"intensity_of_greenback", "fruit_pubescence", "predominant_fruit_shape", "fruit_size", "fruit_size_homogeneity", "fruit_weight_g",
		"fruit_length_mm", "fruit_width_mm", "exterior_colour_of_mature_fruit", "intensity_of_exterior_colour", "ribbing_at_calyx_end", 
		"easiness_of_fruit_to_detach_from_pedicel", "fruit_shoulder_shape", "pedicel_length_mm", "pedicel_length_from_abscission_layer", 
		"presence_absence_of_jiontless_pedicel", "width_of_pedicel_scar_mm", "size_of_corky_area_around_pedicel_scar_cm", "easiness_of_fruit_wall_skin_to_be_peeled", 
		"skin_colour_of_ripe_fruit", "thickness_of_fruit_wall_skin_mm", "thickness_of_pericarp_mm", "flesh_colour_of_peiricarp_interior",
		"flesh_colour_intensity", "colour_intensity_of_core", "fruit_cross_sectional_shape", "size_of_score_mm", "number_of_locules", 
		"shape_of_pistil_scar", "fruit_blossom_end_shape", "blossom_end_scar_condition", "fruit_firmness_after_storage", "seed_shape", 
		"seed_colour", "1000_seed_weight_g"]; //65

		$data_db = $this->table; //sizeof($data_db)=46 print_r($data_db);
		$int_value = ["primary_leaf_length_mm", "primary_leaf_width_mm", "vine_length_cm", "petal_length_cm", "sepal_length_cm", "stamen_length_cm", 
		"fruit_weight_g", "fruit_length_mm", "fruit_width_mm", "pedicel_length_mm", "pedicel_length_from_abscission_layer", "width_of_pedicel_scar_mm", 
		"size_of_corky_area_around_pedicel_scar_cm", "thickness_of_fruit_wall_skin_mm", "thickness_of_pericarp_mm", "size_of_score_mm", "number_of_locules",
		"1000_seed_weight_g"]; //sizeof($int_value)=18

		// for ($i = 0; $i < sizeof($data_all_excel[0]); $i++) { //65
		// 	 for ($j = 0; $j < sizeof($data_all_excel); $j++) { //8
		// 		echo $data_all_excel[$j][$i]."//";
		// 	 }
		// 	echo "<br>";
		// }

		// for ($i = 0; $i < sizeof($data_all_excel); $i++) { //8 
		// 	for ($j = 0; $j < sizeof($data_all_excel[0]) ; $j++) { //65
		// 		echo $data_all_excel[$i][$j]."//";
		// 	}
		// 	echo "<br>";
		// }

		//1.check list
		$arr_inval_1 = [];
		$cou_1 = 0;
		$ch_1 = false;
		foreach ($data_db as $key => $value) {
			//echo "$key = $value ".sizeof($value)."<br>";
			for($i=0 ;$i < sizeof($head) ;$i++){
				if($head[$i] == $key){ 
					//echo "$key =  ".$head[$i];
					 for($j=1 ;$j < sizeof($data_all_excel) ;$j++){
						//echo $data_all_excel[$j][$i]." ";
						  for($k=1 ;$k <= sizeof($value) ;$k++){
							  if($data_all_excel[$j][$i] == $value[$k]){
								$ch_1 = true;
								break;
							}
							else{
								$ch_1 = false;
							}
						}
						if(!$ch_1){
							$arr_inval_1[$cou_1] = [$j,$i];
							$cou_1++;
						}
					 }	
					 //echo "<br>";
				}
			}
		}
		echo $cou_1."++++++++++++";
		print_r($arr_inval_1);

		//2.check number
		$arr_inval_2 = [];
		$cou_2 = 0;
		$ch_2 = false;
		for($i=0 ;$i < sizeof($int_value) ;$i++){
			
			for($j=0 ;$j < sizeof($head) ;$j++){
				if($head[$j] == $int_value[$i]){
					break;
					//echo $int_value[$i] ." =  ".$head[$j];
				}
			}

			for($k=1 ;$k < sizeof($data_all_excel)  ;$k++){
				//echo $data_all_excel[$k][$j]."  ";
				if($data_all_excel[$k][$j] < 0 || $data_all_excel[$k][$j] == null || $data_all_excel[$k][$j] == "-" || !(is_numeric( $data_all_excel[$k][$j]))    ){
					$ch_2 = false;
					$arr_inval_2[$cou_2] = [$k,$j];
					$cou_2++;
				}
			}
			//echo "<br>";
		}
		echo "<br>".$cou_2."++++++++++++";
		print_r($arr_inval_2);
	}

	function checkAll_char()
	{
		//เอาค่าจาก excel มาทำเป็น array
		$data_all = $this->excel_to_array_char();
		$check_misshead = $this->check_misshead($data_all);
		if (!$check_misshead) {
			echo "miss";
		} else {
			//เช็คว่า head เป็น ถูกตาม format รึป่าว
			$check_wronghead = $this->check_wornghead_char($data_all);
			if (!$check_wronghead) {
				echo "worng";
			} 
			$check_null = $this->check_null_char($data_all);
			if(!$check_null){
				echo "ไม่ใส่ชื่อ access number";
			} else {
				//เช็คว่า accession number ซ้ำรึป่าว
				$check_duplicate = $this->check_duplicate($data_all);
				if (!$check_duplicate) {
					echo "dup";
				} else {
					echo "123"."<br>";
					$this->check_invalid_char($data_all);

					//return true;
				}
			}
		}
	}
	
	/*-----------Check fail function location---------*/
	function checkAll_location()
	{
		$data_all = $this->excel_to_array_location();
		//print_r($data_all[0]);
		$check_misshead = $this->check_misshead($data_all);
		echo($check_misshead);

		if (!$check_misshead) {
			echo "miss";
		} else {
			//เช็คว่า head เป็น ถูกตาม format รึป่าว
			$check_wronghead = $this->check_wornghead_location($data_all);
			if (!$check_wronghead) {
				echo "worng";
			} else {
				//เช็คว่า accession number ซ้ำรึป่าว
				$check_duplicate = $this->check_duplicate($data_all);
				if (!$check_duplicate) {
					echo "dup";
				} else {
					echo"all corect";
					//return true;
				}
			}
		}
	}

	function checkAll_char2()
	{
		//เอาค่าจาก excel มาทำเป็น array
		$data_all_excel = $this->excel_to_array_char(); //sizeof($data_all_excel)=8 sizeof($data_all_excel[0])=65

		//$check_misshead = $this->check_wornghead_char($data_all);
		//echo ($check_misshead);
		//เช็คว่า head เป็น null รึป่าว
		$check_misshead = $this->check_misshead_char($data_all_excel);
		if(!$check_misshead) { 
			echo "มีหัวตารางไม่ใส่ค่า";
			//return false;
		} else {
			//เช็คว่า head เป็น ถูกตาม format รึป่าว
			$check_wronghead = $this->check_wornghead_char($data_all_excel);
			if(!$check_wronghead) {
				echo "ชื่อหัวตารางผิด";
			}
			$check_null = $this->check_null_char($data_all_excel);
			if(!$check_null){
				echo "ไม่ใส่ชื่อ access number";
			} else {
				//เช็คว่า accession number ซ้ำรึป่าว
				$check_duplicate = $this->check_duplicate_char($data_all_excel);
				if(!$check_duplicate) {
					echo "มีaccess number ซ้ำ";
				} else {
					echo "ถูกทั้งหมด"."<br>";
					$this->check_invalid_char($data_all_excel);
				}
			}
		}
	}

	/*----------------------------- Check fail fucntion ------------------------------------------*/
	public function check_misshead($data_arr_excel)
	{
		for ($i = 0; $i < sizeof($data_arr_excel[0]); $i++) {
			if ($data_arr_excel[0][$i] == null) {
				return false;
			}
		}
		return true;
	}

	public function check_duplicate($data_all)
	{

		for ($i = 0; $i < sizeof($data_all); $i++) {
			for ($j = 0; $j < sizeof($data_all); $j++) {
				if ($data_all[$i][0] == $data_all[$j][0] && $i != $j) {
					return false;
				}
			}
		}
		return true;
	}

	public function check_null_char($data_all)
	{
		for ($i = 0; $i < sizeof($data_all); $i++) {
			if ($data_all[$i][0] == null || $data_all[$i][0] == "-") {
				return false;
			}
		}
		return true;
	}

	public function check_wornghead_char($data_all)
	{
		$format = [
			"Accession number", "Hypocotyl colour", "Hypocotyl colour intensity", "Hypocotyl pubescence",
			"Primary leaf length (mm)", "Primary leaf width (mm)", "Plant growth type", "Plant size", "Vine length (cm)",
			"Stem pubescence density", "Stem internode length", "Foliage density", "Number of leaves under 1st inflorescence",
			"Leaf attitude", "Leaf type", "Degree of leaf dissection", "Anthocyanin colouration of leaf veins", "Inflorescence type",
			"Corolla colour", "Corolla blossom type", "Flower sterility type", "Petal length (cm)", "Sepal length (cm)", "Style position",
			"Style shape", "Style hairiness", "Stamen length (cm)", "Dehiscence", "Exterior colour of immature fruit",
			"Presence of green (shoulder) trips on the fruit", "Intensity of greenback", "Fruit pubescence", "Predominant fruit shape",
			"Fruit size", "Fruit size homogeneity", "Fruit weight (g)", "Fruit length (mm)", "Fruit width (mm)",
			"Exterior colour of mature fruit", "Intensity of exterior colour", "Ribbing at calyx end",
			"Easiness of fruit to detach from pedicel", "Fruit shoulder shape", "Pedicel length (mm)",
			"Pedicel length from abscission layer", "Presence/absence of jiontless pedicel", "Width of pedicel scar (mm)",
			"Size of corky area around pedicel scar (cm)", "Easiness of fruit wall (skin) to be peeled", "Skin colour of ripe fruit",
			"Thickness of fruit wall (skin) (mm)", "Thickness of pericarp (mm)", " Flesh colour of peiricarp (interior)",
			" Flesh colour intensity", "Colour (intensity) of core", "Fruit cross-sectional shape", "Size of score (mm)",
			"Number of locules", "Shape of pistil scar", "Fruit blossom end shape", "Blossom end scar condition",
			"Fruit firmness (after storage)", "Seed shape", "Seed colour", "1,000 seed weight (g)"
		];
		//   echo sizeof($format).sizeof($data_all[0]);
		for ($i = 0; $i < sizeof($data_all[0]); $i++) {
			if ($data_all[0][$i] != $format[$i])
				return false;
		}
		return true;
	}

	public function check_wornghead_location($data_all)
	{
		$format = [
			"Accession number", "TM Group", "Temporary number", "Other number", "Collector number", "Collector", "Crop collection", 
			"Variety", "Seed amount_g", "Genus", "Species", "Collection date", "Grower name", "Donor name", "Address", 
			"Sub district", "District", "Province", "Country", "Institute", "Usage", "Latitude", "Longitude", "Collection source", 
			"Genetict status", "Sample type", "Material", "Photograpy", "Topography", "Soil texure", "Remark"
		];

		//   echo sizeof($format).sizeof($data_all[0]);
		for ($i = 0; $i < sizeof($data_all[0]); $i++) {
			if ($data_all[0][$i] != $format[$i])
				return false;
		}
		return true;
	}
	/*----------------------------- Check fail fucntion ------------------------------------------*/


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

	public function index()
	{
		//Session:init();
		//Session::get([key]);
		//$check =Char_data_Model::update_data();
		//print_r($check);

		$this->view->name_type = $this->check_type();
		$this->view->render('upload_history/index');
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

	function search_id2($item, $List1)
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

	public function search_id()
	{
		$accession_number = $_POST['accession_number'];
		$check = Char_data_Model::get_by_accession($accession_number);
		//header('Content-type: application/json');
		//print json_encode($check);
		print_r($check);
	}

	public function check_type()
	{
		$check_type = $this->plant_type;
		$name_type = "";
		switch ($check_type) {
			case 1:
				$name_type = "Character";
				break;
			case 2:
				$name_type = "Location";
				break;
			default:
				$name_type = "Genome";
				break;
		}
		return $name_type;
	}

}
?>

