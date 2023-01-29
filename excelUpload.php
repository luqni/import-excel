<?php


require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');
require('db_config.php');


if(isset($_POST['Submit'])){

  $contact_id = $_POST['contacts'];

  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet, application/wps-office.xlsx'];
  
//   if(in_array($_FILES["file"]["type"],$mimes)){

    
    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
    
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);

    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".


    $html="<table border='1'>";
    $html.="<tr><th>Title</th><th>Description</th></tr>";


    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)
      {
        $html.="<tr>";
        $contact_id = $contact_id;
        $name = isset($Row[1]) ? $Row[1] : '';
        $number = isset($Row[2]) ? $Row[2] : '';
        $html.="<td>".$name."</td>";
        $html.="<td>".$phone."</td>";
        $html.="</tr>";


        $query = "insert into numbers(contact_id,name,number) values('".$contact_id."','".$name."','".$number."')";


        $mysqli->query($query);
       }


    }


    $html.="</table>";
    echo $html;
    echo "<br />Data Inserted in dababase";


//   }else { 
//     die("<br/>Sorry, File type is not allowed. Only Excel file."); 
//   }


}


?>