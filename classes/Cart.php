<?php
/**
 * Cart session to store shopping list items
 */
class Cart {
    /**
     * Check if there are items is cart
     * 
     * @return boolean True has items in cart, false otherwise
     */
    public static function itemInCart(){
        
        return !empty($_SESSION['cart']);
    }

    
}

