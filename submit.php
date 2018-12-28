<?php
 //phpinfo();
// Здесь нужно сделать все проверки передаваемых файлов и вывести ошибки если нужно
 
// Переменная ответа
 
$data = array();
//print_r($_POST);
//print_r($_GET);
//print_r($_FILES);

if( isset( $_GET['uploadfiles'] ) ){
    $error = false;
    $files = array();
 
    $uploaddir = '/var/www/domains/ng.nfksber.ru/files/'; // . - текущая папка где находится submit.php
    $uploaddir = '/home/u108930/dev-tech.ru/www/files/';
 
    // Создадим папку если её нет
 
    //if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
    
    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
        
      echo $file['name'];//это значение потом подставляется в форму на странице
      // echo '<br>'.$uploaddir . basename($file['name']) ;

        if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){            
            //echo '<br> временный файл перемещен';
            //echo '<br>'.$uploaddir . basename($file['name']) ;
            $files[] = realpath( $uploaddir . $file['name'] );            
        }
        else{
            //echo '<br>'."error \n";
            //echo '<br>'.$uploaddir . basename($file['name']) ;
            $error = true;
        }
    }
    //echo '<br>'."массив файлов</br>";
    //print_r($files);
    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );
 
    //echo json_encode( $data );
}

// исходное изображение
$img=$files[0];

// imagecreatefrompng - создаёт новое изображение из файла или URL
// водяной знак
$wm=imagecreatefrompng('gorizont2.png');

// imagesx - получает ширину изображения
$wmW=imagesx($wm);

// imagesy - получает высоту изображения
$wmH=imagesy($wm);

// imagecreatetruecolor - создаёт новое изображение true color
$image=imagecreatetruecolor($wmW, $wmH);

// выясняем расширение изображения на которое будем накладывать водяной знак
if(preg_match("/.gif/i",$img)):
    $image=imagecreatefromgif($img);
elseif(preg_match("/.jpeg/i",$img) or preg_match("/.jpg/i",$img)):
    $image=imagecreatefromjpeg($img);
    //echo "загрузилось jpg ".$img;
elseif(preg_match("/.png/i",$img)):
    $image=imagecreatefrompng($img);
else:
    die("Ошибка! Неизвестное расширение изображения");
endif;
// узнаем размер изображения
$size=getimagesize($img);

// указываем координаты, где будет располагаться водяной знак
/*
* $size[0] - ширина изображения
* $size[1] - высота изображения
* - 10 -это расстояние от границы исходного изображения
*/
$cx= $size[0]-$wmW-10;
$cy= $size[1]-$wmH-10;

/* imagecopyresampled - копирует и изменяет размеры части изображения
* с пересэмплированием
*/
imagecopyresampled ($image, $wm, $cx, $cy, 0, 0, $wmW, $wmH, $wmW, $wmH);

/* imagejpeg - создаёт JPEG-файл filename из изображения image
* третий параметр - качество нового изображение 
* параметр является необязательным и имеет диапазон значений 
* от 0 (наихудшее качество, наименьший файл)
* до 100 (наилучшее качество, наибольший файл)
* По умолчанию используется значение по умолчанию IJG quality (около 75)
*/
imagejpeg($image,$img,90);

// imagedestroy - освобождает память
imagedestroy($image);

imagedestroy($wm);

// на всякий случай
unset($image,$img);

//echo $img;

?>