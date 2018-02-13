<?php 
      $id = (string)$_POST['id'];
      if(isset($id) && strlen((string)$id) == 24){

            $file = 'inc/nxs-functions.php';
            $newfile = 'inc/nxs-functions-'.$id.'.php';

            if (!copy($file, $newfile)) {
                echo "failed to copy";
            }

            $str = file_get_contents('inc/nxs-functions-'.$id.'.php');
            $str = str_replace("nx-snap-settings.txt", $id."-nx-snap-settings.txt",$str);
            file_put_contents('inc/nxs-functions-'.$id.'.php', $str);

            
            $file = 'nx-user-snap-settings.txt';
            $newfile = $id."-nx-snap-settings.txt";

            if (!copy($file, $newfile)) {
                echo "failed to copy";
            }
      }

?>