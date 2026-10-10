@extends('layouts.app')
@section('title', $page->meta_title ?: $page->title)
@section('description', $page->meta_description)
@section('content')
    <div class="page legal-page">
        <h1 class="legal-page__title">{{ $page->title }}</h1>
        <div class="legal-page__body">{!! $page->content !!}</div>
    </div>
@endsection
