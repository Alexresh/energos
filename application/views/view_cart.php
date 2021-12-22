<link rel="stylesheet" href="css/reglog.css">
<div class="main" style="text-align:center; left:10%">
    <?php 
        if(!isset($_SESSION['User'])){
            echo "<p>Войдите прежде чем составлять корзину</p>";
        }else{
    ?>


    <a href="/cart/clear">Очистить</a>
    <table cellspacing="5" cellpadding="5">
    <?php foreach ($cartItems as $item) {?>
        <tr>
            <td>Название: <?php echo $item->title?></td>
            <td>Количество: <?php echo $item->count?></td>
            <td>Цена: <?php echo $item->price*$item->count?></td>
        </tr>
    <?php  }echo '</table>';}?>
</div>
