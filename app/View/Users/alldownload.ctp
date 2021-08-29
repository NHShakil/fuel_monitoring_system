<?php

$line= $datas['LoginTable'];
//$line1= $datas['LoginTable']['username'];
//$line2= $datas['LoginTable']['login_time'];
//$line3= $datas['LoginTable']['logout_time'];
//$line4= $datas['LoginTable']['login_status'];
//$line5= $datas['LoginTable']['login_count'];

//$this->CSV->addRow(array_keys($line1,$line2,$line3,$line4,$line5));
$this->CSV->addRow(array_keys($line));

 foreach ($datas as $post)
 {
 	$line= $post['LoginTable'];
   //$line1 = $post['LoginTable']['username'];
   //$line2 = $post['LoginTable']['login_time']; 
   //$line3 = $post['LoginTable']['logout_time'];  
   //$line4 = $post['LoginTable']['login_status']; 
   //$line5 = $post['LoginTable']['login_count'];

   //$this->CSV->addRow($line1,$line2,$line3,$line4,$line5);
   $this->CSV->addRow($line);
 }

 $filename='All_users_login_history';

 echo  $this->CSV->render($filename);
?>
