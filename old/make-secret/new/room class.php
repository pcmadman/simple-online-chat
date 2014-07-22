<?php
	header('Content-type:text/plain; charset=utf-8'); 
	class Room{//房间的类
		public $strings=array();//聊天内容
		public $timestamps=array();//时间戳
		public $names=array();//发送人昵称

		public function addaction ($a_string,$a_timestamp,$a_name){
			$strings[]=$a_string;
			$timestamps[]=$a_timestamp;
			$names[]=$a_name;
		}
	}
	
?>
