$(document).ready(function(){

    $('#form').submit(function(e) {
        e.preventDefault();
        ///проверка выбора департамента и клапана
        var department = $('#autoSizingSelect').val();
        var valve = $('#autoSizingSelectValve').val();
        console.log(valve);
        if(isNaN(department)){
            alert('Выберите департамент')
            return false
        }
        if(isNaN(valve)){
            alert('Выберите клапан');
            return false
        }
  ////небольшая валидация формы отправки: проверка на допустимые символы в input
        var arr = ['1_size', '1_EC', '1_PH','2_size','2_EC','2_PH','3_EC','3_PH'];

    var stopsubmit = '';

        $.each(arr,function(index,value){


            if( $('input[name='+value+']').val() == '')
            {
                stopsubmit=1;
            }

        });

            if(stopsubmit == 1){
                alert('заполните все поля');
                return false
            }

            var stopsubmit2 = '';
        $.each(arr,function(index,value){
//
            var regEx = /^[0-9,]+$/;
            var valid = regEx.test($('input[name='+value+']').val());

            if (!valid) {
                stopsubmit2=1;
            }


        });

        if(stopsubmit2 == 1){
            alert('ВВедены недопустимые символы');
            return false
        }



        ////Отправка данных формы через ajax
        $.ajax({
            type: $(this).attr('method'),
            url: 'backend.php',
            data: $(this).serialize(),
            async: false,
            dataType: "html",
            success: function( ){
                alert('Форма отправлена !');

            }
        });
        ///сброс inputов после отправки
        $(this)[0].reset();
    });


});
