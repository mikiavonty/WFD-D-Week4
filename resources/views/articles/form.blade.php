@extends('base')

@section('content')
    <h1 class="mb-1 text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl">{{ Str::title($mode) }} Article</h1>
    <form action="{{ $mode == 'ADD' ? route('articles.store') : route('articles.update', ['article' => $article->id]) }}" method="POST">
        @csrf
        @if ($mode !== 'ADD')
            @method('PUT')
        @endif

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                <div class="mt-2">
                    <div
                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" name="title" id="title"
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                            placeholder="Title" value="{{ ($mode !== "ADD") ? $article->title : ""}}">
                    </div>
                </div>
            </div>

            <div class="col-span-full">
                <label for="content" class="block text-sm/6 font-medium text-gray-900">Content</label>
                <div class="mt-2">
                    <textarea name="content" id="content" rows="3"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        placeholder="Article content...">{{ ($mode !== "ADD") ? $article->content : ""}}</textarea>
                </div>
            </div>
            <button
                class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none"
                type="submit">Save</button>
            <a href="{{ route('articles.index') }}">
                <button
                    class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none"
                    type="button">Cancel</button>
            </a>
        </div>
    </form>
@endsection
