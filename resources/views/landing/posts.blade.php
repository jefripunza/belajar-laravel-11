@php
    use Carbon\Carbon;
@endphp

<x-layout.landing>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div>
        @if ($posts)
            @foreach ($posts as $post)
                <article class="py-8 max-w-screen-md border-b border-gray-300">
                    <a href="/post/{{ $post['post_slug'] }}" class="hover:underline">
                        <h2 class="mb-1 tex-3xl tracking-tight font-bold text-gray-900">{{ $post['title'] }}</h2>
                    </a>
                    <div class="text-base text-gray-500">
                        <a
                            href="/articles/{{ // $post->author->username
                                $post['author_slug'] }}">{{ // $post->author->first_name . ' ' . $post->author->last_name
                                $post['author'] }}</a>
                        |
                        {{ Carbon::parse($post['created_at'])->format('Y/F/d H:m') }}
                    </div>
                    <p class="my-4 font-light">{{ Str::limit($post['body'], 50) }}</p>
                    <a href="/post/{{ $post['post_slug'] }}" class="font-medium text-blue-500 hover:underline">Read more
                        &raquo;</a>
                </article>
            @endforeach
        @else
            <div>Tidak ada artikel yang tersedia.</div>
        @endif
    </div>
</x-layout.landing>
