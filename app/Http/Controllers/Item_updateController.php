<?php

namespace App\Http\Controllers;

use App\Models\Item as ModelsItem;
use Illuminate\Http\Request;
use App\Models\Item;

class Item_updateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
       return view('item.item_update')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Item::find($id);
       return view('item.item_update')->with('item', $items);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

//１. バリデーション機能
$this->validate($request, [
    'name' => ['required'],
    'type' => ['required'],
    'detail' => ['required'],
]);  



        $item=Item::find($id);

        $item->name=$request->input('name');
        $item->type=$request->input('type');
        $item->detail=$request->input('detail');

        // ディレクトリ名
        $dir = 'sample';
        if($request->file('file')){
            // アップロードされたファイル名を取得
            $file_name = $request->file('file')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('file')->storeAs('public/' . $dir, $file_name);

            // ファイル情報をDBに保存
            $item->file = 'storage/' . $dir . '/' . $file_name;
        }

        //DBに保存
        $item->save();
    
        //処理が終わったらmember/indexにリダイレクト
        return redirect('items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
