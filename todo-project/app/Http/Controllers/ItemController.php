<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
class ItemController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Authentication required'], 401);
        }

        // Fetch only the to-do list items associated with the authenticated user
        $todoListItems = Item::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return response()->json($todoListItems, 200);
    }

    public function create()
    {

    }





    public function store(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Authentication required'], 401);
        }

        $input = $request->all();

        // Create a to-do list item with the user's ID
        $todoListItem = new Item([
            'name' => $input['name'],
            'user_id' => $user['id'],
        ]);

        $todoListItem->save();

        return response()->json(['status' => true, 'message' => 'To-do list item created successfully'], 201);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Request $request, string $id)
    {
        $user = Auth::user(); // Get the authenticated user

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Authentication required'], 401);
        }

        $existingItem = Item::find($id);

        if ($existingItem) {
            $newName = $request->input('name');

            // Check if the 'name' field exists in the request
            if ($newName !== null) {
                // Update the item only if it belongs to the authenticated user
                if ($existingItem->user_id === $user->id) {
                    $existingItem->name = $newName;
                    $existingItem->save();
                    return $existingItem;
                } else {
                    return response()->json(['message' => 'You do not have permission to edit this item'], 403);
                }
            }

            // Handle if 'name' field is missing in the request
            return response()->json(['message' => 'Name field is missing in the request'], 400);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $existingItem = Item::find( $id);
        if($existingItem){

            $existingItem->completed = !$existingItem->completed;

            $existingItem->completed_at = $existingItem->completed ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;

        }
        return response()->json(['message' => 'Item not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $existingItem = Item::find($id);
        if($existingItem){
            $existingItem->delete();

            return "Item Successfully deleted";

        }

        return "Item not Found";

    }
}
