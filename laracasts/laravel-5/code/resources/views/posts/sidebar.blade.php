<h2>Archives</h2>
<ul class="list-unstyled">
    <li><a href="?">All</a></li>
    @foreach ($archive as $stats)
    <li><a href="?month={{ $stats['month'] }}&year={{ $stats['year'] }}">{{ $stats['month'] }} {{ $stats['year'] }} ({{ $stats['published'] }})</a></li>
    @endforeach
</ul>
