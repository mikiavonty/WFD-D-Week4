@inject('Carbon', 'Illuminate\Support\Carbon')
@extends('base')

@section('content')
    <h1 class="mb-1 text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl">{{ $article->title }}</h1>
    <small class="text-base text-zinc-500">{{ $Carbon::parse($article->updated_at)->isoFormat('Do MMMM Y, h:mm:ss A') }}</small>
    @if($article->image_url !== null)
        <img src="{{ Storage::url($article->image_url) }}" />
    @endif
    <p class="mt-6 text-base text-zinc-600">{{ $article->content }}</p>
    <a href="{{ route('articles.index') }}">
        <button class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none mt-5" type="button">Back</button>
    </a>
@endsection