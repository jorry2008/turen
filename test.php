<?php
//firePHP
require(__DIR__ . '/FirePHPCore/fb.php');
ob_start();


$str = '<center><img src="/turen/backend/web/upload/image/20150909/1441810956113819.jpg" height="120" width="120"><br />PHP正则提取或更改图片img标记中的任意属性</center>';

// //1、取整个图片代码
// preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$str,$match);
// echo $match[0];

// //2、取width
// preg_match('/<img.+(width=\"?\d*\"?).+>/i',$str,$match);
// echo $match[1];

// //3、取height
// preg_match('/<img.+(height=\"?\d*\"?).+>/i',$str,$match);
// echo $match[1];

// //4、取src
// preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$match);
// echo $match[1];

/*PHP正则替换图片img标记中的任意属性*/
//1、将src="/uploads/images/20100516000.jpg"替换为src="/uploads/uc/images/20100516000.jpg")

$web = '/turen/backend/web';

// $ee = preg_replace('/(<img.+src=\"?)(.+)(\/upload\/.+\.(jpg|gif|bmp|bnp|png)\"?.+>)/i',"----\${1}----\${2}-----\${3}-----",$str);

$ee = preg_replace('/(<img.+src=\"?)(.+)(\/upload\/.+\.(jpg|gif|bmp|bnp|png)\"?.+>)/i',"\${1}\${3}", $str);

//----<img src="/turen/backend/web/upload/-----20150909/1441810956113819.jpg"

///turen/backend/web/upload/     image/20150909/1441810956113819.jpg
///turen/backend/web/upload/uc/images/20150909/1441810956113819.jpg

fb($ee);







