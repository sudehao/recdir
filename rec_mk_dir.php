<?php

/*
递归的创建级联目录  ./a/b/c/e
0.创建目录 mkdir
1.判断一个目录是否存在 is_dir
2.判断上级目录是否存在 is_dir(__DIR__)、dirname()

判断和创建的流程：
判断的目录：./aa/bb/cc/dd
判断的目录：./aa/bb/cc
判断的目录：./aa/bb
判断的目录：./aa
创建了目录：./aa
创建了目录：./aa/bb
创建了目录：./aa/bb/cc
创建了目录：./aa/bb/cc/dd
创建了目录：./aa/bb/cc/dd/ee

*/

$path = './a/b/c/d/e';

// 符合思维方式的递归写法
function mk_dir($path,$lev=1) {

	if(is_dir($path)) {  // 判断要创建的目录是否存在，存在直接返回ture
		echo '目录已经存在'.$path.'<br />';
		return true;
	} // if END

	

	if(is_dir(dirname($path))) {   // 判断上级目录是否存在，存在则在该目录创建新的目录
		echo $lev.'创建了'.$path.'<br />';
		return mkdir($path);
	} // if END
	echo $lev.'递<br />';
	mk_dir(dirname($path),$lev+1);
	echo $lev.'归-创建了'.$path.'<br />';

	return mkdir($path);

}

mk_dir($path);

echo '<hr />';

$path = './11/22/33/44/55';

// 更简洁的写法
function mk_dir2($path) {

	// 如果目录已经存在，直接返回
	if(is_dir($path)) {
		echo '目录已经存在'.$path;
		return true;
	}

	return is_dir(dirname($path))||mk_dir2(dirname($path)) ? mkdir($path) : false;
}

echo mk_dir2($path) ? 'OK' : 'fail';







?>