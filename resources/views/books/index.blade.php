@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl font-bold">Livres</h1>
    <form method ="GEt" action ="{{ route('books.index') }}" class="mb-4 flex space-x-2 items-center">
        <input class ='input h-10'type="text" name="title" placeholder="Rechercher par titre" value={{ request('title') }}>
        <input type ="hidden" name="filter" value="{{ request('filter') }}">

        <button type="submit" class="btn">Rechercher</button>

        <a href="{{ route('books.index') }}" class="btn">Effacer</a>
    </form>

    <div class ="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6months' => 'Top Rated',
                'highest_rated_last_month' => 'Highest rated last month',
                'highest_rated_last_6months' => 'Highest rated last 6 months',
            ];
        @endphp

        @foreach ($filters as $key => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
                class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">{{ $label }}</a>
        @endforeach

    </div>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="#" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">{{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                <x-star-rating :rating="$book->reviews_avg_rating"/>
                            </div>
                            <div class="book-review-count">
                                {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="text-gray-500">Aucun livre trouvé.</li>
        @endforelse
    </ul>
@endsection
