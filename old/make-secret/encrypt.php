<?php
	//We make secret

	//Variables
	$debug = true;#���Ϊ����ģʽ��������ܹ���
	$post_text = $_POST['texts'];#POST����������
	$type;#���ֽ���ת��������
	$num_MD5 = substr(hexdec(md5($post_text))/1E+25,0,10);#�������ֻ�ȡ��10λ������֣�����ת��������ȡ�õ����ֲ�Ӧ���б仯
	//bin2hex('') ������2�����ַ���ת����16����
	//hex2bin('') ������16�����ַ���ת����2����
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