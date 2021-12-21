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

$('button[handle="filterExec"]').on('click', (event)=>{
    query = generate_query();
    window.location.replace('http://energos/main/filter/' + query);
    console.log(query);
    event.stopPropagation();
})

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