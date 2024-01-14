@extends('layouts.app')

@section('content')
　　@if (Auth::check())
　　
　　@include('tasks.index')
    
    @else
    　　<div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        　　<div class="hero-content text-center my-10">
            　　<div class="max-w-md mb-10">
                　　<h2>登録してタスク管理を利用する</h2>
                {{-- ユーザ登録ページへのリンク --}}
                　　<a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">ユーザー登録</a>
            　　</div>
        　　</div>
    　　</div>
    @endif
@endsection