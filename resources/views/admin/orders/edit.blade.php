@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">編輯訂單狀態</h4>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">訂單編號：#{{ $order->id }}</h4>
                </div>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">變更訂單狀態</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>待處理 (Pending)</option>
                                <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>準備中 (Preparing)</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>已完成 (Completed)</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <h5>訂單資訊摘要：</h5>
                            <ul class="list-group list-group-bordered">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    顧客姓名 <span>{{ $order->user->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    總金額 <span class="text-primary fw-bold">${{ number_format($order->total_price) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    下單時間 <span>{{ $order->created_at->format('Y-m-d H:i') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">儲存變更</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">返回列表</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection