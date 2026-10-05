<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    /**
     * Hiển thị danh sách các yêu cầu báo giá / liên hệ
     */
    public function index(Request $request): View
    {
        $query = Inquiry::query()->latest();

        // Lọc theo trạng thái
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Tìm kiếm theo từ khóa
        if ($request->filled('search')) {
            $search = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('phone', 'like', $search)
                  ->orWhere('company', 'like', $search)
                  ->orWhere('message', 'like', $search);
            });
        }

        $inquiries = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'all'        => Inquiry::count(),
            'pending'    => Inquiry::where('status', 'pending')->count(),
            'processing' => Inquiry::where('status', 'processing')->count(),
            'closed'     => Inquiry::where('status', 'closed')->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'statusCounts'));
    }

    /**
     * Xem chi tiết yêu cầu báo giá
     */
    public function show(Inquiry $inquiry, Request $request): View|JsonResponse
    {
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $inquiry
            ]);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Cập nhật trạng thái và ghi chú nội bộ của yêu cầu
     */
    public function update(Request $request, Inquiry $inquiry): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'status'      => 'required|in:pending,processing,closed',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $inquiry->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Cập nhật trạng thái yêu cầu báo giá thành công!',
                'data'    => $inquiry
            ]);
        }

        return redirect()->route('admin.inquiries.index')
            ->with('success', "Cập nhật yêu cầu của khách hàng \"{$inquiry->name}\" thành công!");
    }

    /**
     * Cập nhật nhanh trạng thái qua AJAX
     */
    public function updateStatus(Request $request, Inquiry $inquiry): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,closed',
        ]);

        $inquiry->update(['status' => $validated['status']]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Đổi trạng thái thành công!',
            'new_status' => $inquiry->status,
        ]);
    }

    /**
     * Xóa yêu cầu báo giá
     */
    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $customerName = $inquiry->name;
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', "Đã xóa yêu cầu báo giá của \"{$customerName}\" thành công!");
    }
}
