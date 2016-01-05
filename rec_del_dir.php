<?php

/*
递归删除级联目录
打开一个目录资源句柄 opendir()，浏览目录readdir()，关闭目录closedir()；
删除一个目录 rmdir()，删除文件 unlink()
判断文件是否存在 file_exists()，判断是否为目录 is_dir()
*/
$path = './a';


// 递归的删除一个目录和它的所有子目录及文件
function del_dir($path) {

	// 判断如果参数不是一个目录直接退出
	if(!file_exists($path)) {
		echo '不是目录或不存在';
		return false;
	}

	// 判断是一个目录就打开
	if(is_dir($path)) {

		$frs = opendir($path);  // 打开一个路径的资源句柄

		while(($row = readdir($frs)) !== false) {  // 循环资源句柄中的内容

			if($row == '.' || $row == '..') {  // 如果是'.' '..' 跳过
				continue;
			}

			if(!is_dir($path.'/'.$row)) {  // 如果不是目录直接unlink删除
				//echo '删除了文件：'.$path.'/'.$row. '<br />';
				unlink($path.'/'.$row);
			}

			if(is_dir($path.'/'.$row)) {  // 如果是一个目录，则调用del_dir函数自身，继续子文件的判断。
				del_dir($path.'/'.$row);
			}
		}
		closedir($frs);  // 循环到一个目录为空退出循环后，关闭资源
		//echo '删除了目录：'. $path. '<br />';
		return rmdir($path);  // 删除打开的目录
	}
}

del_dir($path);




?>