<h2>Archives</h2>
<ul class="list-unstyled">
    <li><a href="?">All</a></li>
    @foreach ($archives as $stats)
    <li><a href="?month={{ $stats['month'] }}&year={{ $stats['year'] }}">{{ $stats['month'] }} {{ $stats['year'] }} ({{ $stats['published'] }})</a></li>
    @endforeach
</ul>

<h2>Tags</h2>
<ul class="list-unstyled">
    @foreach ($tags as $tag)
    <li><a href="/posts/tags/{{ $tag }}">{{ $tag }}</a></li>
    @endforeach
</ul>
