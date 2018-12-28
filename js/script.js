$(document).ready(function() {
    console.log("ready!");

    function getFile() {
        // Переменная куда будут располагаться данные файлов 
        var files;
        // Вешаем функцию на событие
        // Получим данные файлов и добавим их в переменную    
        $('#file_img').change(function() {
            files = this.files;
        });

        return files;
    }

    function deleteUrlS(URLobg) {
        var string = String(URLobg);
        var shotUrl = string.substring(17);
        return shotUrl;
    }

    function downloadUrlImg(files_path) {
        $('#download_img').attr('href', files_path);
        $('#prew_img').attr('src', files_path);
    }

    // Вешаем функцию ан событие click и отправляем AJAX запрос с данными файлов
        var form = document.forms.namedItem("fileinfo");
        form.addEventListener('submit', function(ev) {

          var oOutput = document.querySelector("div"),
              oData = new FormData(form);


          oData.append("CustomField", "This is some extra data");

          var oReq = new XMLHttpRequest();
          oReq.open("POST", "submit.php?uploadfiles", true);
          oReq.onload = function(oEvent) {
            if (oReq.status == 200) {
                console.log(oEvent.srcElement.response);
                var url_img = String(oEvent.srcElement.response);
              oOutput.innerHTML = '<a href="files/'+url_img+'" download > <img src="files/'+url_img+'" style="width: 100%;"> </a>';
            } else {
              oOutput.innerHTML = "Error " + oReq.status + " occurred when trying to upload your file.<br \/>";
            }
          };

          oReq.send(oData);
          ev.preventDefault();
        }, false);

    $('#load_img').click(function(event) {
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault(); // Полная остановка происходящего

        // Создадим данные формы и добавим в них данные файлов из files

        // Переменная куда будут располагаться данные файлов 
        var filesImg;
        // Вешаем функцию на событие
        // Получим данные файлов и добавим их в переменную    
        var filesInput = $('#file_img');
        filesImg = filesInput[0].files[0]; // FileList object
        //filesInput.files[0];
        console.log(filesInput);
        console.log("--------")

        var arrdata = new FormData(document.getElementById("file_img"));

        console.log(filesImg);
        console.log('******');
        console.log(arrdata);

        $.each(filesImg, function(key, value) {
            arrdata.set(key, value);
            console.log(key + ' ** ' + value);
        });


        //arrdata.append('img', '15454042395331342979644.jpg');

        console.log('======');
        console.log(arrdata.getAll('name'));
        console.log(arrdata);
        // Отправляем запрос

        $.ajax({
            url: 'submit.php?uploadfiles',
            type: 'POST',
            data: arrdata,
            cache: false,
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            
            success: function(respond, textStatus, jqXHR) {
                // Если все ОК
                if (typeof respond.error === 'undefined') {
                    // Файлы успешно загружены, делаем что нибудь здесь
                    // выведем пути к загруженным файлам в блок '.ajax-respond'                    
                    var files_path = respond.files;
                    console.log(files_path);
                    files_path = 'http://' + deleteUrlS(files_path);
                    console.log(files_path);
                    downloadUrlImg(files_path);
                } else {
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
                }
            },
            
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('ОШИБКИ AJAX запроса: ' + textStatus);
                console.log(jqXHR);
                console.log(errorThrown);
            }
        })  ;

    });

});