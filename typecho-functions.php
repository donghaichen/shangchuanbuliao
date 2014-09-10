<?php
function img_postthumb($cid) {   
   $db = Typecho_Db::get();   
   $rs = $db->fetchRow($db->select('table.contents.text')   
       ->from('table.contents')   
       ->where('table.contents.cid=?', $cid)   
       ->order('table.contents.cid', Typecho_Db::SORT_ASC)   
       ->limit(1));   
  
   preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $rs['text'], $thumbUrl);  //通过正则式获取图片地址   
   $img_src = $thumbUrl[1][0];  //将赋值给img_src   
   $img_counter = count($thumbUrl[0]);  //一个src地址的计数器   
  
   switch ($img_counter > 0) {   
       case $allPics = 1:   
           echo $img_src;  //当找到一个src地址的时候，输出缩略图   
           break;   
       default:   
           echo "";  //没找到(默认情况下)，不输出任何内容   
   };   
}  
?>
<!--如何调用-->
<img src="http://timthumb所在目录/timthumb.php?src=<?php echo img_postthumb($this->cid); ?>&h=定义高度&w=定义宽度&zc=1"/>  