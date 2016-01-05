<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<style>
	p{color:red; font-weight:bold; padding:0; margin:0;}
	</style>
</head>
<body>
<?php
/*
级联打印所有子目录中的文件
0.判断指定的路径是否为目录 is_dir,判断文件或者目录是否存在 file_exists
1.列出指定目录中的所有目录和文件夹 opendir、readdir
2.关闭打开的资源  closedir
*/

define('ROOT', str_replace('\\', '/', dirname(__FILE__)) .'/');

$path = ROOT .'testdir/';  // 要操作的目录


function recFileDir($path,$lev=0) {
	if(file_exists($path) && is_dir($path)) {  // 判断一个路径是否为目录
		$frs = opendir($path);
		while(($filename = readdir($frs)) !== false) {  // 遍历一个目录中的所有文件
			$npath = $path.$filename. '/';

			if(!(is_dir($path.$filename))) {  //  判断不是目录的文件，且输出文件名
				echo str_repeat('&nbsp;', $lev),$filename.'<br />';
			} else if (is_dir($path.$filename) && !($filename == '.' or $filename == '..')) {   // 判断所有的目录（不包含‘.’、‘..’目录）,且输出文件名
				echo '<p>'. str_repeat('&nbsp;', $lev),$filename .'</p>';
				recFileDir($path.$filename.'/',$lev+5);    // 调用函数自身，进行更深层目录的遍历
			} // else if END
		} // while END
		closedir($frs);
	} else {
		echo '不是一个有效的目录';
	}  // if END
}

recFileDir($path);





?>
</body>
</html>
