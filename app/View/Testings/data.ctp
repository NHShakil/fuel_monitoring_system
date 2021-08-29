<html>
<head>
    
    <title>Massive Electronics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <link rel="stylesheet" type="text/css" href="table.css">
    <link rel="stylesheet" type="text/css" href="css/boxx.css">
    <link rel="stylesheet" href="dist/bootstrap.min.css">
    <link rel="stylesheet" href="dist/simplePagination.css"/>
    
    <script type="text/javascript" charset="utf8" src="dist/jquery-2.0.3.js"></script>
    <script type="text/javascript" charset="utf8" src="dist/jquery.simplePagination.js"></script>
    <script type="text/javascript" charset="utf8" src="dist/bootstrap.min.js"></script>
    


    <style type="text/css">
        p.italic{
            font-style: italic;
            color: blue;
            font-weight: bold;
        }
    </style>

</head>

<body>
   

<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cake-2_3-user-auth";
    
    $con = new mysqli($servername, $username, $password, $dbname);
    
    if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
    }
    else
    {
    }

    $limit = 12;  
    if (isset($_GET["page"])) 
    { 
        $page  = $_GET["page"]; 
    } 
    else 
    { 
        $page=1; 
    }
      
    $start_from = ($page-1) * $limit;  

    $sql = "SELECT * FROM table2s ORDER BY id DESC LIMIT $start_from, $limit"; 

    $result = $con->query($sql);
    
?>

    <div class="box-header text-center">
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
        <h4 class="box-title"> Remote Environment Monitoring System</h4>
        <p class="text-right italic">Developed By -Massive Electronics</p>
    </div>

    

    

    <div id="show"">
        <div class="box">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center" bgcolor=#84bdff style="font-style:normal; font-family:serif; font-size-adjust: all;">
                        <td rowspan="2" class="text-center">index1</td>
                        <td rowspan="2" class="text-center">index2</td>
                        <td rowspan="2" class="text-center">index3</td>
                        <td rowspan="2" class="text-center">index4</td>
                        <td rowspan="2" class="text-center">index5</td>
                        <td rowspan="2" class="text-center">index6</td>
                        
                        <td rowspan="2" class="text-center">index7</td>
                        <td rowspan="2" class="text-center">index8</td>
                        <td rowspan="2" class="text-center">index9</td>
                        <td rowspan="2" class="text-center">index10</td>
                    </tr>

                </thead>

                <tbody>
                    <?php 
                        if( $result->num_rows > 0 ){
                            while($row=mysqli_fetch_assoc($result)) { ?>
                                <tr class="text-center">
                                    <td bgcolor="#a7c8ef" class="text-center"><?php echo $row['index1'];?></td>
                                    <td bgcolor="#b6ccc1" class="text-center"><?php echo $row['index2'];?></td>
                                    <td bgcolor="#b6ccc1" class="text-center"><?php echo $row['index3'];?></td>
                                    <td bgcolor="#b6bbc1" class="text-center"><?php echo $row['index4']?></td> 
                                    <td bgcolor="#a7c8ef" class="text-center"><?php echo $row['index5'];?></td>
                                    <td bgcolor="#b6ccc1" class="text-center"><?php echo $row['index6'];?></td>
                                    <td bgcolor="#b6ccc1" class="text-center"><?php echo $row['index7'];?></td>
                                    <td bgcolor="#b6bbc1" class="text-center"><?php echo $row['index8']?></td>
                                    <td bgcolor="#a7c8ef" class="text-center"><?php echo $row['index9'];?></td>
                                    <td bgcolor="#b6ccc1" class="text-center"><?php echo $row['index10'];?></td>
                                    <td>
                                    </td>
                                </tr>
                            <?php } 
                        } ?>
                </tbody>                        
            </table>   
        </div>
    </div>

    

</body>
</html>








