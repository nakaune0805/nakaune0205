@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品編集</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
        <!-- {{-- エラーメッセージ --}} -->
        @foreach ($errors->all() as $error)
          <p>{{$error}}</p>
        @endforeach
        
        <form method="POST" action="{{route('item.item_update',['id' =>$item->id])}}"enctype="multipart/form-data">
        @csrf
       
        <div class="card-body">
        <a>名前</a>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name=name value="{{$item->name}}">
        </div>

        <div class="card-body">
        <a>種別</a>
        <select id="select-pref" class="form-control" name="type">
          <option value="">- 選択 -</option>
          @foreach (config('const.type') as $key => $value)
          @if($key === $item->type)
          <option value="{{ $key }}" selected>{{ $value }}</option>
          @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
      </div>

        <div class="card-body">
        <a>詳細</a>
        <input type="text" class="form-control @error('text') is-invalid @enderror" name=detail value="{{$item->detail}}">
        </div>
       
        <div class="btn">
        <button type="submit" class="btn btn-primary">編集</button>
        </div>
        </form>
      </div>
    </div>
  </body>
</html>
</tbody>
</table>

@stop

@section('css')
@stop

@section('js')
@stop
