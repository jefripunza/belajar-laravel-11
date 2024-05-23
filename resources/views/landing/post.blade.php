<x-layout.landing>
    <x-slot:title>{{ $post['title'] ?? 'No Title' }}</x-slot:title>
    @if ($post)
        <p>{{ $post['body'] }}</p>
        <a href="/posts" class="font-medium text-blue-500 hover:underline">
            &laquo; Back to posts
        </a>
    @else
        <div>Artikel tidak tersedia.</div>
    @endif
</x-layout.landing>
