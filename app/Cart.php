<?php

namespace App;

class Cart
{

    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if ($cart) {
            $this->items = $cart->items;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQty = $cart->totalQty;
        } else {
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product)
    {
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 0,
            'image' => $product->image
        ];

        if (!array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $product->price;
        } else {
            $this->totalQty += 1;
            $this->totalPrice += $product->price;
        }
        $this->items[$product->id]['quantity'] += 1;
    }

    public function updateQuantity($product_id, $quantity)
    {
        // remove existing quantity and price for the product
        $this->totalQty -= $this->items[$product_id]['quantity'];
        $this->totalPrice -= $this->items[$product_id]['price'] * $this->items[$product_id]['quantity'];

        //add item with new quantity and price
        $this->items[$product_id]['quantity'] = $quantity;
        $this->totalQty += $quantity;
        $this->totalPrice += $this->items[$product_id]['price'] * $quantity;
    }

    public function remove($product_id)
    {
        if (array_key_exists($product_id, $this->items)) {
            $this->totalQty -= $this->items[$product_id]['quantity'];
            $this->totalPrice -= $this->items[$product_id]['price'] * $this->items[$product_id]['quantity'];

            unset($this->items[$product_id]);
        }
    }
}
