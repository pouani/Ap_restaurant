<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api')->except('index','show');
    // }
   
    public function index()
    {
        
       $categories = Categorie::all();

       return response()->json([
        'Categories' => $categories,
       ]);
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

            $categorie = new Categorie();
            $categorie->name = $request->get('name');
            $categorie->save();

            return response()->json([
                'success' =>true,
                'message' => 'Nouvelle categorie produit créé!!!'
            ], 200);

        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $categorie = Categorie::find($id);

            return response()->json([
                'success' =>true,
                'message' => $categorie
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
       if($categorie->update($request->all())){
            return response()->json([
                'success' => 'Modification effectuee !!!'
            ], 200);
       }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Categorie::where('id', $id)->delete();
            return response()->json([
                'success' =>true,
                'message' => 'Categorie Produit Supprimé!!!'
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
