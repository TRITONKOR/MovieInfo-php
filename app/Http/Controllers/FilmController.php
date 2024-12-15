<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\FilmSearchResults;
use Illuminate\Support\Facades\Mail;

class FilmController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function searchFilm(string $title)
    {
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            't' => $title
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:1'
        ]);

        $film = $this->searchFilm($validated['title']);

        if ($film) {
            return view('search', compact('film'));
        }

        return back()->withErrors(['error' => 'Фільм не знайдений']);
    }

    public function sendFilmSearchResults(Request $request)
    {
        $validated = $request->validate([
            'film' => 'required|string|min:1',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'nullable|string'
        ]);

        $film = $this->searchFilm($validated['film']);
        if (!$film) {
            return back()->withErrors(['error' => 'Фільм не знайдений']);
        }

        $recipient = $validated['email'];
        $subject = $validated['subject'];
        $message = isset($validated['message']) ? $validated['message'] : '';

        // Замінюємо виклик Mailable на безпосереднє створення HTML-тіла листа
        Mail::to($recipient)->send(new FilmSearchResults($film, $subject, $message));

        return redirect()->route('home')->with('success', 'Результати пошуку надіслано!');
    }
}
