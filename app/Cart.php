<?php

namespace App;

class Cart {

    public $items = null;
    public $deliveryDetail = null;
    public $rec = "";
    public $pickup_time = null;
    public $pickup_date = null;
    public $promo_code = null;
    public $discount_percentage = null;
    public $orderID = 0;
    public $userID = 0;
    public $totalQty = 0;
    public $totalDiscountAmount = 0;
    public $totalPrice = 0;
    //public $delivery_cost = 0;
    public $delivery_cost = 0;

    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            if(empty($oldCart->rec))
            {
                $this->rec = "";
                $this->delivery_cost = 1.5;
            }
            else
            {
                $this->rec = $oldCart->rec;
                $this->pickup_date = $oldCart->pickup_date;
                $this->pickup_time = $oldCart->pickup_time;
                $this->promo_code = $oldCart->promo_code;
                $this->discount_percentage = $oldCart->discount_percentage;
            }

            $this->delivery_cost = $oldCart->delivery_cost;
            $this->deliveryDetail = $oldCart->deliveryDetail;
            $this->orderID = $oldCart->orderID;
            $this->userID = $oldCart->userID;
            $this->totalQty = $oldCart->totalQty;
            $this->totalDiscountAmount = ($oldCart->discount_percentage / 100) * $oldCart->totalPrice;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $item_qty) {
        $storeditem = ['qty' => $item_qty, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
                $this->totalPrice -= $storeditem['price'];
            }
        }
        $storeditem['qty'] = $item_qty;
        $storeditem['price'] = $item->price * $storeditem['qty'];
        $this->items[$id] = $storeditem;
        $this->totalQty += $item_qty;
        $this->totalPrice += $storeditem['price'];
    }

    public function addSingleSubcat($item, $id, $sub_cat_name, $item_qty) {
        $storeditem = ['qty' => $item_qty,'sub_cat_name'=>$sub_cat_name, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
                $this->totalPrice -= $storeditem['price'];
            }
        }
        $storeditem['qty'] = $item_qty;
        $storeditem['price'] = $item->price * $storeditem['qty'];
        $this->items[$id] = $storeditem;
        $this->totalQty += $item_qty;
        $this->totalPrice += $storeditem['price'];
    }

    public function addRec($rec='', $pickup_time='', $pickup_date='', $promo_code=null, $discount=null) {
        $this->rec = $rec;
        $this->pickup_time = $pickup_time;
        $this->pickup_date = $pickup_date;
        $this->promo_code = $promo_code;
        $this->discount_percentage = $discount;
    } 

    public function addPromoCode($promo_code=null, $discount=null) {
        $this->promo_code = $promo_code;
        $this->discount_percentage = $discount;
        $this->totalDiscountAmount = ($discount / 100) * $this->totalPrice;
    }

    public function mergeDeliveryCost($dd=0) {
        if($this->rec=="Delivery")
        {
            $this->delivery_cost = $dd;
        }
        else
        {
            $this->delivery_cost = 0;
        }
        
    }

    public function storeDelivery($name,$phone,$address,$email,$zipcode,$asap,$delivery_date,$delivery_time,$delivery_note) {
        if(empty($this->orderID))
        {
            $this->orderID=time();
        }

        $this->userID=\Auth::user()->id;

        $this->deliveryDetail=['name'=>$name,
                                'phone'=>$phone,
                                'address'=>$address,
                                'email'=>$email,
                                'zipcode'=>$zipcode,
                                'asap'=>$asap,
                                'delivery_date'=>$delivery_date,
                                'delivery_time'=>$delivery_time,
                                'delivery_note'=>$delivery_note
                              ];
    }

    public function addSnd($item, $id,$snd_item,$snd_id, $item_qty) {
        $storeditem = ['qty' => $item_qty, 'price' => $snd_item->price, 'item' => $item, 'snd_item' =>array()];
        $storeSNDItem=['qty' => $item_qty, 'price' => $snd_item->price, 'item' => $snd_item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
                $storeditem['qty'] += $item_qty;
            }
        }

        if ($storeditem['snd_item']) {
            if (array_key_exists($snd_id, $storeditem['snd_item'])) {
                $storeSNDItem = $storeditem['snd_item'][$snd_id];
                $storeSNDItem['qty'] += $item_qty;

            }
        }


        $storeSNDItem['price'] = $snd_item->price * $storeSNDItem['qty'];
        
        if($storeditem['qty']>1)
        {
            $storeditem['price']+=$snd_item->price;
        }

        $storeditem['snd_item'][$snd_id]=$storeSNDItem;

        $this->items[$id] = $storeditem;
        $this->totalQty = $item_qty;
        $this->totalPrice += $snd_item->price;
    }

    public function addSndSubCat($item, $id,$snd_item,$snd_id,$sub_cat_name, $item_qty) {
        $storeditem = ['qty' => 0, 'price' => 0,'sub_cat_name'=>$sub_cat_name, 'item' => $item, 'snd_item' =>array()];
        $storeSNDItem=['qty' => 0, 'price' => 0,'sub_cat_name'=>$sub_cat_name, 'item' => $snd_item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
            }
        }

        if ($storeditem['snd_item']) {
            if (array_key_exists($snd_id, $storeditem['snd_item'])) {
                $storeSNDItem = $storeditem['snd_item'][$snd_id];
                $storeditem['price']-=$storeSNDItem['price'];
                $storeditem['qty'] -= $storeSNDItem['qty'];
                $this->totalQty -= $storeSNDItem['qty'];
                $this->totalPrice -= $storeSNDItem['price'];
                // return $storeSNDItem['price'];
            }
        }

        $storeSNDItem['qty'] = $item_qty;

        $storeSNDItem['price'] = $snd_item->price * $storeSNDItem['qty'];
        
        $storeditem['qty'] += $item_qty;
        // if($storeditem['qty']>1)
        // {
            $storeditem['price']+=$storeSNDItem['price'];
        // }

        $storeditem['snd_item'][$snd_id]=$storeSNDItem;

        $this->items[$id] = $storeditem;
        $this->totalQty += $item_qty;
        $this->totalPrice += $storeSNDItem['price'];
    }

    public function addexecMenu($item, $id,$execArrayData) {
        $storeditem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'exec_menu' => 1, 'execArrayData' => $execArrayData];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
            }
        }
        $storeditem['qty'] ++;
        $storeditem['price'] = $item->price * $storeditem['qty'];
        $this->items[$id] = $storeditem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function addPizzaMenu($item, $id,$size='',$flabour='',$extra='') {
        $storeditem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'pizza_menu' => 1, 
        'size' => $size,
        'flabour' => $flabour,
        'extra' => $extra
    ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
            }
        }
        $storeditem['qty'] ++;
        $storeditem['price'] = $item->price * $storeditem['qty'];
        $this->items[$id] = $storeditem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }
    
    

    public function delProduct($item, $id) {
        
        $storeditem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
            }
        }
        $storeditem['qty'] += -1;
        $storeditem['price'] = $item->price * $storeditem['qty'];
        $this->items[$id] = $storeditem;
        $this->totalQty += -1;
        $this->totalPrice += -($item->price);
        
        if($storeditem['qty']==0)
        {
            unset($this->items[$id]);
        }
        
    }

    public function delProductFullRemove($id) {
        $storeditem = ['qty' => 0, 'price' =>0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeditem = $this->items[$id];
            }
        }

        $this->totalQty += -$storeditem['qty'];
        $this->totalPrice += -$storeditem['price'];
        
        unset($this->items[$id]);
        
    }

    public function delEntireProduct($item, $id) {

        //echo $id;
        //print_r($item);
        $deduct_price = 0;
        $deduct_qty = 0;
        foreach ($this->items as $itm):
            if ($itm['item']->id == $id) {
                $deduct_price += $itm['price'];
                $deduct_qty += $itm['qty'];
            }
        endforeach;

        $newTotalPrice = $this->totalPrice - $deduct_price;
        $newTotalQty = $this->totalQty - $deduct_qty;

        $this->totalPrice = $newTotalPrice;
        $this->totalQty = $newTotalQty;

        unset($this->items[$id]);        
    }

    public function delProductRow($item, $id) {
        if ($this->items) {
            $this->totalQty = $this->totalQty - $this->items[$id]['qty'];
            $this->totalPrice = $this->totalPrice - $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function ClearCart() {
        $storeditem = ['qty' => 0, 'price' => 0, 'item' => 0];
        $this->items = null;
        $this->rec = null;
        $this->totalQty = 0;
        $this->totalPrice = 0;
    }

}
