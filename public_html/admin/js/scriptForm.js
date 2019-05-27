
$('#form-can_know_own').on('beforeSubmit', function () {
    var $yiiform = $(this);
    // отправляем данные на сервер
    $.ajax({
            type: 'POST',
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray(),
            success: function( data, status, xhttp) {
             // data will be true or false if you returned a json bool
                if(data.success) {
                  $('#toast-success').addClass('show');
                  setTimeout(function(){
                  $('#toast-success').removeClass('show');
                }, 1500);
                }
            },
        }
    )

    return false; // отменяем отправку данных формы
});

