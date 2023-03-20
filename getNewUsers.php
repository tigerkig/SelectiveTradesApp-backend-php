<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $max_timestamp = (int)$data["max_timestamp"];
    
    if($conn){
        
        function utf8ize($d) {
            if (is_array($d)) {
                foreach ($d as $k => $v) {
                    $d[$k] = utf8ize($v);
                }
            } else if (is_string ($d)) {
                return utf8_encode($d);
            }
            return $d;
        }
        
        $query = "select * from users where date_registered>$max_timestamp";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $rows = array();
            while($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
            print json_encode(utf8ize($rows));
        }
        else{
            echo 'failure';
        }
    }
    else{
        echo 'failure';
    }
?>