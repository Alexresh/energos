<div class="main" style="text-align:center">
    <?php if(isset($_SESSION["Cart"])) echo '<a href="/cart/clear">Очистить</a>'?>
    
    <?php foreach ($_SESSION["Cart"]->items as $item) { ?>
        <div>
            <p>Название: <?php echo $item->itemTitle?> Количество: <?php echo $item->count?> Цена: <?php echo $item->price*$item->count?></p>
        </div>
    <?php }?> 
</div>
