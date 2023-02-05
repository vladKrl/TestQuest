// Обработка нажатия кнопки авторизации
$('.buttonAuthorization').click(function(e){
    e.preventDefault();
    
    let userlogin = $('input[name="userloginAuth"]').val(), password = $('input[name="passwordAuth"]').val();

    $('.msg').text('');
  

    $.ajax({
        url: "../php/userSignIn.php",
        type: 'POST',
        dataType: 'json',
        data: {
            userlogin: userlogin,
            password: password
        },
        success: function(data){
            if (data.status){
                document.location.href = 'welcoming.php';
            } else {


                $('#notValidAuthorizePassword').text(data.notValidAuthorizePassword);
                $('#notValidAuthorizeLogin').text(data.notValidAuthorizeLogin)

                $('input').val(''); 
            }
        } 
    })
});

// Обработка нажатия кнопки регистрации
$('.buttonRegistration').click(function(e){
    e.preventDefault();
    
    let userlogin = $('input[name="userlogin"]').val(), 
        password = $('input[name="password"]').val(),
        confirmpassword = $('input[name="confirmpassword"]').val(),
        email = $('input[name="email"]').val(),
        username = $('input[name="username"]').val();
    
    $('.msg').text('');

    $.ajax({
        url: "../php/userSignUp.php",
        type: 'POST',
        dataType: 'json',
        data: {
            userlogin: userlogin,
            password: password,
            confirmpassword: confirmpassword,
            email: email,
            username: username
        },
        success: function(data){
            
            if (data.status){
                document.location.href = 'welcoming.php';
            } else {
                for (var key in data) {
                    if (key != 'status') {
                        let messageId = '#' + key;
                        $(messageId).text(data[key])
                    }
                    $('input').val('');
                }
            }
        } 
    })
});

// Обработка нажатия кнопки выхода
$('.buttonLogOut').click(function(e){
    e.preventDefault();
    
    $.ajax({
        url: "../php/userLogOut.php",
        type: 'POST',
        dataType: 'json',
        data: {
            
        },
        success: function(data){
            if (data.status){
                document.location.href = 'registration.php';
            }
        } 
    })
});