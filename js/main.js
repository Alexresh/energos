$('button[handle="cart"]').on('click', (event)=>{

    let item = event.target.getAttribute('value');
    console.log(item);
    $("#success").css("display", "block");
    setTimeout(function(){
        $("#success").css("display", "none");
    }, 1200);

    event.stopPropagation();

})