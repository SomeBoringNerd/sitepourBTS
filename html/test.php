<?php
 
 $url = 
 'https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'; 
   
 $img = 'logo.png'; 
   
 // Function to write image into file
 file_put_contents($img, file_get_contents($url));
?>