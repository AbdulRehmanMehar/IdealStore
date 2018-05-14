<?php

namespace App;

class Cart{
  public $items = null;
  public $totalQtty = 0;
  public $totalPrice = 0;

  public function __construct($oldCart){
    if($oldCart){
      $this->items = $oldCart->items;
      $this->totalQtty = $oldCart->totalQtty;
      $this->totalPrice = $oldCart->totalPrice;
    }
  }

  public function add($item , $id, $qtty = 1){
    $storedItem = [
      'qtty' => 0,
      'price' => $item->price,
      'item' => $item
    ];
    if($this->items){
      if(array_key_exists($id , $this->items)){
        $storedItem = $this->items[$id];
      }
    }
    $storedItem['qtty'] += $qtty;
    $storedItem['price'] = $item->price * $storedItem['qtty'];
    $this->items[$id] = $storedItem;
    $this->totalQtty += $qtty;
    $this->totalPrice += $item->price * $qtty;
  }

  public function delete($item, $id, $qtty){
    if($this->items){
      if(array_key_exists($id , $this->items)){
        unset($this->items[$id]);
      }
    }
    $this->totalQtty -= $qtty;
    $this->totalPrice -= $item->price * $qtty;
  }

  public function update($item, $id, $old_qtty, $new_qtty){
    $this->delete($item, $id, $old_qtty);
    if($new_qtty > 0){
      $this->add($item, $id, $new_qtty);
    }
  }

}
