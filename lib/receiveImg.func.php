<?php
function receiveImg(){
	$imgPaths=array();
	foreach($_FILES as $img){
		$imgTemp=$img['tmp_name'];
		$imgName=$img['name'];
		$imgSize=$img['size'];
		$imgError=$img['error'];
		$imgType=$img['type'];
		if ($imgError > 0) {
                switch ($imgError) {
                    case 1 :
                        //�ϴ��ļ������������ռ��С
						return 1;
                    case 2 :
						//�ϴ��ļ��������������
						return 2;
                    case 3 :
					    //�ļ��������ϴ�
						return 3;
                    case 4 :
						//û���ҵ�Ҫ�ϴ����ļ�
						return 4;
                    case 6 :
						//д�뵽��ʱ�ļ��г���
						return 5;
					default:
					  break;
				}
            }
		 if(is_uploaded_file($imgTemp)){
			  $randNumber=rand(10000,99999);
			  $imgType=explode('/',$imgType)[1];
			  $imgNewName=time().$randNumber.'.'.$imgType;
              if(move_uploaded_file($imgTemp, 'img/'.$imgNewName)){
				  $imgPaths[]=$imgNewName;				   
			   }else{
				   exitSend('SAVE FAIL');
			   }				
           }else{
                exitSend('UPLOAD FAIL');
           }
         

	}
	return $imgPaths;
}