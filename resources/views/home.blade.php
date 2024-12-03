@extends('components.layout')
@section('content')
<div class="container mt-5">
    <!-- Hero Section -->
    <div class="row align-items-center text-center text-md-start mb-5">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold text-primary">Welcome to My Lib</h1>
            <p class="lead text-secondary">
                Explore our extensive collection of books. Whether you're looking for fiction, non-fiction, or educational books, we have something for everyone.
            </p>
            <a class="btn btn-primary btn-lg shadow-sm rounded-pill px-4 py-2 mt-3" href="/buku" role="button">
                Browse Books
            </a>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('img/bg.jpg') }}" alt="Library" class="img-fluid rounded shadow-sm">
        </div>
    </div>

    <!-- Editorial Picks Section -->
    <div class="editorial-picks-section">
        <h4 class="fw-bold text-center text-primary mb-4">Editorial Picks</h4>
        <div class="row g-4">
            @foreach($editorialPicks as $book)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset('storage/img/' . $book->image) }}" class="card-img-top rounded-top" alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $book->title }}</h5>
                        <p class="card-text text-secondary mb-3">{{ Str::limit($book->description, 80) }}</p>
                        <div class="mt-auto">
                            <p class="fw-bold text-danger">Rp. {{ number_format($book->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
