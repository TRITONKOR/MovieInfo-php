<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for a Film</title>
    <link rel="stylesheet" href="{{ asset('css/stili.css') }}">
</head>
<body>
<div class="container">
    <h1>Search for a Film</h1>

    <!-- Форма для пошуку фільму -->
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Enter Film Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <button type="submit">Search</button>
    </form>

    @if(session('error'))
        <div class="error-message">
            <p>{{ session('error') }}</p>
        </div>
    @endif
</div>
</body>
</html>
