<?php

$shoppingList=($_SESSION['cart']);
$cartEmpty ? $title="Votre liste d'épicerie est vide." : $title="Votre liste d'épicerie: ";

$count=1;

/**
 * Clear cart function
 */
function clearCart(){
    $_SESSION['cart']= [];
}
?>

<section>
    <div class="row1">
    <div class="main-content">
        <!--Shopping list items-->

        <div class="row1">
            <h3 class="mt-100 h3-light"><?= $title ?></h3>
            <ul class="fa-ul">
                <?php if(!$cartEmpty) : ?>
                    <?php foreach($shoppingList as $item) : ?>
                        <li class="item-print">
                        <span class="fa-li"><i class="fa-regular fa-square"></i></span> <?= $item; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>           
        </div>
        <div class="print sticky">
        <button type="button" class="btn-print" onClick="printList();">
            <i class="fas fa-print fa-lg"></i>
        </button>
        </div>
    </div>
    </div>
    
</section>

