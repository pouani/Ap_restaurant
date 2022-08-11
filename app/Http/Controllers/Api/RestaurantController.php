<?php
namespace App\Http\Controllers\Api;


use Exception;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    
    public function index()
    {
        $restaurant = Restaurant::all();

       return response()->json([
        'Categories' => $restaurant,
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

            $restaurant = new Restaurant();
            $restaurant->name = $request->get('name');
            $restaurant->adresse = $request->get('adresse');
            $restaurant->menu = $request->get('menu');
            $restaurant->image = $request->get('image');
            $restaurant->active = $request->get('active');
            $restaurant->save();

            return response()->json([
                'success' =>true,
                'message' => 'Nouveau restaurant créé!!!'
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
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
