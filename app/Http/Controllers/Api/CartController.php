<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;
//use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    public function index()
    {
        // try {
        //     $cartItem = \Cart::getContent();

        //     return response()->json([
        //         'sucess' => true,
        //         'total' => $cartItem->getSubTotal(),
        //         'message' => $cartItem->getMessage(),
        //     ]);
        // }catch(Exception $e) {
        //     return response()->json([
        //         'sucess' => false,
        //         'message' => $e->getMessage(),
        //     ]);
        // }

        $cartContent = (new CartRepository())->content();

        return response()->json([
            'cartContent'=> $cartContent
        ]);
    }

    public function store(Request $request)
    {
       
        $product = Product::where('id', $request->id)->first();
        $count = (new CartRepository())->addCart($product);

        return response()->json([
            'count' => $count,
        ]);
    }

    // public function cartUpdate(Request $request)
    // {
    //     \Cart::update(
    //         $request->id,
    //         [
    //             'quantity' => [
    //                 'relative' => false,
    //                 'value' => $request->quantity,
    //             ],
    //         ]
    //     );
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Cart updated successfully',
    //         ],200);
    // }

    public function destroy($id)
    {
        (new CartRepository())->remove($id);
    }

    public function increase($id)
    {
        (new CartRepository())->increase($id);
    }

    public function decrease($id)
    {
        (new CartRepository())->decrease($id);
    }

    public function count() 
    {
        $count = (new CartRepository())->count();

        response()->json([
            'count' => $count,
        ]);
    }

    // public function cartRemove($id)
    // {
    //     \Cart::remove($id);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Cart removed successfully',
    //     ], 200);
    // }

    // public function cartClear()
    // {
    //     try {
    //         \Cart::clear();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Cart cleared successfully',
    //     ], 200);
    //     }catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ],500);
            
    //     }
    // }

}
