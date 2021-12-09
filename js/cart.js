items = JSON.parse(localStorage.getItem('cart'));


var vue = new Vue({
    el: '#main',
    data:{
      cart: items
    }
});

function remFromCart(id){
    item = items.find(item => item.id == id);
    let removeIndexcart = items.indexOf(item);
    if(removeIndexcart != -1){
        items.splice(removeIndexcart, 1);
        localStorage.setItem('cart', JSON.stringify(items));
    }else{
        console.log('оишбка');
    }
      
}