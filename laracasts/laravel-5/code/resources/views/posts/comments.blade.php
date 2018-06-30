<div class="comments border-top border-secondary py-2 mb-3">
    <h3 class="mt-3"><strong>Comments</strong></h3>
    <form class="form-inline mt-4" method="POST" action="/posts/{{ $post->id }}/comments">
        @csrf
        <div class="form-group mb-2 mr-2">
            <label for="comment" class="mr-2">Add a comment: </label>
            <input  name="body" type="text" required class="form-control" id="comment" placeholder="bla bla bla...">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Add</button>
    </form>
</div>

@if (count($post->comments))
    @foreach ($post->comments as $comment)
    <div class="card mb-4">
        <div class="card-header">
            <span class="badge badge-primary">User</span> {{ $comment->user->name }} | <span class="badge badge-primary">Date</span> {{ $comment->created_at->diffForHumans() }}
        </div>
        <div class="card-body">
            <p>{{ $comment->body }}</p>
        </div>
    </div>
    @endforeach
@endif
