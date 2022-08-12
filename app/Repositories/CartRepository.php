<?php
namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function addCart($product) 
    {
         // add the product to cart
        \Cart::session(auth()->user()->id)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            // 'associatedModel' => $product
        ));

        return $this->count(); 
    }

    public function content()
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    public function increase($id)
    {
        \Cart::session(auth()->user()->id)
            ->update($id, [
                'quantity' => +1
            ]);
    }

    public function decrease($id)
    {
        $item = \Cart::session(auth()->user()->id)->get($id);

        if($item->quantity === 1){
            $this->remove($id);
            return;
        }

        \Cart::session(auth()->user()->id)
            ->update($id, [
                'quantity' => -1
            ]);
    }

    public function remove($id)
    {
        \Cart::session(auth()->user()->id)->remove($id);
    }

    public function count()
    {
        return $this->content()
            ->sum('quantity');
    }
}