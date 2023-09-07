@extends('layouts.app')

@section('content')
<div class='max-w-6xl mx-auto'>
    <div class='text-right m-2 p-2'>
    </div>
    <div>
  <form action="{{ route('products.index') }}" method="GET">

  @csrf
    <div class="form-group">
    <select name="company_name" id="company_name">
            <option value="">--選択してください--</option>
            @foreach($companies as $company)
              <option value="{{ $company->company_name }}"{{ request('company_name') == $company->company_name?'selected':'' }}>{{ $company->company_name }}
              </option>
            @endforeach
          </select>
    </div>
    <div class="form-group">
        <input type="text" name="keyword" class="form-control" value="{{$keyword}}" placeholder="商品名">
    </div>
    <div class="form-group">
        <input type="submit" value="検索" class="btn btn-info" >
    </div>
   </form>
</div>

    <a href="{{ route('products.create') }}">登録</a>

    <div class="m-2 p-2">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-gray-500 text-left">Id</th>
                    <th class="p-4 text-gray-500 text-left">商品画像</th>
                    <th class="p-4 text-gray-500 text-left">会社名</th>
                    <th class="p-4 text-gray-500 text-left">商品名</th>
                    <th class="p-4 text-gray-500 text-left">価格</th>
                    <th class="p-4 text-gray-500 text-left">在庫</th>
                    <th class="p-4 text-gray-500 text-right">詳細</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($product as $product)
                <tr>
                    <td class="p-4 whitespace-nowrap">{{ $product->id }}</td>
                    <td class="p-4 whitespace-nowrap">
                        <img class="w-12 h-9 rounded" src="{{ Storage::url($product->image) }}" />
                    </td>
                    <td class="p-4 whitespace-nowrap">{{ $product->company->company_name }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $product->product_name }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $product->price }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $product->stock }}</td>
                    <td class="p-4 whitespace-nowrap">{!! nl2br($product->comment) !!}</td>
                    <td class="p-4 text-right text-sm">
                    <td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                            <a href="{{ route('products.show',$product->id) }}">閲覧</a>
                            <a href="{{ route('products.edit',$product->id) }}">編集</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">削除</button>
                        </form>
                    </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@endsection