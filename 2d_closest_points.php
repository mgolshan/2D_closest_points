<?php

/**
* Finds the closest points in a 2D area by having array of the points.
* @param array $objects
* @return array
*/
function findClosest(array $objects)
{
    $count = count($objects);
    $points=array();
    $k = 0;
    
    //Find distances between all points
    for($i=0; $i<($count-1); $i++){
        for($j=$i+1; $j<$count; $j++){
            $theta = $objects[$i]['y'] - $objects[$j]['y']; 
            $dist = sin(deg2rad($objects[$i]['x'])) * sin(deg2rad($objects[$j]['x'])) +  cos(deg2rad($objects[$i]['x'])) * cos(deg2rad($objects[$j]['x'])) * cos(deg2rad($theta)); 
            $dist = acos($dist); 
            $points[$k]['deg'] = rad2deg($dist); 
            $points[$k]['name'] = $objects[$i]['name'].'/'.$objects[$j]['name']; 
            $k++;
        }
    }
    
    foreach ($points as $key => $row) {
        $deg[$key]  = $row['deg'];
        $name[$key] = $row['name'];
    }

    //Sort distances based on ascendening
    array_multisort($deg, SORT_ASC, $name, SORT_ASC, $points);
    
    return explode('/',$points[0]['name']);
}


/********************* Example: *****************************/

$obj1 = array('name' => 'a', 'x' => 1, 'y' => 8);
$obj2 = array('name' => 'b', 'x' => 1, 'y' => 2);
$obj3 = array('name' => 'c', 'x' => 13, 'y' => 13);
$obj4 = array('name' => 'd', 'x' => 15, 'y' => 14);

$objects = array($obj1, $obj2, $obj3, $obj4);

var_dump(findClosest($objects));


?>