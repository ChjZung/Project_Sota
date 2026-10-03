<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Danh sách bài viết (Tin tức, Album ảnh, Video YouTube)
     */
    public function index(Request $request): View
    {
        $query = Post::latest();

        // 1. Lọc theo loại (type: news | album | video)
        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        // 2. Lọc theo từ khóa tìm kiếm
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        // 3. Lọc theo trạng thái xuất bản
        if ($request->filled('published')) {
            $query->where('is_published', $request->boolean('published'));
        }

        $posts = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Post::count(),
            'news'  => Post::where('type', 'news')->count(),
            'album' => Post::where('type', 'album')->count(),
            'video' => Post::where('type', 'video')->count(),
        ];

        return view('admin.posts.index', compact('posts', 'stats'));
    }

    /**
     * Form thêm bài viết / album / video mới
     */
    public function create(Request $request): View
    {
        $post = new Post([
            'type'         => $request->input('type', 'news'),
            'is_published' => true,
        ]);

        return view('admin.posts.form', compact('post'));
    }

    /**
     * Lưu bài viết mới vào CSDL
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', 'unique:posts,slug'],
            'type'         => ['required', 'string', 'in:news,album,video'],
            'summary'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'video_url'    => ['nullable', 'string', 'max:255'],
            'image_file'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'    => ['nullable', 'string'],
            'is_published' => ['boolean'],
        ]);

        $slug = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name'] ?? $validated['title']);

        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Xử lý ảnh đại diện
        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'post_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/posts'), $filename);
            $imagePath = '/upload/posts/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        Post::create([
            'user_id'      => auth()->id(),
            'title'        => $validated['title'],
            'slug'         => $slug,
            'type'         => $validated['type'],
            'summary'      => $validated['summary'] ?? null,
            'content'      => $validated['content'] ?? null,
            'video_url'    => $validated['video_url'] ?? null,
            'image'        => $imagePath,
            'is_published' => $request->boolean('is_published', true),
        ]);

        $typeNames = ['news' => 'Tin tức', 'album' => 'Album ảnh', 'video' => 'Video YouTube'];
        $typeName = $typeNames[$validated['type']] ?? 'Bài viết';

        return redirect()->route('admin.posts.index', ['type' => $validated['type']])
            ->with('success', "Đã tạo {$typeName} mới thành công!");
    }

    /**
     * Form chỉnh sửa bài viết
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.form', compact('post'));
    }

    /**
     * Cập nhật bài viết
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', 'unique:posts,slug,' . $post->id],
            'type'         => ['required', 'string', 'in:news,album,video'],
            'summary'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'video_url'    => ['nullable', 'string', 'max:255'],
            'image_file'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'    => ['nullable', 'string'],
            'is_published' => ['boolean'],
        ]);

        $slug = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['title']);

        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $imagePath = $post->image;
        if ($request->hasFile('image_file')) {
            if ($post->image && file_exists(public_path($post->image)) && !str_contains($post->image, 'thumbs') && !str_contains($post->image, 'noimage')) {
                @unlink(public_path($post->image));
            }
            $file = $request->file('image_file');
            $filename = 'post_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/posts'), $filename);
            $imagePath = '/upload/posts/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $post->update([
            'title'        => $validated['title'],
            'slug'         => $slug,
            'type'         => $validated['type'],
            'summary'      => $validated['summary'] ?? null,
            'content'      => $validated['content'] ?? null,
            'video_url'    => $validated['video_url'] ?? null,
            'image'        => $imagePath,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.posts.index', ['type' => $post->type])
            ->with('success', 'Đã cập nhật bài viết thành công!');
    }

    /**
     * Xóa bài viết
     */
    public function destroy(Post $post): RedirectResponse
    {
        $type = $post->type;

        if ($post->image && file_exists(public_path($post->image)) && !str_contains($post->image, 'thumbs') && !str_contains($post->image, 'noimage')) {
            @unlink(public_path($post->image));
        }

        $post->delete();

        return redirect()->route('admin.posts.index', ['type' => $type])
            ->with('success', 'Đã xóa bài viết thành công!');
    }

    /**
     * Bật/tắt trạng thái xuất bản
     */
    public function togglePublish(Post $post): RedirectResponse
    {
        $post->update(['is_published' => !$post->is_published]);

        $status = $post->is_published ? 'Đã xuất bản' : 'Đã ẩn';
        return back()->with('success', "{$status}: {$post->title}");
    }
}
