@extends('components.layout')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Edit Book</h2>
            </div>
            <div class="card-body">
                <!-- Form Edit Buku -->
                <form action="{{ route('update', $books->id) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Input untuk Judul -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $books->title) }}" required>
                    </div>
                    
                    <!-- Input untuk Penulis -->
                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis:</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $books->author) }}" required>
                    </div>
                    <div class="mb-3 form-check">
                        <!-- Input tersembunyi yang akan mengirimkan nilai false jika checkbox tidak dicentang -->
                        <input type="hidden" name="editorial_pick" value="0">
                        <input type="checkbox" name="editorial_pick" id="editorial_pick" class="form-check-input" value="1" {{ old('editorial_pick', $books->editorial_pick ?? 0) ? 'checked' : '' }}>
                        <label for="editorial_pick" class="form-check-label">Jadikan Editorial Pick</label>
                    </div>
                    <!-- Input untuk Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga:</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $books->harga) }}" required>
                    </div>
                    <!-- Diskon -->
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon (%)</label>
                        <input type="number" name="discount" id="discount" class="form-control" placeholder="Masukkan diskon (0-100)" value="{{ old('discount', $books->discount) }}">
                    </div>
                    <!-- Input untuk Tanggal Terbit -->
                    <div class="mb-3">
                        <label for="tanggal_terbit" class="form-label">Tanggal Terbit:</label>
                        <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" value="{{ old('tanggal_terbit', $books->tanggal_terbit) }}" required>
                    </div>
                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Buku:</label>
                        <div>
                            <img src="{{ asset('storage/img/' . $books->image) }}" class="img-fluid rounded w-25" alt="Book Image">
                        </div>
                        <label for="image" class="form-label mt-2">Ganti Gambar Buku:</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <!-- Existing gallery images -->
                    <h4>Gambar Galeri:</h4>
                    <h5>Galeri Gambar Buku dan Caption</h5>
                    <div class="row">
                        @foreach($books->galleries as $gallery)
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
                    <!-- Input for gallery images -->
                    <div id="gallery-container">
                        <div class="gallery-item mb-3">
                            <label for="gallery_images">Tambah Gambar Galeri:</label>
                            <input type="file" name="gallery_images[]" class="form-control mb-2" >
                            <label for="captions[]">Caption:</label>
                            <input type="text" name="captions[]" class="form-control" placeholder="Enter caption">
                        </div>
                    </div>
                    <button type="button" id="add-gallery" class="btn btn-secondary mb-10">Tambah Gambar Galeri</button>
                    <!-- Tombol Update -->
                    <div class="d-flex justify-content-between mt-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        
                        <!-- Tombol Back -->
                        <a href="{{ route('buku') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        </div>
        <script>
            // Tambahkan input file galeri dan caption secara dinamis
            document.getElementById('add-gallery').addEventListener('click', function() {
                const galleryContainer = document.getElementById('gallery-container');
                const newGalleryItem = document.createElement('div');
                newGalleryItem.classList.add('gallery-item', 'mb-3');
                newGalleryItem.innerHTML = `
                    <label for="gallery_images">Tambah Gambar Galeri:</label>
                    <input type="file" name="gallery_images[]" class="form-control mb-2" required>
                    <label for="captions[]">Caption:</label>
                    <input type="text" name="captions[]" class="form-control" placeholder="Enter caption" required>
                `;
                galleryContainer.appendChild(newGalleryItem);
            });
        </script>
    </div>
    @endsection
    