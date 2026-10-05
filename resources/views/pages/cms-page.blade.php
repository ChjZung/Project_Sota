@extends('layouts.app')

@section('title', ($cmsPage->meta['title'] ?? null) ?: $cmsPage->title)
@section('description', ($cmsPage->meta['description'] ?? null) ?: \Illuminate\Support\Str::limit(strip_tags($cmsPage->content), 160))

@section('content')
<div class="wrap_breadCrumbs">
    <div class="breadCrumbs">
        <div class="wrap-content fixwidth">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $cmsPage->title }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="wrap-main py-4">
    <div class="fixwidth">
        <div class="main-title text-center mb-4">
            <h1 class="title font-weight-bold" style="font-size: 26px; color: #cd171f; text-transform: uppercase;">
                {{ $cmsPage->title }}
            </h1>
        </div>

        @if($cmsPage->banner_image)
            <div class="page-banner mb-4 text-center">
                <img src="{{ $cmsPage->banner_image }}" alt="{{ $cmsPage->title }}" class="img-fluid rounded shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover;" onerror="this.style.display='none'">
            </div>
        @endif

        <div class="page-content bg-white p-4 rounded shadow-sm" style="font-size: 15.5px; line-height: 1.8; color: #334155;">
            {!! $cmsPage->content !!}
        </div>
    </div>
</div>
@endsection
