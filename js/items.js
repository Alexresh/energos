items = [
  {
      "id":1,
      "title":"Tornado Coffee",
      "img":"images/energetics/tornadoCoffePET.png",
      "desc":"Энергетический напиток торнадо со вкусом Кофе Ж/Б",
      "price":45
  },
  {
      "id":2,
      "title":"Tornado Storm",
      "img":"images/energetics/tornadoStormZB.png",
      "desc":"Энергетический напиток торнадо со вкусом Storm ПЭТ",
      "price":45
  },
  {
      "id":3,
      "title":"Monster Black",
      "img":"images/energetics/monsterBlackZB.png",
      "desc":"Энергетический напиток Monster Black Ж/Б",
      "price":100
  },
  {
      "id":4,
      "title":"Monster Ultra",
      "img":"images/energetics/monsterUltraZB.png",
      "desc":"Энергетический напиток Monster Ultra Ж/Б",
      "price":100
  },
  {
      "id":5,
      "title":"Monster Ultra",
      "img":"images/energetics/monsterBlackVR46ZB.png",
      "desc":"Энергетический напиток Monster Black VR|46 Ж/Б",
      "price":100
  },
  {
      "id":6,
      "title":"Tornado Active",
      "desc":"Энергетический напиток торнадо Active"
  }
];

var cart = [];


var vue = new Vue({
    el: '#main',
    data:{
      energetics: items
    }
});

function addToCart(id){
  let item = items.find(item => item.id == id);
  if(item != undefined){
    cart.push(item);
  }
  localStorage.setItem('cart', JSON.stringify(cart));
  let successEl = document.getElementById("success");
  successEl.style.display = 'block';
  setTimeout(()=>{successEl.style.display = 'none'}, 1*1000)
}
