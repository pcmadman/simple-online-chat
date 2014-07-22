<?php
	//We make secret

	//Variables
	$debug = true;#如果为调试模式则输出加密过程
	$post_text = $_POST['texts'];#POST过来的文字
	$type;#文字将被转换的类型
	$num_MD5 = substr(hexdec(md5($post_text))/1E+25,0,10);#根据文字获取的10位随机数字，逆向转换后文字取得的数字不应该有变化
	//bin2hex('') 把任意2进制字符串转换成16进制
	//hex2bin('') 把任意16进制字符串转换成2进制
	$num_str;
	
	//transform to numeral
	function transform ($texts) {
		//get numeral type
		$num = substr(strval(strlen($texts)),strlen(strlen($texts))-1,1);
		if ( $num >= 5 ){
			print ($debug = true ? 'type is oct<br />' : '');
			$type = 'oct';
		}else{
			print ($debug = true ? 'type is dec<br />' : '');
			$type = 'dec';
		}
		$num_str = $type = 'otc' ? decoct(hexdec(bin2hex($texts))) : hexdec(bin2hex($texts));
		print ($debug = true ? '$num_str:' . $num_str . '<br />': '');
		return $num_str;
	}

	//encrypt texts and add timestamp
	function encrypt ($texts,$type,$timestamp = true){
		
	}
	transform($post_text);

?>