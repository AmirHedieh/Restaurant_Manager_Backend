<?php

namespace App\Http\Controllers;

use App\Custom\Utils;
use App\Custom\Validators;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller {
    public function index() {
        return Utils::makeJsonResponse(
            true,
          Item::all()
        );
    }

    public function show($id) {
        return Utils::makeJsonResponse(
            true,
            Item::find($id)
        );
    }

    public function store(Request $request) {
        $validator = Validators::itemStoreValidator($request);
        if($validator->fails()) {
            return Utils::makeJsonResponse(false, $validator->errors());
        }
        $item = new Item();
        $item->category = $request->category;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->count = $request->count;
        $item->available = $request->available;
        $item->description = $request->description;

        try{
            $item->save();
            return Utils::makeJsonResponse(true, $item);
        } catch(\Exception $exception) {
            return Utils::makeJsonResponse(false, $exception->getMessage());
        }
    }

    public function update() {

    }

    public function delete($id) {
        try {
            $item = Item::find($id);
            $item->delete();
            return Utils::makeJsonResponse(true, null);
        } catch (\Exception $exception) {
            return Utils::makeJsonResponse(false, $exception->getMessage());
        }
    }
}
