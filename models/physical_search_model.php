<?php
error_reporting(0);
class physical_search_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function accession_number()
    {
        $accession_number = $this->db->selectAll("SELECT accession_number FROM accession_number WHERE accession_number is not null") ;
        return $accession_number ;
    }

    public function fruit_size()
    {
    	return $this->db->selectAll("SELECT fruit_size FROM fruit_size WHERE fruit_size is not null");
    }
    public function exterior_colour_of_mature_fruit()
    {
    	return $this->db->selectAll("SELECT exterior_colour_of_mature_fruit FROM exterior_colour_of_mature_fruit WHERE exterior_colour_of_mature_fruit is not null");
    }
    public function presence_of_green_shoulder_trips_on_the_fruit()
    {
    	return $this->db->selectAll("SELECT presence_of_green_shoulder_trips_on_the_fruit FROM presence_of_green_shoulder_trips_on_the_fruit WHERE presence_of_green_shoulder_trips_on_the_fruit is not null");
    }
    public function intensity_of_greenback()
    {
    	return $this->db->selectAll("SELECT intensity_of_greenback FROM intensity_of_greenback WHERE intensity_of_greenback is not null");
    }
    public function fruit_pubescence()
    {
    	return $this->db->selectAll("SELECT fruit_pubescence FROM fruit_pubescence WHERE fruit_pubescence is not null");
    }
    public function predominant_fruit_shape()
    {
    	return $this->db->selectAll("SELECT predominant_fruit_shape FROM predominant_fruit_shape WHERE predominant_fruit_shape is not null");
    }
    public function fruit_size_homogeneity()
    {
    	return $this->db->selectAll("SELECT fruit_size_homogeneity FROM fruit_size_homogeneity WHERE fruit_size_homogeneity is not null");
    }
    public function intensity_of_exterior_colour()
    {
    	return $this->db->selectAll("SELECT intensity_of_exterior_colour FROM intensity_of_exterior_colour WHERE intensity_of_exterior_colour is not null");
    }
    public function ribbing_at_calyx_end()
    {
    	return $this->db->selectAll("SELECT ribbing_at_calyx_end FROM ribbing_at_calyx_end WHERE ribbing_at_calyx_end is not null");
    }
    public function easiness_of_fruit_to_detach_from_pedicel()
    {
    	return $this->db->selectAll("SELECT easiness_of_fruit_to_detach_from_pedicel FROM easiness_of_fruit_to_detach_from_pedicel WHERE easiness_of_fruit_to_detach_from_pedicel is not null");
    }
    public function fruit_shoulder_shape()
    {
    	return $this->db->selectAll("SELECT fruit_shoulder_shape FROM fruit_shoulder_shape WHERE fruit_shoulder_shape is not null");
    }
    public function presence_absence_of_jiontless_pedicel()
    {
    	return $this->db->selectAll("SELECT presence_absence_of_jiontless_pedicel FROM presence_absence_of_jiontless_pedicel WHERE presence_absence_of_jiontless_pedicel is not null");
    }
    public function easiness_of_fruit_wall_skin_to_be_peeled()
    {
    	return $this->db->selectAll("SELECT easiness_of_fruit_wall_skin_to_be_peeled FROM easiness_of_fruit_wall_skin_to_be_peeled WHERE easiness_of_fruit_wall_skin_to_be_peeled is not null");
    }
    public function skin_colour_of_ripe_fruit()
    {
    	return $this->db->selectAll("SELECT skin_colour_of_ripe_fruit FROM skin_colour_of_ripe_fruit WHERE skin_colour_of_ripe_fruit is not null");
    }
    public function flesh_colour_of_peiricarp_interior()
    {
    	return $this->db->selectAll("SELECT flesh_colour_of_peiricarp_interior FROM flesh_colour_of_peiricarp_interior WHERE flesh_colour_of_peiricarp_interior is not null");
    }
    public function flesh_colour_intensity()
    {
    	return $this->db->selectAll("SELECT flesh_colour_intensity FROM flesh_colour_intensity WHERE flesh_colour_intensity is not null");
    }
    public function colour_intensity_of_core()
    {
    	return $this->db->selectAll("SELECT colour_intensity_of_core FROM colour_intensity_of_core WHERE colour_intensity_of_core is not null");
    }
    public function fruit_cross_sectional_shape()
    {
    	return $this->db->selectAll("SELECT fruit_cross_sectional_shape FROM fruit_cross_sectional_shape WHERE fruit_cross_sectional_shape is not null");
    }
    public function shape_of_pistil_scar()
    {
    	return $this->db->selectAll("SELECT shape_of_pistil_scar FROM shape_of_pistil_scar WHERE shape_of_pistil_scar is not null");
    }
    public function fruit_blossom_end_shape()
    {
    	return $this->db->selectAll("SELECT fruit_blossom_end_shape FROM fruit_blossom_end_shape WHERE fruit_blossom_end_shape is not null");
    }
    public function blossom_end_scar_condition()
    {
    	return $this->db->selectAll("SELECT blossom_end_scar_condition FROM blossom_end_scar_condition WHERE blossom_end_scar_condition is not null");
    }
    public function fruit_firmness_after_storage()
    {
    	return $this->db->selectAll("SELECT fruit_firmness_after_storage FROM fruit_firmness_after_storage WHERE fruit_firmness_after_storage is not null");
    }


    public function plant()
    {
        $plant = array();

        $plant_growth_type = $this->db->selectAll("SELECT plant_growth_type FROM plant_growth_type WHERE plant_growth_type is not null") ;
        $plant_size = $this->db->selectAll("SELECT plant_size FROM plant_size WHERE plant_size is not null") ;
        $stem_pubescence_density = $this->db->selectAll("SELECT stem_pubescence_density FROM stem_pubescence_density WHERE stem_pubescence_density is not null");
        $stem_internode_length = $this->db->selectAll("SELECT stem_internode_length FROM stem_internode_length WHERE stem_internode_length is not null") ;
        $foliage_density = $this->db->selectAll("SELECT foliage_density FROM foliage_density WHERE foliage_density is not null") ;
        $number_of_leaves_under_1st_inflorescence = $this->db->selectAll("SELECT number_of_leaves_under_1st_inflorescence FROM number_of_leaves_under_1st_inflorescence") ;
        $leaf_attitude = $this->db->selectAll("SELECT leaf_attitude FROM leaf_attitude") ;
        $leaf_type = $this->db->selectAll("SELECT leaf_type FROM leaf_type") ;
        $degree_of_leaf_dissection = $this->db->selectAll("SELECT degree_of_leaf_dissection FROM degree_of_leaf_dissection") ;
        $anthocyanin_colouration_of_leaf_veins = $this->db->selectAll("SELECT anthocyanin_colouration_of_leaf_veins FROM anthocyanin_colouration_of_leaf_veins") ;

        array_push($plant, $plant_growth_type, $plant_size ,$stem_pubescence_density,$stem_internode_length,$foliage_density,$number_of_leaves_under_1st_inflorescence
            ,$leaf_attitude,$leaf_type,$degree_of_leaf_dissection,$anthocyanin_colouration_of_leaf_veins);

        return $plant ;

    }

    public function seedling()
    {
        $seedling = array();

        $hypocotyl_colour = $this->db->selectAll("SELECT hypocotyl_colour FROM hypocotyl_colour WHERE hypocotyl_colour is not null") ;
        $hypocotyl_colour_intensity = $this->db->selectAll("SELECT hypocotyl_colour_intensity FROM hypocotyl_colour_intensity WHERE hypocotyl_colour_intensity is not null") ;
        $hypocotyl_pubescence = $this->db->selectAll("SELECT hypocotyl_pubescence FROM hypocotyl_pubescence WHERE hypocotyl_pubescence is not null") ;

        array_push($seedling, $hypocotyl_colour, $hypocotyl_colour_intensity, $hypocotyl_pubescence);

        return $seedling ;

    }

    public function flower()
    {
        $flower = array();

        $inflorescence_type = $this->db->selectAll("SELECT inflorescence_type FROM inflorescence_type WHERE inflorescence_type is not null") ;
        $corolla_colour = $this->db->selectAll("SELECT corolla_colour FROM corolla_colour WHERE corolla_colour is not null") ;
        $corolla_blossom_type = $this->db->selectAll("SELECT corolla_blossom_type FROM corolla_blossom_type WHERE corolla_blossom_type is not null") ;
        $flower_sterility_type = $this->db->selectAll("SELECT flower_sterility_type FROM flower_sterility_type WHERE flower_sterility_type is not null") ;
        $style_position = $this->db->selectAll("SELECT style_position FROM style_position WHERE style_position is not null") ;
        $style_shape = $this->db->selectAll("SELECT style_shape FROM style_shape WHERE style_shape is not null") ;
        $style_hairiness = $this->db->selectAll("SELECT style_hairiness FROM style_hairiness WHERE style_hairiness is not null") ;
        $dehiscence = $this->db->selectAll("SELECT dehiscence FROM dehiscence WHERE dehiscence is not null") ;

        array_push($flower,$inflorescence_type, $corolla_colour,$corolla_blossom_type,$flower_sterility_type , $style_position, $style_shape, $style_hairiness, $dehiscence);

        return $flower ;

    }

    public function seed()
    {
        $seed = array();

        $seed_shape = $this->db->selectAll("SELECT seed_shape FROM seed_shape WHERE seed_shape is not null") ;
        $seed_colour = $this->db->selectAll("SELECT seed_colour FROM seed_colour WHERE seed_colour is not null") ;

        array_push($seed,$seed_shape, $seed_colour);

        return $seed ;

    }

    public function chart($value){

        $arr_value = ['fruit_weight_g','primary_leaf_length_mm','primary_leaf_width_mm','vine_length_cm','petal_length_cm','sepal_length_cm','stamen_length_cm','fruit_length_mm','fruit_width_mm','pedicel_length_mm','pedicel_length_from_abscission_layer','width_of_pedicel_scar_mm','size_of_corky_area_around_pedicel_scar_cm','thickness_of_fruit_wall_skin_mm','thickness_of_pericarp_mm','size_of_score_mm','number_of_locules','1000_seed_weight_g'];

        if(in_array($value, $arr_value)){
            $sumSmall = 0;
            $sumMedium = 0;
            $sumLarge = 0;
            $sumOther = 0;

            $sql = "SELECT t.ranges AS cha,COUNT(*) as count_sum 
            FROM (
                SELECT CASE
                    WHEN  $value  BETWEEN 0  AND 25 THEN '0-25'
                    WHEN  $value  BETWEEN 25 AND 50 THEN '25-50'
                    WHEN  $value  BETWEEN 50 AND 75 THEN '50-75'
                    else 'more than 75' END as ranges
                FROM cha_data_tomato ) t
            GROUP BY  t.ranges";

            $result = $this->db->selectAll($sql) ;

            /*
            for ($i=0; $i < sizeof($result['cha']); $i++) { 
                if($result['cha'][$i] <= 25){
                    //$small[] = $result['cha'][$i] ;
                    $sumSmall += $result['count_sum'][$i];
                }
                elseif ($result['cha'][$i] > 20 && $result['cha'][$i] <= 50) {
                    //$medium = $result['cha'][$i];
                    $sumMedium += $result['count_sum'][$i];
                }
                elseif ($result['cha'][$i] > 50 && $result['cha'][$i] <= 75) {
                   // $large = $result['cha'][$i];
                    $sumLarge += $result['count_sum'][$i];
                }
                else{
                    //$other = $result['cha'][$i];
                    $sumOther += $result['count_sum'][$i];
                }
            }

            $size = array();
            array_push($size, $small,$medium,$large,$other);

            $count = array();
            array_push($count, $sumSmall,$sumMedium,$sumLarge,$sumOther);

            $rs = array();
            array_push($rs, $size, $count);
            

            $small = array(
                'cha' => '0-25 g.',
                'count_sum' => $sumSmall
            );
            $medium = array(
                'cha' => '26-50 g.',
                'count_sum' => $sumMedium
            );
            $large = array(
                'cha' => '51-75 g.',
                'count_sum' => $sumLarge
            );
            $other = array(
                'cha' => 'more than 75 g.',
                'count_sum' => $sumOther
            );

            $rs = array();

            $result = array_push($rs, $small, $medium , $large , $other);

            print_r($result);

            */

            return $result;

        }
        else{
            $sql = "SELECT cha_data_tomato.$value AS cha,COUNT(cha_data_tomato.$value) as count_sum 
            FROM `cha_data_tomato` 
            WHERE cha_data_tomato.$value IS NOT NULL
            GROUP BY  cha_data_tomato.$value 
            ORDER BY count_sum DESC";

            $result = $this->db->selectAll($sql) ;

            return $result ;
        }
        

    }










}