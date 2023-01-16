<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemListController extends Controller
{


    //商品編集画面に変移する
    public function edit(){
        
    }

    //アイテムを削除する
    public function ListDelete(Request $request,$id){
        //既存のレコードを取得して削除する
        $item = Item::where('id', '=', $id)->first();
        $item->delete();

        return redirect('items');
    }
}
