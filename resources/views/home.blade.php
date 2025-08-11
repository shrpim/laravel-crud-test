<!DOCTYPE html>
<html>
<head>
    <title>Blog MVP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
<h1>Мини-блог</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('posts.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="mb-2">
        <label for="user_id">ID пользователя</label>
        <input type="number" name="user_id" id="user_id" class="form-control" required>
    </div>
    <div class="mb-2">
        <label for="body">Текст поста</label>
        <textarea name="body" id="body" class="form-control" required></textarea>
    </div>
    <button class="btn btn-primary">Создать пост</button>
</form>

<hr>

<h2>Посты</h2>
@forelse($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $post->user->name ?? 'Без имени' }}</h5>
            <p>{{ $post->body }}</p>
            <small>Комментарии: {{ $post->comments->count() }}</small>
            <ul>
                @foreach($post->comments as $comment)
                    <li>{{ $comment->body }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@empty
    <p>Постов нет</p>
@endforelse
</body>
</html>
