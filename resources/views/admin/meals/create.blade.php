@extends('admin.layouts.master')

@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">新增餐點</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.meals.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>餐點名稱</label>
                                <input type="text" name="name" class="form-control" placeholder="請輸入名稱" required>
                            </div>
                            
                            <div class="form-group">
                                <label>餐點類別</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- 請選擇類別 --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>價格</label>
                                <input type="number" name="price" class="form-control" placeholder="請輸入價格" required>
                            </div>
                            <div class="form-group">
                                <label>庫存數量</label>
                                <input type="number" name="stock" class="form-control" value="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">確認儲存</button>
                    <a href="{{ route('admin.meals.index') }}" class="btn btn-danger">取消返回</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection