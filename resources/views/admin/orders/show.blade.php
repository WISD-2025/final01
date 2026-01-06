@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">訂單明細 #{{ $order->id }}</h4>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">餐點內容</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>餐點圖片</th>
                                <th>餐點名稱</th>
                                <th>單價</th>
                                <th>數量</th>
                                <th class="text-right">小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    @if($item->meal->image1)
                                        <img src="{{ asset('storage/' . $item->meal->image1) }}" width="50">
                                    @else
                                        <img src="{{ asset('img/no-image.png') }}" width="50">
                                    @endif
                                </td>
                                <td>{{ $item->meal->name ?? '餐點已刪除' }}</td>
                                <td>${{ number_format($item->meal->price ?? 0) }}</td>
                                <td>x {{ $item->quantity }}</td>
                                <td class="text-right">
                                    ${{ number_format(($item->meal->price ?? 0) * $item->quantity) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">總計金額：</th>
                                <th class="text-right text-primary">
                                    <h3>${{ number_format($order->total_price) }}</h3>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">訂單資訊</h4>
                </div>
                <div class="card-body">
                    <p><strong>顧客姓名：</strong> {{ $order->user->name ?? '未知' }}</p>
                    <p><strong>目前狀態：</strong> 
                        @if($order->status == 'pending') <span class="badge badge-warning">待處理</span>
                        @elseif($order->status == 'preparing') <span class="badge badge-primary">準備中</span>
                        @elseif($order->status == 'completed') <span class="badge badge-success">已完成</span>
                        @endif
                    </p>
                    <p><strong>下單時間：</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-block">返回列表</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection