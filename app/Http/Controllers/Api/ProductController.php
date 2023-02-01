<?php
namespace App\Http\Controllers\Api;


use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json(
                $products
            ,200);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:300',
            ]);
            
            if($validator->fails()){
                return response()->json([
                    "success" => false,
                    "message" => $validator->errors()
                ]);
            }

            $product = Product::create([
                'name' => $request->name, 
                'price' => $request->price, 
                'description' => $request->description, 
                'active' => $request->active, 
                'categorie_id' => $request->categorie_id
            ]);

            $product->addMedia($request->image)->toMediaCollection('images');
            $product = $product->fresh();

            return response()->json([
                'success' =>true,
                'message' => 'Nouveau produit ajouté!!!'
            ],200);

        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            return response()->json(
                $product
            ,200);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $id)
    {
        try{

            $product=Product::find($id);
            $product->update($request->all());

            return response()->json([
                'success' => true,
                'message' => $product
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ],500);
        }
        
        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->save();
    
        // return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::where('id', $id)->delete();
            return response()->json([
                'success' =>true,
                'message' => 'Produit Supprimé!!!'
            ],200);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ],500);
        }
    }

    // public function search($name)
    // {
    //     //
    //     return Product::where('name','like','%'.$name.'%')->get();
    // }
}
