@extends('admin.layouts.master')

@section('title', 'Thông Tin Tài Khoản & Đổi Mật Khẩu')

@section('content')
<div class="mb-4">
    <h4 class="font-weight-bold mb-1 text-dark">
        <i class="fas fa-user-shield text-danger mr-2"></i>Tài Khoản Quản Trị & Bảo Mật
    </h4>
    <p class="text-muted small mb-0">Cập nhật thông tin định danh và đổi mật khẩu đăng nhập hệ thống Admin.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-user-edit text-primary mr-2"></i>Thông Tin Cá Nhân & Đổi Mật Khẩu
                </h6>
            </div>
            <div class="card-body p-4">
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <h6 class="text-uppercase font-weight-bold small text-muted mb-3">1. Thông tin chung</h6>
                    
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small">Họ Và Tên <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark small">Địa Chỉ Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        <small class="text-muted">Email này dùng để đăng nhập vào trang quản trị.</small>
                    </div>

                    <hr class="my-4">

                    <h6 class="text-uppercase font-weight-bold small text-muted mb-3">2. Đổi mật khẩu (Bỏ trống nếu không thay đổi)</h6>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small">Mật Khẩu Hiện Tại</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Nhập mật khẩu hiện tại nếu muốn đổi...">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark small">Mật Khẩu Mới</label>
                            <input type="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark small">Xác Nhận Mật Khẩu Mới</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới...">
                        </div>
                    </div>

                    <div class="mt-4 pt-2">
                        <button type="submit" class="btn btn-primary font-weight-bold px-4">
                            <i class="fas fa-save mr-1"></i> Lưu Thay Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <div class="mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #cd171f, #f97316); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: bold;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h5 class="font-weight-bold text-dark mb-1">{{ $user->name }}</h5>
            <p class="text-muted small mb-2">{{ $user->email }}</p>
            <div>
                <span class="badge badge-success px-3 py-1 font-weight-bold">
                    <i class="fas fa-shield-alt mr-1"></i> Quản Trị Viên (Admin)
                </span>
            </div>
            <hr class="my-3">
            <div class="small text-muted text-left">
                <div class="mb-1"><i class="fas fa-calendar-check mr-2 text-primary"></i>Tham gia: {{ $user->created_at ? $user->created_at->format('d/m/Y') : '10/2026' }}</div>
                <div><i class="fas fa-lock mr-2 text-warning"></i>Trạng thái: Hoạt động bình thường</div>
            </div>
        </div>
    </div>
</div>
@endsection
