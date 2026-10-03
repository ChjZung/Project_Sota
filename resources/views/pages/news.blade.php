@extends('layouts.app')

@section('title', 'Company News - Nhi Binh Plastic')
@section('description', 'Latest news, events, and milestone updates from Nhi Binh Plastic Co., Ltd.')

@section('content')
<div class="wrap_breadCrumbs">
    <div class="breadCrumbs">
        <div class="wrap-content fixwidth">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">News</li>
            </ol>
        </div>
    </div>
</div>

<div class="wrap-main py-4">
    <div class="fixwidth">
        <div class="main-title text-center mb-4">
            <h1 class="title font-weight-bold" style="font-size: 26px; color: #cd171f; text-transform: uppercase;">
                Company News & Events
            </h1>
        </div>

        <div class="row">
            @forelse($news as $item)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 10px; overflow: hidden; transition: transform 0.2s;">
                        <a href="{{ url($item->slug) }}" class="scale-img" style="height: 200px; overflow: hidden; display: block;">
                            <img src="{{ $item->image ?: '/thumbs/300x200x1/assets/images/noimage.png' }}" 
                                 alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <div>
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-calendar-alt mr-1"></i> {{ $item->created_at ? $item->created_at->format('d/m/Y') : '' }}
                                </small>
                                <a href="{{ url($item->slug) }}" class="font-weight-bold text-dark d-block mb-2" style="font-size: 15px; line-height: 1.4;">
                                    {{ $item->title }}
                                </a>
                                @if($item->summary)
                                    <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.5;">
                                        {{ \Illuminate\Support\Str::limit($item->summary, 110) }}
                                    </p>
                                @endif
                            </div>
                            <div class="mt-3">
                                <a href="{{ url($item->slug) }}" class="btn btn-sm btn-outline-danger font-weight-bold">
                                    Read more <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Hiện chưa có bài viết tin tức nào.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($news, 'hasPages') && $news->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $news->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
@endsection
