@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->summary ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160))

@section('content')
<div class="wrap_breadCrumbs">
    <div class="breadCrumbs">
        <div class="wrap-content fixwidth">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">
                    @if($post->type === 'news')
                        <a href="{{ route('news') }}">News</a>
                    @elseif($post->type === 'album')
                        <a href="{{ route('album') }}">Album</a>
                    @else
                        <span>Video</span>
                    @endif
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="wrap-main py-4">
    <div class="fixwidth">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h1 class="font-weight-bold mb-3" style="font-size: 24px; color: #0f172a; line-height: 1.4;">
                        {{ $post->title }}
                    </h1>
                    <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom" style="font-size: 13px;">
                        <span class="mr-3"><i class="fas fa-calendar-alt mr-1"></i> {{ $post->created_at ? $post->created_at->format('d/m/Y') : '' }}</span>
                        <span class="badge badge-light border"><i class="fas fa-tag mr-1"></i> {{ ucfirst($post->type) }}</span>
                    </div>

                    @if($post->type === 'video' && $post->video_url)
                        <div class="mb-4">
                            @php
                                preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $post->video_url, $matches);
                                $ytId = $matches[1] ?? null;
                            @endphp
                            @if($ytId)
                                <div class="embed-responsive embed-responsive-16by9 rounded shadow-sm">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $ytId }}" allowfullscreen></iframe>
                                </div>
                            @endif
                        </div>
                    @elseif($post->image)
                        <div class="mb-4 text-center">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid rounded shadow-sm" style="max-height: 450px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    @if($post->summary)
                        <div class="alert alert-light border font-italic mb-4" style="font-size: 15px; color: #475569; background: #f8fafc;">
                            {{ $post->summary }}
                        </div>
                    @endif

                    <div class="post-content" style="font-size: 15.5px; line-height: 1.8; color: #334155;">
                        {!! $post->content ?: '<p>Thông tin chi tiết đang được cập nhật.</p>' !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded shadow-sm mb-4">
                    <h5 class="font-weight-bold mb-3 pb-2 border-bottom" style="color: #cd171f;">
                        <i class="fas fa-newspaper mr-2"></i> Bài Viết Khác
                    </h5>
                    @if(isset($relatedPosts) && $relatedPosts->count())
                        <div class="list-unstyled">
                            @foreach($relatedPosts as $rPost)
                                <div class="d-flex mb-3 pb-2 border-bottom">
                                    @if($rPost->image)
                                        <a href="{{ url($rPost->slug) }}" class="mr-2 flex-shrink-0">
                                            <img src="{{ $rPost->image }}" alt="{{ $rPost->title }}" style="width: 70px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        </a>
                                    @endif
                                    <div>
                                        <a href="{{ url($rPost->slug) }}" class="font-weight-bold text-dark d-block" style="font-size: 13.5px; line-height: 1.3;">
                                            {{ \Illuminate\Support\Str::limit($rPost->title, 55) }}
                                        </a>
                                        <small class="text-muted" style="font-size: 11px;">
                                            {{ $rPost->created_at ? $rPost->created_at->format('d/m/Y') : '' }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0" style="font-size: 13px;">Chưa có bài viết liên quan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
