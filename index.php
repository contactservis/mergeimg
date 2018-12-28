<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>15 лет</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js"  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="  crossorigin="anonymous"></script>
        <script src="js/materialize.js"></script>
        <script src="js/script.js"></script>
        <meta name="viewport" content="height=device-height,width=device-width" />
    </head>
    <body>
        <main>
            <div class="container" style="text-align: center;">
                <form enctype="multipart/form-data" method="post" name="fileinfo">                  
                  <input type="file" name="file" id="creat_photo" accept="image/*" capture="camera" multiple="" required value="Сделать фото" style="display:none;"/>
                  <p>1. Сделайть фото</p>
                  <label for="creat_photo"><img src="photo_btn.png" style="width: 50%;"/></label>
                  <input type="submit" value="Обработать" id="process_img" style="display:none;"/>
                  <p>2. Добавить красоты</p>
                  <label for="process_img"><img src="magic_btn.png" style="width: 50%; margin-top: 50px;"/></label>
                </form>
                <div></div>
            </div>
        </main>
        <footer class="page-footer" style="background-color: #26a69a;">
            <div class="footer-copyright">
                <div class="container">
                © 2018 АО "НФК-Сбережения"
                </div>
            </div>
        </footer>
    </body>
</html>