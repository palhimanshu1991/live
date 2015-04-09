<?php
ob_start();

$time=time();
$actual_date = date('Y-m-d', $time);
$movie = Movie::whereBetween('fl_id', array(1, 3501))->get();
 

header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";  
foreach($movie as $movie) {
$title_str = Common::cleanUrl($movie->fl_name);
$utf8_str = iconv("iso-8859-15","UTF-8",$title_str);
$url_str = str_replace("(","",$utf8_str);
$url_str2 = str_replace("&","&#x26;",$url_str);
?>
 
<url>
<loc>http://www.berdict.com/movie/<?php echo $movie->fl_id; ?>/<?php echo $url_str2; ?>/reviews</loc>
<lastmod><?php echo $actual_date ; ?></lastmod>
<priority>1.0</priority>
<changefreq>daily</changefreq>
</url>
<?php } ?>
</urlset>