@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <form action="{{ route('item.index') }}" method="GET">
                      <input type="text" name="keyword" value="{{$keyword ?? ''}}">
                      <input type="submit" value="検索">
                    </form>
                  </div>
            </div>種別検索する場合は数字で検索をお願いします、1:本、2:食品、3:ファッション、4:生活家電、5:パソコン周辺機器、6:スポーツ・アウトドア、7:ドラッグストア、8:ホーム＆キッチン</div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>画像</th>
                                <th>編集・削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ config('const.type.'.$item->type) }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td><img src="{{ asset($item->file) }}" width=50 height=50></td>
                                    <td>
                                        <div>
                                            <a href="items/item_update/{{$item->id}}"><button type="button"
                                                    class="btn btn-link">編集</button></a>
                                        </div>
                                        <div>
                                            <a href="items/ListDelete/{{$item->id}}"><button type="button"
                                                    class="btn btn-link">削除</button></a>
                                        </div>
                                    </td>
                                
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
