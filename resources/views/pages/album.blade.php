@extends('layouts.app')

@section('title', 'Photo Album - Nhi Binh Plastic Factory & Facilities')
@section('description', 'Explore factory facilities, automated injection machines, and packing rooms at Nhi Binh Plastic.')

@section('content')
<div class="wrap_breadCrumbs">
    <div class="breadCrumbs">
        <div class="wrap-content fixwidth">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Photo Album</li>
            </ol>
        </div>
    </div>
</div>

<div class="wrap-main py-4">
    <div class="fixwidth">
        <div class="main-title text-center mb-4">
            <h1 class="title font-weight-bold" style="font-size: 26px; color: #cd171f; text-transform: uppercase;">
                Photo Album - Factory & Facilities
            </h1>
        </div>

        <div class="row">
            @forelse($albums as $alb)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                        <a href="{{ url($alb->slug) }}" class="scale-img" style="height: 220px; overflow: hidden; display: block;">
                            <img src="{{ $alb->image ?: '/thumbs/400x300x1/assets/images/noimage.png' }}" 
                                 alt="{{ $alb->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                        <div class="card-body p-3">
                            <a href="{{ url($alb->slug) }}" class="font-weight-bold text-dark d-block mb-1" style="font-size: 14.5px; line-height: 1.4;">
                                {{ $alb->title }}
                            </a>
                            @if($alb->summary)
                                <p class="text-muted mb-0" style="font-size: 13px;">
                                    {{ \Illuminate\Support\Str::limit($alb->summary, 90) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Hiện chưa có album ảnh nào.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($albums, 'hasPages') && $albums->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $albums->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
@endsection
