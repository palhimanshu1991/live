<?php
ob_start();
session_start();
include "common.php";


$time=time();
$actual_date = date('Y-m-d', $time);



 $sql = "SELECT * FROM film where fl_id BETWEEN 60001 AND 70000 ";
 $result = mysql_query($sql) or die(mysql_error());
 

 header('Content-Type: application/xml');
 echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
 echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";  
 while($row = mysql_fetch_array($result)) {
 $title_str = $row['fl_name'];
 $utf8_str = iconv("iso-8859-15","UTF-8",$title_str);
 $url_str = str_replace(" ","-",$utf8_str);
 $url_str2 = str_replace("&","&#x26;",$url_str);

 ?>
 
 <url>
 <loc>http://www.berdict.com/<?php echo $row['fl_id']; ?>-<?php echo $url_str2; ?></loc>
 <lastmod><?php echo $actual_date ; ?></lastmod>
 <priority>1.0</priority>
 <changefreq>daily</changefreq>
 </url>
 <?php } ?>
</urlset>