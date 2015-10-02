<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding("UTF-8");
mb_http_input()
//function _post2($n){if (isset($_POST[$n])) 
//return $_POST[$n]; return '';}
?>

<?php

   class Building{
       
       public $numbuild;
       public $stagecount;
       public $porchcount;
       public $appartcount;
       public $squere;
       public $numberofflats;
       public $all_utilities;
       public $inhabitants_in_house;
       const RENTVAL = 1.44;// rent for 1 m2
       const ELECTRICITY = 5;// цена за электричество, 10кВТ
    
       public function __construct($numbuild, $stagecount, $porchcount,$numberofflats, $squere) {
           
           $this->numbuild = $numbuild;
           $this->stagecount = $stagecount;
           $this->porchcount = $porchcount; //конструктор дома
           $this->numberofflats = $numberofflats;
           $this->squere = $squere;
           $this->arrofflats = array();
              }
           
      public function addflats(){
           for($i =0; $i<$this->numberofflats*$this->stagecount*$this->porchcount;$i++){
             $flat = new Flat(mt_rand(1,4),mt_rand(40,70),mt_rand(1,$this->stagecount),mt_rand(1,6),mt_rand(0,2),"центральное"); //генератор квартир
             $this->arrofflats[] = $flat;
                    }
       }
        //calculate utilities from all flats in the building
       public function calculate_all_utilities(){
            for($i =0; $i<count($this->arrofflats);$i++){
            $this->all_utilities += $this->arrofflats[$i]->calculate_All(); 
         }
         return $this->all_utilities;
       }
                      
       public function calculate_electricity(){
             $total_electricity = $this->stagecount*$this->porchcount*self::ELECTRICITY;
             return $total_electricity;
       }
       public function calculate_land_tax(){
           $land_tax = $this->squere*self::RENTVAL;
           return $land_tax;
       }
       public function calculate_inhabitants_in_house(){
           for($i =0; $i<count($this->arrofflats);$i++){
            $this->inhabitants_in_house += $this->arrofflats[$i]->numberOfPerson; 
           }
           return $this->inhabitants_in_house;
       }
       public function display(){
          if (isset($this->numbuild)) {echo "<h3>Информация о доме:<h3><br>";}
          if (isset($this->numbuild)) {echo "Номер дома - ".$this->numbuild."<br>";}
          if (isset($this->stagecount)) {echo "Количество этажей - ".$this->stagecount."<br>";}
          if (isset($this->porchcount)) {echo "Количество подъездов - ".$this->porchcount."<br>";}
          if (isset($this->numberofflats)) {echo "Количество квартир - ". $this->numberofflats*$this->stagecount*$this->porchcount."<br>";}
          if (isset($this->numberofflats)) {echo "Количество жильцов - ".$this->calculate_inhabitants_in_house()."<br>";}
          if (isset($this->squere)) {echo "Территория, отведенная для дома - ".$this->squere."м&sup2<br><br>";} 
       }
   }
  /* $build = new Building($numbuild,$stagecount,$porchcount,$numberofflats,$squere);
   $build->addflats();
   $build->display();
   $util = $build->calculate_all_utilities();
   echo "Размер коммунальных платежей со всех квартир в этом доме - ".$util."грн.<br>";
   echo "Объем потребляемого электричества для освещения подъездов - ".$build->calculate_electricity()."кВт.<br>";
   echo "Размер налога на землю, отведенной для дома - ".$build->calculate_land_tax()."грн.<br>";   */ 
       
       
  //$numbuild = _post2('numbuild');
	//$stagecount = _post2('stagecount');
	//$porchcount = _post2('porchcount');
	//$numberofflats = _post2('appartcount');
//	$squere = _post2('squere');
	
  class Flat{
       
       public $numberOfRooms;
       public $flatArea;
       public $stage;
       public $numberOfPerson;
       public $numberOfBalcony;
       public $typeOfHeating;
       const COLD_WATER = 5.676;// цена за холодную воду
       const COLD_WATER_NORM = 8;// норма на человека
       const HOT_WATER = 38.02;// цена за горячую воду
       const HOT_WATER_NORM = 3;
       const RENT = 2.26;//кварплата rent for 1 m2
       const ELECTRICITY = 0.45;// цена за электричество, 1кВТ
       const HEATING_CENTRAL = 16.42;// цена за 1 м^2
       const HEATING_INDIVIDUAL_GAZNORM = 11;// norm gaz per 1 m2
	   const CALALIZATION = 3.036;//каналья м.куб
       const ELECTR_NORM = 50;//норма потребления электричества
       const GAZCOST = 7.188;//стоимость газа за м. куб
	   const GAZNORM = 3; // norm gaz per person
       public function __construct($numberOfRooms,$flatArea,$stage,$numberOfPerson,$numberOfBalcony,$typeOfHeating) {
           
           $this->numberOfRooms = $numberOfRooms;
           $this->flatArea = $flatArea;
           $this->stage = $stage;
           $this->numberOfPerson = $numberOfPerson;
           $this->numberOfBalcony = $numberOfBalcony;
           $this->typeOfHeating = $typeOfHeating;
     }
       public function calculate_cold_water(){
           $cold_water = $this->numberOfPerson*self::COLD_WATER*self::COLD_WATER_NORM;
           return $cold_water;
       }
       public function calculate_hot_water(){
           $hot_water = $this->numberOfPerson*self::HOT_WATER*self::HOT_WATER_NORM;
           return $hot_water;
       }
       public function calculate_canalization(){
           $canalization = $this->numberOfPerson*(self::COLD_WATER_NORM+self::HOT_WATER_NORM)*self::CALALIZATION;
           return $canalization;
       }
       public function calculate_rent(){
           $rent = $this->flatArea*self::RENT;
           return $rent;
       }
       public function calculate_heating(){
           if ($this->typeOfHeating == "центральное") {
               $heating = $this->flatArea*self::HEATING_CENTRAL;
               return $heating;
           }
           else {
               $heating = $this->flatArea*self::HEATING_INDIVIDUAL_GAZNORM*self::GAZCOST;
               return $heating;
           }
       }
	   public function calculate_electricity(){
           $electr = $this->numberOfPerson*self::ELECTRICITY*self::ELECTR_NORM;
           return $electr;
       }
	   public function calculate_gaz(){
           $gaz = $this->numberOfPerson*self::GAZCOST*self::GAZNORM;
           return $gaz;
       }
	   	   
       public function calculate_All(){
           $sum_all = ($this->calculate_cold_water() + $this->calculate_hot_water() + $this->calculate_canalization()
                             + $this->calculate_rent() + $this->calculate_heating()+$this->calculate_electricity()+$this->calculate_gaz());
           return $sum_all;
       }
       public function change_person($num){
          $this->numberOfPerson = $num;
        //  return $this->numberOfPerson;  
       }
		   
        }

?>
