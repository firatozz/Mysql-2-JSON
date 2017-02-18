
<?php
    @header('Content-type: application/json; charset=utf-8');

    //open connection to mysql db
    $connection = mysqli_connect("hostname","username","password","database_name") or die("Error " . mysqli_error($connection));
   
    
     //fetch table rows from mysql db
    $sql = "select * from table_name";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $array_name = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $Json_file_name[] = $row;
    }


    echo json_encode($Json_file_name);

 echo ("\n");
 echo ("\n");


    //Create a Folder

    $folder_name = "json_database";
     
    if(file_exists($folder_name))
    {
    echo "Folder already exists!";
    exit();//Stop process
    }
     
    $create = mkdir($folder_name, 0700);
     
    if($create)
    {
    echo "Folder Created.";
    }
    else
    {
    echo "<br>Folder could not create!";
    }
 

//write to json files
    $fp = fopen('json_database/Json_Name.json', 'w');
    fwrite($fp,' "Json_Name" :');
     fwrite($fp, json_encode($Json_Name));

    fclose($fp);



    $get_file = file_get_contents('json_database/Json_Name.json');  
     
    $decode = json_decode($get_file); // If it is true, it can not be written to the correct place or if it is completely removed, it can be processed as an object.
     
    echo "<pre>";
    print_r ($decode);
    echo "</pre>";
    echo "<hr>";
     
    echo ($decode['widget']['feature']['data']); 
 

    //close the db connection
    mysqli_close($connection);
?>