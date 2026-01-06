@extends('admin.layouts.master')

@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">餐點管理</h3>
    <div class="ms-md-auto py-2 py-md-0">
        <a href="{{ route('admin.meals.create') }}" class="btn btn-primary btn-round">新增餐點</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>餐點編號</th>
                                <th>名稱</th> 
                                <th>圖片</th> 
                                <th>價格</th>
                                <th>類別</th>
                                <th>庫存</th>
                                <th style="width: 10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meals as $meal)
                            <tr>
                                <td>{{ $meal->id }}</td>
                                <td>{{ $meal->name }}</td>
                                <td>
                                    @if($meal->image1)
                                        <img src="{{ asset('storage/' . $meal->image1) }}" 
                                             alt="{{ $meal->name }}" 
                                             style="width: 60px; height: 45px; object-fit: cover;" 
                                             class="rounded border">
                                    @else
                                        <span class="text-muted" style="font-size: 12px;">無圖</span>
                                    @endif
                                </td>

                                <td>${{ $meal->price }}</td>
                                <td>{{ $meal->category->name }}</td>
                                <td>{{ $meal->stock }}</td>
                                <td>
                                    <a href = "{{ route('admin.meals.edit', $meal->id) }}">編輯 /</a>
                                    <a href = "#">刪除</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection