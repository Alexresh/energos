<div class="sidebar">
    <div id="filters">
      <h2>Фильтры</h2>
      <h3>Виды упаковки</h3>
      <ul>
        <li>
          <input class="checkbox" type="checkbox" value="zb" name="zb">
          <label for="zb">Ж/Б</label>
        </li>
        <li>
          <input class="checkbox" type="checkbox" value="pet" name="pet">
          ПЭТ
        </li>
      </ul>
      <h3>Компании</h3>
    </div>
</div>
<div class="main" id="main">
    <div id="success"><img src="images/success.png" alt="">Добавлено</div>
    <!-- <div v-for="energetic in energetics" class="item-wrapper">
        <div class="item">
        <div class="item-title">
            {{energetic.title}}
        </div>
        <div class="item-img">
            <img v-bind:src="energetic.img" alt="">
        </div>
        <div class="item-desc">
            {{energetic.desc}}
        </div>
        <div class="item-price">
            {{energetic.price}}₽
        </div>
        <button class="addToCartBtn" v-on:click="addToCart(energetic.id)">В корзину</button>
        </div>
    </div> -->
    <?php foreach ($items as $item) {?>
      <div class="item-wrapper">
          <div class="item">
            <div class="item-title">
              <?php echo $item->title?>
            </div>
            <div class="item-img">
              <img src="../../images/energetics/<?php echo $item->image?>" alt="Фото <?php echo $item->title?>">
            </div>
          <div class="item-desc">
            <?php echo $item->description?>
          </div>
          <div class="item-price">
            <?php echo $item->price?>₽
          </div>
          <button handle ="cart" value="<?php $item->id?>" class="addToCartBtn">В корзину</button>
        </div>
      </div>
    <?php }?>
</div>
<script src="js/vue.min.js"></script>
<script src="js/items.js"></script>