<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Hiển thị trang thông tin tài khoản & đổi mật khẩu
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Cập nhật thông tin tài khoản và đổi mật khẩu
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ];

        // Nếu có nhập mật khẩu mới
        if ($request->filled('password')) {
            $rules['current_password'] = 'required|string';
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
        }

        $validated = $request->validate($rules, [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại để xác nhận đổi mật khẩu.',
            'password.min'              => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed'        => 'Mật khẩu xác nhận không khớp.',
            'email.unique'              => 'Email này đã có người sử dụng.',
        ]);

        // Kiểm tra mật khẩu hiện tại nếu đổi pass
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác!'])->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Cập nhật thông tin tài khoản thành công!');
    }
}
