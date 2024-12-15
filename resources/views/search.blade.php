<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film['Title'] }}</title>
    <link rel="stylesheet" href="{{ asset('css/stili.css') }}">
</head>
<body>
<div class="container">
    <h1>{{ $film['Title'] }}</h1>

    <div class="film-details">
        <p><strong>Year:</strong> {{ $film['Year'] }}</p>
        <p><strong>Genre:</strong> {{ $film['Genre'] }}</p>
        <p><strong>Director:</strong> {{ $film['Director'] }}</p>
        <p><strong>Plot:</strong> {{ $film['Plot'] }}</p>
        <p><strong>Actors:</strong> {{ $film['Actors'] }}</p>
        <p><strong>IMDB Rating:</strong> {{ $film['imdbRating'] }}</p>
    </div>

    <!-- Виведення постера фільму -->
    <div class="film-poster">
        <img src="{{ $film['Poster'] }}" alt="{{ $film['Title'] }}" width="300">
    </div>

    <form action="{{ route('sendFilmSearchResults') }}" method="POST">
        @csrf
        <input type="hidden" name="film" value="{{ $film['Title'] }}">
        <div>
            <label for="email">Recipient Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="subject">Email Subject</label>
            <input type="text" name="subject" required>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message" required></textarea>
        </div>
        <button type="submit">Send Results</button>
    </form>
    <a href="{{ route('home') }}">Back to Search</a>
</div>
</body>
</html>
