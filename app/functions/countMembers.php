<?php

$database = 'affiliete';
$host	  = 'localhost';
$user	  = 'root';
$pass     =  '';

$db = mysqli_connect($host, $user, '', $database);

if(! $db){
	echo 'Can not build a connection with database';
}

/*echo 'hi';
return;*/




if (!function_exists('downline_count')) {
   
   function downline_count($ids, $count) {
   	// echo $ids."<br>";
   	// return $ids;
   	// $db = mysqli_connect('localhost', 'root', '', 'affiliete');

   	$database = 'affiliete';
   	$host	  = 'localhost';
   	$user	  = 'root';
   	$pass 	  = '';

   	$db = mysqli_connect($host, $user, '', $database);

   	if(! $db){
   		echo 'Can not build a connection with database';
   	}

   	$query = "select * from downlines where user_id in(".$ids.")";

   	$q = 'select * from users where id=27';
   	$result = mysqli_query($db, $query);
   	// var_dump($result);
   	// echo $query.'<br>';
   	$ids = '';
   	while ($row = $result->fetch_array()) {
   		// var_dump($row);
   		if ($row['left_member_id'] != 0) {
   			$ids .= $row['left_member_id'].',';
   			$count = $count+1;
   			// echo $count.'<br>';
   		}
   		/*if ($row['middle_member_id'] != 0) {
   			$ids .= $row['middle_member_id'].',';
   			$count = $count+1;
   			// echo $count.'<br>';
   		}*/
   		if ($row['right_member_id'] != 0) {
   			$ids .= $row['right_member_id'].',';
   			$count = $count+1;
   			// echo $count.'<br>';
   		}
   	}

   	$db->close();

   	// echo $count.'<br>';
   	if ($ids == '') {
   		// echo '"'.$ids.'"';
   		echo $count;
   	} else {
   		// echo 'Again';
   		$ids = substr($ids, 0, -1);
   		// echo $count;
   		// $db->close();
   		downline_count($ids, $count);
   	}	
   	
   } 
}



