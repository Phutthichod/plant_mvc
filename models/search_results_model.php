<?php 
error_reporting(0);
class search_results_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_id($name_table,$value)
    {
        $this->$name_table = $name_table ;
        $this->$value = $value ;
        $result = $this->db->selectOne("SELECT id_$name_table FROM $name_table WHERE $name_table = '$value'");
        foreach ($result as $key => $val) {
            return $val;
        }
    }
    
    public function text_search($accession_number)
    {
        return $this->db->selectOne("SELECT accession_number FROM accession_number WHERE accession_number LIKE '%$accession_number%' ");
    }

    public function search()
    {
        unset($where);
        unset($where_new);
        
        $where = 'WHERE ';
        $c = 0;
        $k = 999;

        if($_POST['1000_seed_weight_g_start'] != "" && $_POST['1000_seed_weight_g_end'] != ""){
            $seed_weight_g = [$_POST['1000_seed_weight_g_start'],$_POST['1000_seed_weight_g_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " 1000_seed_weight_g >= '".$seed_weight_g[0]."' AND 1000_seed_weight_g <= '".$seed_weight_g[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['number_of_locules_start'] != "" && $_POST['number_of_locules_end'] != ""){
            $number_of_locules = [$_POST['number_of_locules_start'],$_POST['number_of_locules_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " number_of_locules >= '".$number_of_locules[0]."' AND number_of_locules <= '".$number_of_locules[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['size_of_score_mm_start'] != "" && $_POST['size_of_score_mm_end'] != ""){
            $size_of_score_mm = [$_POST['size_of_score_mm_start'],$_POST['size_of_score_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " size_of_score_mm >= '".$size_of_score_mm[0]."' AND size_of_score_mm <= '".$size_of_score_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['thickness_of_pericarp_mm_start'] != "" && $_POST['thickness_of_pericarp_mm_end'] != ""){
            $thickness_of_pericarp_mm = [$_POST['thickness_of_pericarp_mm_start'],$_POST['thickness_of_pericarp_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " thickness_of_pericarp_mm >= '".$thickness_of_pericarp_mm[0]."' AND thickness_of_pericarp_mm <= '".$thickness_of_pericarp_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['thickness_of_fruit_wall_skin_mm_start'] != "" && $_POST['thickness_of_fruit_wall_skin_mm_end'] != ""){
            $thickness_of_fruit_wall_skin_mm = [$_POST['thickness_of_fruit_wall_skin_mm_start'],$_POST['thickness_of_fruit_wall_skin_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " thickness_of_fruit_wall_skin_mm >= '".$thickness_of_fruit_wall_skin_mm[0]."' AND thickness_of_fruit_wall_skin_mm <= '".$thickness_of_fruit_wall_skin_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['size_of_corky_area_around_pedicel_scar_cm_start'] != "" && $_POST['size_of_corky_area_around_pedicel_scar_cm_end'] != ""){
            $size_of_corky_area_around_pedicel_scar_cm = [$_POST['size_of_corky_area_around_pedicel_scar_cm_start'],$_POST['size_of_corky_area_around_pedicel_scar_cm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " size_of_corky_area_around_pedicel_scar_cm >= '".$size_of_corky_area_around_pedicel_scar_cm[0]."' AND size_of_corky_area_around_pedicel_scar_cm <= '".$size_of_corky_area_around_pedicel_scar_cm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['width_of_pedicel_scar_mm_start'] != "" && $_POST['width_of_pedicel_scar_mm_end'] != ""){
            $width_of_pedicel_scar_mm = [$_POST['width_of_pedicel_scar_mm_start'],$_POST['width_of_pedicel_scar_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " width_of_pedicel_scar_mm >= '".$width_of_pedicel_scar_mm[0]."' AND width_of_pedicel_scar_mm <= '".$width_of_pedicel_scar_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['pedicel_length_from_abscission_layer_start'] != "" && $_POST['pedicel_length_from_abscission_layer_end'] != ""){
            $pedicel_length_from_abscission_layer = [$_POST['pedicel_length_from_abscission_layer_start'],$_POST['pedicel_length_from_abscission_layer_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " pedicel_length_from_abscission_layer >= '".$pedicel_length_from_abscission_layer[0]."' AND pedicel_length_from_abscission_layer <= '".$pedicel_length_from_abscission_layer[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['pedicel_length_mm_start'] != "" && $_POST['pedicel_length_mm_end'] != ""){
            $pedicel_length_mm = [$_POST['pedicel_length_mm_start'],$_POST['pedicel_length_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " pedicel_length_mm >= '".$pedicel_length_mm[0]."' AND pedicel_length_mm <= '".$pedicel_length_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['fruit_width_mm_start'] != "" && $_POST['fruit_width_mm_end'] != ""){
            $fruit_width_mm = [$_POST['fruit_width_mm_start'],$_POST['fruit_width_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " fruit_width_mm >= '".$fruit_width_mm[0]."' AND fruit_width_mm <= '".$fruit_width_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['fruit_length_mm_start'] != "" && $_POST['fruit_length_mm_end'] != ""){
            $fruit_length_mm = [$_POST['fruit_length_mm_start'],$_POST['fruit_length_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " fruit_length_mm >= '".$fruit_length_mm[0]."' AND fruit_length_mm <= '".$fruit_length_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['petal_length_cm_start'] != "" && $_POST['petal_length_cm_end'] != ""){
            $petal_length_cm = [$_POST['petal_length_cm_start'],$_POST['petal_length_cm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " petal_length_cm >= '".$petal_length_cm[0]."' AND petal_length_cm <= '".$petal_length_cm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['sepal_length_cm_start'] != "" && $_POST['sepal_length_cm_end'] != ""){
            $sepal_length_cm = [$_POST['sepal_length_cm_start'],$_POST['sepal_length_cm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " sepal_length_cm >= '".$sepal_length_cm[0]."' AND sepal_length_cm <= '".$sepal_length_cm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if($_POST['stamen_length_cm_start'] != "" && $_POST['stamen_length_cm_end'] != ""){
            $stamen_length_cm = [$_POST['stamen_length_cm_start'],$_POST['stamen_length_cm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " stamen_length_cm >= '".$stamen_length_cm[0]."' AND stamen_length_cm <= '".$stamen_length_cm[1]."'";
            $c=0;
            $where .= " AND " ;
        }

        if($_POST['vine_length_cm_start'] != "" && $_POST['vine_length_cm_end'] != ""){
            $vine_length_cm = [$_POST['vine_length_cm_start'],$_POST['vine_length_cm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " vine_length_cm >= '".$vine_length_cm[0]."' AND vine_length_cm <= '".$vine_length_cm[1]."'";
            $c=0;
            $where .= " AND " ;
        }

        if($_POST['primary_leaf_length_mm_start'] != "" && $_POST['primary_leaf_length_mm_end'] != ""){
            $primary_leaf_length_mm = [$_POST['primary_leaf_length_mm_start'],$_POST['primary_leaf_length_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " primary_leaf_length_mm >= '".$primary_leaf_length_mm[0]."' AND primary_leaf_length_mm <= '".$primary_leaf_length_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }

        if($_POST['primary_leaf_width_mm_start'] != "" && $_POST['primary_leaf_width_mm_end'] != ""){
            $primary_leaf_width_mm = [$_POST['primary_leaf_width_mm_start'],$_POST['primary_leaf_width_mm_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " primary_leaf_width_mm >= '".$primary_leaf_width_mm[0]."' AND primary_leaf_width_mm <= '".$primary_leaf_width_mm[1]."'";
            $c=0;
            $where .= " AND " ;
        }
    // Fruit
        if($_POST['fruit_weight_g_start'] != "" && $_POST['fruit_weight_g_end'] != ""){
            $fruit_weight_g = [$_POST['fruit_weight_g_start'],$_POST['fruit_weight_g_end']];
            if($c != 0){
                $where .= " || " ;
            }
            $where .= " fruit_weight_g >= '".$fruit_weight_g[0]."' AND fruit_weight_g <= '".$fruit_weight_g[1]."'";
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_size'])){
            foreach ($_POST['fruit_size'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_size",$value);
                $where .= " id_fruit_size = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['exterior_colour_of_mature_fruit'])){
            foreach ($_POST['exterior_colour_of_mature_fruit'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("exterior_colour_of_mature_fruit",$value);
                $where .= " id_exterior_colour_of_mature_fruit = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['presence_of_green_shoulder_trips_on_the_fruit'])){
            foreach ($_POST['presence_of_green_shoulder_trips_on_the_fruit'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("presence_of_green_shoulder_trips_on_the_fruit",$value);
                $where .= " id_presence_of_green_shoulder_trips_on_the_fruit = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['intensity_of_greenback'])){
            foreach ($_POST['intensity_of_greenback'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("intensity_of_greenback",$value);
                $where .= " id_intensity_of_greenback = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_pubescence'])){
            foreach ($_POST['fruit_pubescence'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_pubescence",$value);
                $where .= " id_fruit_pubescence = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['predominant_fruit_shape'])){
            foreach ($_POST['predominant_fruit_shape'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("predominant_fruit_shape",$value);
                $where .= " id_predominant_fruit_shape = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_size_homogeneity'])){
            foreach ($_POST['fruit_size_homogeneity'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_size_homogeneity",$value);
                $where .= " id_fruit_size_homogeneity = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['intensity_of_exterior_colour'])){
            foreach ($_POST['intensity_of_exterior_colour'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("intensity_of_exterior_colour",$value);
                $where .= " id_intensity_of_exterior_colour = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['ribbing_at_calyx_end'])){
            foreach ($_POST['ribbing_at_calyx_end'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("ribbing_at_calyx_end",$value);
                $where .= " id_ribbing_at_calyx_end = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['easiness_of_fruit_to_detach_from_pedicel'])){
            foreach ($_POST['easiness_of_fruit_to_detach_from_pedicel'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("easiness_of_fruit_to_detach_from_pedicel",$value);
                $where .= " id_easiness_of_fruit_to_detach_from_pedicel = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_shoulder_shape'])){
            foreach ($_POST['fruit_shoulder_shape'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_shoulder_shape",$value);
                $where .= " id_fruit_shoulder_shape = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['presence_absence_of_jiontless_pedicel'])){
            foreach ($_POST['presence_absence_of_jiontless_pedicel'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("presence_absence_of_jiontless_pedicel",$value);
                $where .= " id_presence_absence_of_jiontless_pedicel = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['easiness_of_fruit_wall_skin_to_be_peeled'])){
            foreach ($_POST['easiness_of_fruit_wall_skin_to_be_peeled'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("easiness_of_fruit_wall_skin_to_be_peeled",$value);
                $where .= " id_easiness_of_fruit_wall_skin_to_be_peeled = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['skin_colour_of_ripe_fruit'])){
            foreach ($_POST['skin_colour_of_ripe_fruit'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("skin_colour_of_ripe_fruit",$value);
                $where .= " id_skin_colour_of_ripe_fruit = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['flesh_colour_of_peiricarp_interior'])){
            foreach ($_POST['flesh_colour_of_peiricarp_interior'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("flesh_colour_of_peiricarp_interior",$value);
                $where .= " id_flesh_colour_of_peiricarp_interior = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['flesh_colour_intensity'])){
            foreach ($_POST['flesh_colour_intensity'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("flesh_colour_intensity",$value);
                $where .= " id_flesh_colour_intensity = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['colour_intensity_of_core'])){
            foreach ($_POST['colour_intensity_of_core'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("colour_intensity_of_core",$value);
                $where .= " id_colour_intensity_of_core = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_cross_sectional_shape'])){
            foreach ($_POST['fruit_cross_sectional_shape'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_cross_sectional_shape",$value);
                $where .= " id_fruit_cross_sectional_shape = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['shape_of_pistil_scar'])){
            foreach ($_POST['shape_of_pistil_scar'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("shape_of_pistil_scar",$value);
                $where .= " id_shape_of_pistil_scar = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_blossom_end_shape'])){
            foreach ($_POST['fruit_blossom_end_shape'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_blossom_end_shape",$value);
                $where .= " id_fruit_blossom_end_shape = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['blossom_end_scar_condition'])){
            foreach ($_POST['blossom_end_scar_condition'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("blossom_end_scar_condition",$value);
                $where .= " id_blossom_end_scar_condition = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['fruit_firmness_after_storage'])){
            foreach ($_POST['fruit_firmness_after_storage'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("fruit_firmness_after_storage",$value);
                $where .= " id_fruit_firmness_after_storage = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
    // End Fruit

    // Start Plant
        if(isset($_POST['plant_growth_type'])){
            foreach ($_POST['plant_growth_type'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("plant_growth_type",$value);
                $where .= " id_plant_growth_type = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['plant_size'])){
            foreach ($_POST['plant_size'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("plant_size",$value);
                $where .= " id_plant_size = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['stem_pubescence_density'])){
            foreach ($_POST['stem_pubescence_density'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("stem_pubescence_density",$value);
                $where .= " id_stem_pubescence_density = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['foliage_density'])){
            foreach ($_POST['foliage_density'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("foliage_density",$value);
                $where .= " id_foliage_density = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['number_of_leaves_under_1st_inflorescence'])){
            foreach ($_POST['number_of_leaves_under_1st_inflorescence'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("number_of_leaves_under_1st_inflorescence",$value);
                $where .= " id_number_of_leaves_under_1st_inflorescence = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['leaf_attitude'])){
            foreach ($_POST['leaf_attitude'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("leaf_attitude",$value);
                $where .= " id_leaf_attitude = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['leaf_type'])){
            foreach ($_POST['leaf_type'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("leaf_type",$value);
                $where .= " id_leaf_type = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['degree_of_leaf_dissection'])){
            foreach ($_POST['degree_of_leaf_dissection'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("degree_of_leaf_dissection",$value);
                $where .= " id_degree_of_leaf_dissection = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['anthocyanin_colouration_of_leaf_veins'])){
            foreach ($_POST['anthocyanin_colouration_of_leaf_veins'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("anthocyanin_colouration_of_leaf_veins",$value);
                $where .= " id_anthocyanin_colouration_of_leaf_veins = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
    // End Plant 

    // Start Seedling
        if(isset($_POST['hypocotyl_colour'])){
            foreach ($_POST['hypocotyl_colour'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("hypocotyl_colour",$value);
                $where .= " id_hypocotyl_colour = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['hypocotyl_colour_intensity'])){
            foreach ($_POST['hypocotyl_colour_intensity'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("hypocotyl_colour_intensity",$value);
                $where .= " id_hypocotyl_colour_intensity = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['hypocotyl_pubescence'])){
            foreach ($_POST['hypocotyl_pubescence'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("hypocotyl_pubescence",$value);
                $where .= " id_hypocotyl_pubescence = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }

    // End Seedling

    // Start Flower

        if(isset($_POST['inflorescence_type'])){
            foreach ($_POST['inflorescence_type'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("inflorescence_type",$value);
                $where .= " id_inflorescence_type = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['corolla_colour'])){
            foreach ($_POST['corolla_colour'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("corolla_colour",$value);
                $where .= " id_corolla_colour = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['corolla_blossom_type'])){
            foreach ($_POST['corolla_blossom_type'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("corolla_blossom_type",$value);
                $where .= " id_corolla_blossom_type = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['flower_sterility_type'])){
            foreach ($_POST['flower_sterility_type'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("flower_sterility_type",$value);
                $where .= " id_flower_sterility_type = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['style_position'])){
            foreach ($_POST['style_position'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("style_position",$value);
                $where .= " id_style_position = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['style_shape'])){
            foreach ($_POST['style_shape'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("style_shape",$value);
                $where .= " id_style_shape = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['style_hairiness'])){
            foreach ($_POST['style_hairiness'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("style_hairiness",$value);
                $where .= " id_style_hairiness = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['dehiscence'])){
            foreach ($_POST['dehiscence'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("dehiscence",$value);
                $where .= " id_dehiscence = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }

    // End Flower

    // Start Seed

        if(isset($_POST['seed_shape'])){
            foreach ($_POST['seed_shape'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("seed_shape",$value);
                $where .= " id_seed_shape = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }
        if(isset($_POST['seed_colour'])){
            foreach ($_POST['seed_colour'] as $key => $value) {
                if($c != 0){
                    $where .= " || " ;
                }
                $id = $this->get_id("seed_colour",$value);
                $where .= " id_seed_colour = '".$id."'";
                $c++;
            }
            $c=0;
            $where .= " AND " ;
        }

    // End Seed

        $where_new = substr($where, 0, -4);
        $accession_number = [];

        if( isset($_POST['accession_number']) ){
            $acc = $_POST['accession_number'];
            $accession_number = $this->db->selectAll("SELECT accession_number FROM accession_number WHERE accession_number LIKE '%$acc%' ");

            $where_new = " WHERE accession_number IN (" ;
            foreach ($accession_number as $key => $value) {
                $val = $value['accession_number'];
                $where_new .= " '$val'," ;
            }
            $where_new .= " '' )" ;
        }

        
        //echo $where_new;
        return $this->db->selectAll("SELECT * FROM `test_view_fact_tomato` $where_new ORDER BY id_accession_number");
    }

    /// Asree Add searc 
    public function get_share()// share with me
    {

        $member = Session::get('member');
		return $this->db->selectAll("SELECT data_shared.id_member_owner,data_shared.id_member_shared,data_shared.accession_number,data_shared.id_fact_tomato,data_shared.date_shared,member.id_member,member.firstname FROM
        (	SELECT max(data_shared.id_data_shared)AS max_id FROM data_shared 
            WHERE data_shared.id_member_shared = '".$member['id_member']."'
             GROUP BY data_shared.id_member_owner,data_shared.id_member_shared,data_shared.accession_number,data_shared.id_fact_tomato,data_shared.date_shared
         ) r
         INNER JOIN 
         data_shared ON data_shared.id_data_shared = r.max_id AND data_shared.status_sh!='Unshared'
          LEFT JOIN member ON member.id_member = data_shared.id_member_owner
          LEFT JOIN data_owner ON data_owner.id_member = data_shared.id_member_owner 
          WHERE  member.id_member != '".$member['id_member']."' AND data_owner.status_ow != 'Public' AND data_owner.id_fact_tomato = data_shared.id_fact_tomato");
    }


    public function image_result()
    {
        $id = $this->search();
        $path = [];
        foreach ($id as $key => $value) {
            $id_accession_number = $value['id_accession_number'];
            $id_photo = $this->db->selectOne("SELECT id_photo FROM fact_tomato WHERE id_accession_number = $id_accession_number ");
            $id = $id_photo['id_photo'];
            $path[] = $this->db->selectOne("SELECT photo.path as 'path' FROM photo WHERE photo.id_photo = '$id' ");
        }
        /*
        echo "<pre>";
        print_r($test);
        echo "</pre>";
        */
        //echo "<script>alert('$test')</script>" ;
        return $path ;
    }

}
?>

