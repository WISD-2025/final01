@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">編輯人員</h4>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Resource 的 update 必須用 PUT 或 PATCH --}}
                    
                    <div class="card-header">
                        <div class="card-title">修改使用者：{{ $user->name }}</div>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (不可修改)</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="role">帳號身分</label>
                            <select name="role" class="form-control" id="role">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>一般會員</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>管理員</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-action">
                        <button type="submit" class="btn btn-success">儲存修改</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger">取消</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection