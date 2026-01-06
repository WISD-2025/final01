@extends('admin.layouts.master')

@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">編輯餐點</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.meals.update', $meal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>餐點名稱</label>
                                <input type="text" name="name" class="form-control" value="{{ $meal->name }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label>餐點類別</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $meal->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>目前的圖片</label><br>
                                @if($meal->image1)
                                    <img src="{{ asset('storage/' . $meal->image1) }}" 
                                         style="width: 200px; margin-bottom: 10px;" 
                                         class="img-thumbnail border">
                                @else
                                    <p class="text-muted">目前無圖片</p>
                                @endif
                                
                                <label class="d-block mt-2">更換圖片 (image1)</label>
                                <input type="file" name="image1" class="form-control">
                                <small class="text-muted">若不更換請留空</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>價格</label>
                                <input type="number" name="price" class="form-control" value="{{ $meal->price }}" required>
                            </div>
                            <div class="form-group">
                                <label>庫存數量</label>
                                <input type="number" name="stock" class="form-control" value="{{ $meal->stock }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">確認更新</button>
                    <a href="{{ route('admin.meals.index') }}" class="btn btn-danger">取消返回</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection