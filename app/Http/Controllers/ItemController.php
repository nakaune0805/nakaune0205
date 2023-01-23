<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Item::query();

        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('type', 'LIKE', "%{$keyword}%")
                  ->orWhere('detail', 'LIKE', "%{$keyword}%");
        }

        $items = $query->get();

        return view('item.index', compact('items', 'keyword'));

        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();
            

        return view('item.index', compact('items'));

    }


    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            $items = Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
                'file' => $request->file,
                
            ]);
            

            return redirect('/items');
        }

        return view('item.add');
    }
       
    public function store(Request $request)
        {
    
             //１. バリデーション機能
             $this->validate($request, [
                'name' => ['required'],
                'type' => ['required'],
                'detail' => ['required'],
                'image' => ['required'],
            ]);  
           
            $item = new Item();
            $item->user_id=Auth::id();
            $item->name = $request->name;
            $item->type = $request->input('type');
            $item->detail = $request->detail;
            
             // ディレクトリ名
        $dir = 'sample';

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        // ファイル情報をDBに保存
        $item->file = 'storage/' . $dir . '/' . $file_name;

        
    $item->save();
    return redirect('items');


    }
}


