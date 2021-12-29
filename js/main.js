//click on "add to cart" button
$('button[handle="cart"]').on('click', (event)=>{

    //get item id 
    let item = event.target.getAttribute("value");
    //send item id to "add controller"
    $.post('http://energos/cart/add',{
        item: item
    });

    //shows success block for a few seconds 
    $("#success").css("display", "block");
    setTimeout(function(){
        $("#success").css("display", "none");
    }, 1200);

    event.stopPropagation();

});

let query = "?";
//click on Search button. Generate filter query and navigating through it
$('button[handle="filterExec"]').on('click', (event)=>{
    query = generate_query();
    window.location.replace('http://energos/main/filter/' + query);
    event.stopPropagation();
})
//gets the value of each filter
function generate_query(){
    query = "?";
    $('input[handle="filter"]').each(function (index, value){
        let a = $(value).attr('value');
        if(this.checked) query = query + "&" + a +"=true";
    });
    return query;
}

$(window).on('load', function() { 
    query = generate_query();    
});

//register button
$('button[handle="register"]').on('click', (event)=>{
    let firstName = $('input[name="firstName"]').val();
    let lastName = $('input[name="lastName"]').val();
    let nickname = $('input[name="nickname"]').val();
    let password = $('input[name="password"]').val();
    let confirmPassword = $('input[name="confirmPassword"]').val();
    let location = $('input[name="location"]').val();
    $('#warn').html("");
    if(password.localeCompare(confirmPassword) != 0){
        $('#warn').html("Пароли не совпадают");
        return;
    }
    if(password.length < 6){
        $('#warn').html("Пароль короткий");
        return;
    }
    if(firstName == '' || lastName == '' || nickname == '' || password == '' || confirmPassword == '' || location == ''){
        $('#warn').html("Пожалуйста заполните все поля");
        return;
    }
    $.post('http://energos/register/new', 
        {
            firstName: firstName, 
            lastName: lastName, 
            nickname: nickname,
            password: password,
            location: location
        }, function(data) {
            if(data == "200"){
                $('#warn').html("Вы успешно зарезестрировались, переходим на страницу входа");
                setTimeout(()=>
                    {
                        window.location.replace('http://energos/login');
                    }, 2000);
            }
        });
    
    event.stopPropagation();
})

$('button[handle="login"]').on('click', (event)=>{
    let nickname = $('input[name="nickname"]').val();
    let password = $('input[name="password"]').val();
    $('#warn').html("");
    if(password.length < 6){
        $('#warn').html("Пароль короткий");
        return;
    }
    if(nickname == '' || password == '' ){
        $('#warn').html("Пожалуйста заполните все поля");
        return;
    }
    $.get('http://energos/login/login', 
        {
            nickname: nickname,
            password: password
        }, function(data) {
            if(data != "400"){
                $('#warn').html("Здравствуйте, " + data);
                setTimeout(()=>
                    {
                        window.location.replace('http://energos/');
                    }, 2000);
            }else{
                $('#warn').html("Неверные данные");
            }
        });
    
    event.stopPropagation();
})

