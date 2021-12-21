$('button[handle="cart"]').on('click', (event)=>{

    let item = event.target.getAttribute("value");
    console.log(item);
    $("#success").css("display", "block");
    setTimeout(function(){
        $("#success").css("display", "none");
    }, 1200);

    event.stopPropagation();

})
let query = "?";
$('button[handle="filter"]').on('click', (event)=>{
    query.replace("&zb=true", '');
    query.replace("&pet=true", '');
    if($("input[name=zb]").is(":checked")){
        query += "&zb=true";
    }else{
        query.replace("&zb=true", '');
    }
    if($("input[name=pet]").is(":checked")){
        query +="&pet=true";
    }else{
        query.replace("&pet=true", '');
    }
    console.log(query);
    event.stopPropagation();

})

$('input[handle="brandFilter"]').on('click', (event)=>{

    let value = event.target.getAttribute('value');
    query.replace("&" + value + "=true", '');
    if(event.target.checked){
        query = query += "&" + value +"=true";
    }else{
        query = query.replace("&" + value + "=true", '');
    }
    console.log(query);
    event.stopPropagation();

})