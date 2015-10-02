<?php
header("Content-Type: text/html; charset=utf-8");
   include_once("street.php");

   function _post4($n){if (isset($_POST[$n])) 
   return $_POST[$n]; return '';}
   
   
 $town_name = _post4('townname');
	$foundation_year = _post4('foundationyear');
	$latitude = _post4('latitude');
	$longitude = _post4('longitude');
	$number_of_streets = _post4('number_of_streets');
 
 class Town{
      
     public $town_name;
     public $foundation_year;
     public $latitude;
     public $longitude;
     public $number_of_streets;
     public $arr_of_streets;
     public $budget;
     public $population;
     
     public function __construct($town_name, $foundation_year, $latitude, $longitude, $number_of_streets){
         
             $this->town_name = $town_name;
             $this->foundation_year = $foundation_year;
             $this->latitude = $latitude;
             $this->longitude = $longitude;
             $this->number_of_streets = $number_of_streets;
             $this->arr_of_streets = array();
             $this->budget = $budget;
             $this->population = $population;
                         
     }
     
    public function add_streets(){
         
        for($i =0; $i<$this->number_of_streets;$i++){
             $street = new Street(self::rand_street(),mt_rand(2,25),mt_rand(49835418,50071181),mt_rand(36130919,36452959),mt_rand(49835418,50071181),mt_rand(36130919,36452959),mt_rand(3,50));
             $street->add_buildings();
             $this->arr_of_streets[] = $street;
             //$street->display();
           }
         
     } 
     public function rand_street(){
         
         $rand_name = mt_rand(1,10);
         switch($rand_name) {
                 case 1: $street_name = "Пушкинская"; return $street_name; break;
                 case 2: $street_name = "Сумская"; return $street_name; break;
                 case 3: $street_name = "Ленина"; return $street_name; break;
                 case 4: $street_name = "Рымарская"; return $street_name; break;
                 case 5: $street_name = "Московский проспект"; return $street_name; break;
                 case 6: $street_name = "Полтавский шлях"; return $street_name; break;
                 case 7: $street_name = "Академика Павлова"; return $street_name; break;
                 case 8: $street_name = "Гвардейцев Широнинцев"; return $street_name; break;
                 case 9: $street_name = "Проспект Гагарина"; return $street_name; break;
                 case 10: $street_name = "Клочковская"; return $street_name; break;
          }
     }
     public function calculate_budget(){
         
        for($i = 0; $i<$this->number_of_streets;$i++){
            for ($j= 0; $j<$this->arr_of_streets[$i]->buildcount;$j++){
                  $this->budget += $this->arr_of_streets[$i]->arr_of_buildings[$j]->calculate_land_tax();
            }
        } 
        return $this->budget; 
     }
     public function calculate_population(){
         
        for ($i = 0; $i<$this->number_of_streets;$i++){
            for ($j = 0; $j<$this->arr_of_streets[$i]->buildcount;$j++){
                $this->population += $this->arr_of_streets[$i]->arr_of_buildings[$j]->calculate_inhabitants_in_house();
                }
            }
        return $this->population;
     }
        
     
     public function display(){
          if (isset($this->town_name)) {echo "<h3>Информация о городе:</h3>";}
          if (isset($this->town_name)) {echo "Название города - ".$this->town_name."<br>";}
          if (isset($this->foundation_year)) {echo "Год основания - ".$this->foundation_year."г.<br>";}
          if (isset($this->latitude)) {echo "Координаты города - ".$this->latitude.", ".$this->longitude."<br>";}
          if (isset($this->number_of_streets)) {echo "Количество улиц - ".$this->number_of_streets."<br>";}
          if (isset($this->number_of_streets)){echo "Бюджет города: ".$this->calculate_budget()." грн.<br>";}
          if (isset($this->number_of_streets)){echo "Количество жителей в городе: ".$this ->calculate_population()." чел.<br><br>";}
     }
  }
    $town = new Town($town_name,$foundation_year,$latitude,$longitude,$number_of_streets);
   $town->add_streets();
  echo $town->display();
  
  
?>
