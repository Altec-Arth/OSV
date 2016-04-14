<?php
ob_start();
include("osv_func.php");
/*
OCW Source Viewer
create by: Altec with Siemens C60 :)
for member of http://ocwteam.com
*
**
OCW Source Viewer adalah file ke-3 yg dibuat dan dishare untuk public khususnya member ocwteam setelah *ocw_genchat* dan *simple_ocw_guestbook*
*/
/*
File Name: osv.php
**
Author: Altec
**
Email: altecom1@gmail.com
**
site: http://ocwteam.com
**
Notice: Anda boleh memodifikasi script ini atau menyebarkan kembali. dilarang memperjual belikan. script ini sepenuhnya hasil pemikiran Author. SO JANGAN DIPERJUAL BELIKAN!!!*/
//jumlah char perhalaman
//$char_per_page=500;
$cpp=$_GET["cpp"];
if($cpp<500){
/* jika jumlah char perhalaman kurang dari 500 kita pakai default 500 */
$cpp=500;}
//judul site kamu
$nama_site="nama site kamu";
//url ke main page
$link="index.php";
//background site kamu
$background="#7fffd4";
//warna text
$text="#0000ff";
//jangan diedit mulai dr sini.. tp boleh aja klo mao edit.
$url=$_GET["url"];
$copy=$_GET["copy"];
header("Content-type:text/html");
header("Cache-Control:no-cache");
echo ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"><html><head><title>Source Viewer</title></head><body bgcolor='".$background."' text='".$text."'><center><div style='border:2px solid red'>");
echo "<a name=\"top\"></a>";
echo "<b><big>$nama_site</big></b><br />";
//halaman. . .
$page=$_GET["page"];
if($page==""||$page<=0
)$page=1;
if(ereg("^http://",$url)){
$ff=@htmlspecialchars(file_get_contents($url));
$ff=nl2br($ff);
}else{
echo "Masukan url";}
$jumlah=strlen($ff);
$num_items=$jumlah;
$items_per_page=$cpp;
$num_pages=ceil($num_items/$items_per_page); if(($page>$num_pages)&&
$page!=1)$page=$num_pages;
$limit_start=($page-1)*$items_per_page;
echo "<form action=\"osv.php?copy=$copy\" method=\"get\"><input type=\"text\" name=\"url\" value=\"http://\" /><br />";
echo "Char/page:<input name=\"cpp\" type=\"text\" format=\"*n\" size=\"4\" maxlength=\"4\" value=\"1500\" /><br />";
echo "<input type=\"submit\" value=\"view\" /></form>";
echo "<div style='background-color:#333333;color:#ffffff;border-style:ridge;border-color:#00ccff;border-width:1px'>";
$pr=($page*$cpp)-$cpp;
$view=substr($ff,$pr,$cpp);
if($copy=="yes"){
echo "<textarea>$view</textarea>";}
else{
echo altecom($view);}
echo "</div></div></center>";
echo "<p align=\"center\">";
if($copy=="yes"){
echo "<a href=\"osv.php?url=$url&amp;page=$page&amp;cpp=$cpp\">Normal Mode</a>";}
else{
echo "<a href=\"osv.php?url=$url&amp;copy=yes&amp;page=$page&amp;cpp=$cpp\">Copy Paste Mode</a>";}
echo "<br />";
if($page>1 ){
$ppage=$page-1;
echo "<a href=\"osv.php?url=$url&amp;copy=$copy&amp;cpp=$cpp&amp;page=$ppage\">[Prev|</a>";
}
echo "<a href=\"#top\">Top</a>";
if($page<$num_pages){
$npage=$page +1 ;
echo "<a href=\"osv.php?url=$url&amp;copy=$copy&amp;cpp=$cpp&amp;page=$npage\">|Next]</a>";
}
if($page>'0' && $num_pages<='10'){
echo "<br />";
for($i=1;$i<=$num_pages;$i++){
if($i!=$page){
echo "[<a href=\"osv.php?url=$url&amp;page=$i&amp;copy=$copy&amp;cpp=$cpp\">$i</a>]";}else{
echo "[$i]";}}}else
{
echo "<br />$page/$num_pages<form action=\"osv.php?url=$url&amp;copy=$copy&amp;cpp=$cpp\" method=\"get\"><input type=\"text\" format=\"*n\" name=\"page\" size=\"2\" value=\"\"/><input type=\"submit\" value=\"Go\"/>";}
if($url!=""){
echo "<br /><a href=\"$url\">$url</a>";}
echo "<br /><a href=\"$link?cpp=$cpp\">Home</a><br/>&#169;$nama_site 2008</p></body></html>";
?>