@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">人員管理</h4>
        <div class="btn-group ms-md-auto">
             </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">所有使用者清單</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>使用者編號</th>
                                    <th>姓名</th>
                                    <th>Email</th>
                                    <th>身分別</th>
                                    <th>加入時間</th>
                                    <th style="width: 15%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'admin')
                                            <span class="badge badge-primary">管理員</span>
                                        @else
                                            <span class="badge badge-info">一般會員</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit', $user->id) }}">編輯</a>
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
</div>
@endsection