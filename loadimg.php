<?php

$allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // Допустимые типы файлов
$max_filesize = 524288; // Максимальный размер файла в байтах (в данном случае он равен 0.5 Мб).
$upload_path = '/var/www/domains/ng.nfksber.ru/'; // Папка, куда будут загружаться файлы .
$filename = $_FILES['userfile']['name']; // В переменную $filename заносим имя файла (включая расширение).
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // В переменную $ext заносим расширение загруженного файла.

if(!in_array($ext,$allowed_filetypes)) // Сверяем полученное расширение со списком допутимых расширений. 
die('Данный тип файла не поддерживается.');

if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize) // Проверим размер загруженного файла.
die('Фаил слишком большой.');

if(!is_writable($upload_path)) // Проверяем, доступна ли на запись папка.
die('Невозможно загрузить фаил в папку. Установите права доступа - 777.');

// Загружаем фаил в указанную папку.
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $filename))
{
    echo 'Ваш фаил успешно загружен ';
    echo '<br><br>';
    echo '<img src="' . $upload_path . $filename . '" width="300" >';
} else {
    echo 'При загрузке возникли ошибки. Попробуйте ещё раз.';
}

?>