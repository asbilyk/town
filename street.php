<?php
  header("Content-Type: text/html; charset=utf-8");
  include("building.php");
  
//function _post3($n){if (isset($_POST[$n])) 
//return $_POST[$n]; return '';}

  // $street_name = _post3('streetname');
	//$street_length = _post3('streetlength');
	//$latitudestart = _post3('latitudestart');
	//$longitudestart = _post3('longitudestart');
	//$latitudefin = _post3('latitudefin');
	//$longitudefin = _post3('longitudefin');
  //  $buildcount = _post3('buildcount');
  class Street {
      
      public $street_name;
      public $street_length;
      public $latitudestart;
      public $longitudestart;
	    public $latitudefin;
      public $longitudefin;
      public $buildcount;
      public $arr_of_buildings;
      public $all_area;
      public $number_of_yardmans;
      public $street_utilities;
      
      const YARDMAN_PER_1000M2 = 2; 
      
      public function __construct($street_name,$street_length,$latitudestart,$longitudestart, $latitudefin,$longitudefin,$buildcount){
          $this->street_name = $street_name;
          $this->street_length = $street_length;
          $this->latitudestart = $latitudestart;
          $this->longitudestart = $longitudestart;
		  $this->latitudefin = $latitudefin;
          $this->longitudefin = $longitudefin;
          $this->buildcount = $buildcount;
          $this->arr_of_buildings = array();
      }
      public function add_buildings(){
          for($i =0; $i<$this->buildcount;$i++){
             $building = new Building($i+1,rand(1,16),rand(1,6),rand(4,6),rand(1000,2000));
             $building->addflats();
             $this->arr_of_buildings[] = $building;
            //$building->display();
           }
      }
      public function calculate_yardmans(){
          for ($i = 0; $i<$this->buildcount;$i++){
              $this->all_area += $this->arr_of_buildings[$i]->squere;
          }
            $number_of_yardmans = $this->all_area*self::YARDMAN_PER_1000M2/1000;
            return ceil($number_of_yardmans);
      }
      public function calculate_street_utilities(){
          for($i =0; $i<$this->buildcount;$i++){
            $this->street_utilities += $this->arr_of_buildings[$i]->calculate_all_utilities(); 
         }
         return $this->street_utilities;
      }
     public function display(){
          if (isset($this->street_name)) {echo "<h3>Информация об улице:<h3><br>";}
          if (isset($this->street_name)) {echo "Название улицы - ".$this->street_name."<br>";}
          if (isset($this->street_length)) {echo "Длина улицы - ".$this->street_length."км.<br>";}
          if (isset($this->latitudestart)) {echo "Координаты начала улицы : ".$this->latitudestart.", ".$this->longitudestart."<br>";}
          if (isset($this->latitudefin)&&isset($this->longitudefin)) {echo "Координаты конца улицы : ".$this->latitudefin.", ".$this->longitudefin."<br>";}
          if (isset($this->buildcount)) {echo "Количество домов - ".$this->buildcount."<br><br>";} 
       } 
  }
  /*$street = new Street($street_name,$street_length,$latitudestart, $longitudestart, $latitudefin,$longitudefin,$buildcount);
  $street->add_buildings();
  $yardmans = $street->calculate_yardmans();
  $street_util = $street->calculate_street_utilities();
  $street->display();
  echo "Необходимое количество дворников - ".$yardmans."<br>";
  echo "Объем коммунальных платежей, которые будут получены со всех домов - ".$street_util;*/
?>
