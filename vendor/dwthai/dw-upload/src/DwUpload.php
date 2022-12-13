<?php
namespace DwThai;

class DwUpload{
	public static function dwUpload($f, $path="./img-products/", $rand=false){
		$f['name']=self::randomName($rand, $f['name']);
		if(@copy($f['tmp_name'],$path.$f['name'])){
			@chmod($path.$f,0777);
			return $f['name'];
		}else{
			return false;
		}
	}
	protected function randomName($opt,$f){
		$f2 = pathinfo($f);
		$n=$f2['filename'];
		if($opt==true){
			$n = time();
		}
		return $n.'.'.$f2['extension'];
	}
}