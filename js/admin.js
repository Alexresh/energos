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