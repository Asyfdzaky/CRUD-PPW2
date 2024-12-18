@extends('components.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Detail Buku</h3>
        </div>
        <div class="card-body">
            <!-- Menampilkan Info Buku -->
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/img/'.$book->image) }}" class="img-fluid rounded" alt="Book Image">
                </div>
                <div class="col-md-8">
                    <h4>{{ $book->title }}</h4>
                    <p><strong>Penulis:</strong> {{ $book->author }}</p>
                    <p><strong>Harga:</strong> Rp{{ number_format($book->harga, 2, ',', '.') }}</p>
                    <p><strong>Tanggal Terbit:</strong> {{ \Carbon\Carbon::parse($book->tanggal_terbit)->format('d F Y') }}</p>
                    @if($book->editorial_pick == 1)
                        <p><strong>Editorial Pick:</strong> Buku ini termasuk dalam editorial pick.</p>
                    @else
                        <p><strong>Editorial Pick:</strong> Buku ini tidak termasuk dalam editorial pick.</p>
                    @endif
                </div>
            </div>

            <hr>

            <!-- Menampilkan Galeri Gambar -->
            <h5>Galeri Gambar Buku dan Caption</h5>
            <div class="row">
                @foreach($book->galleries as $gallery)
                <div class="col-md-3"> <!-- Setiap item akan mengambil lebar 3 kolom -->
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('storage/galleries/'.$gallery->image) }}" class="card-img-top img-fluid rounded" alt="Gallery Image">
                        <div class="card-body">
                            <p class="card-text text-center">{{ $gallery->caption }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('buku') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
