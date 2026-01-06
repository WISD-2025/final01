@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">訂單管理</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>顧客</th>
                        <th>總金額</th>
                        <th>狀態</th>
                        <th>下單時間</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ $order->total_price }}</td>
                        <td>
                            @if($order->status == 'pending') <span class="badge badge-warning">處理中</span>
                            @elseif($order->status == 'completed') <span class="badge badge-success">已完成</span>
                            @else <span class="badge badge-danger">已取消</span> @endif
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href = "{{ route('admin.orders.edit', $order->id) }}">編輯 / </a>
                            <a href = "#">刪除 / </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.show', $order->id) }}">查看明細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection