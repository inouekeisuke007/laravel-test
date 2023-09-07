@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品情報編集</h1>
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <p>
        <label for="product-id">商品情報ID:{{ $product->id }}</label>
      </p>

      <p>
        <label for="image_path">商品画像</label>
        <input type="file" name="image_path" id="image_path" accept="image/*">
        @if ($product->image_path)
          <div>
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" style="max-width: 200px;">
          </div>
        @endif
      </p>

      <p>
        <label for="company_id">メーカー</label>
        <select name="company_id" id="company_id" name="company_id" value="{{ $product->company->company_name }}" >
            @foreach($companies as $company)
              <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
            @endforeach
        </select>
      </p>

      <p>
        <label for="product_name">商品名</label>
        <input type="text" name="product_name" id="name" value="{{ $product->product_name}}">
      </p>

      <p>
        <label for="price">価格</label>
        <input type="text" name="price" id="price" value="{{ $product->price }}">
      </p>

      <p>
        <label for="stock">在庫数</label>
        <input type="text" name="stock" id="stock" value="{{ $product->stock }}">
      </p>

      <p>
        <label for="comment">コメント</label>
        <input type="text" name="comment" id="comment" value="{{ $product->comment }}">
      </p>

      @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <button type="submit">更新</button>
      <a href="{{ route('products.show', $product->id) }}" class="btn btn-light">戻る</a>

    </form>
  </div>
@endsection