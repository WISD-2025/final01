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
                        <td>{{ $order->user->name ?? '未知用戶' }}</td>
                        <td>${{ number_format($order->total_price) }}</td>
                        <td>
                            
                            @if($order->status == 'pending')
                                <span class="badge badge-warning">待處理</span>
                            @elseif($order->status == 'preparing')
                                <span class="badge badge-primary">準備中</span>
                            @elseif($order->status == 'completed')
                                <span class="badge badge-success">已完成</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge badge-danger">已取消</span>
                            @else
                                <span class="badge badge-secondary">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <div class="form-button-action">
                                <a class="btn btn-sm btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                    <i class="fa fa-edit"></i> 編輯
                                </a>

                                <a class="btn btn-sm btn-primary mx-2" href="{{ route('admin.orders.show', $order->id) }}">
                                    <i class="fa fa-eye"></i> 查看明細
                                </a>

                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('確定要刪除這筆訂單嗎？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> 刪除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection