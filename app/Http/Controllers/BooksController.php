<?php

namespace App\Http\Controllers;
use App\Models\Books;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function home()
    {
        $editorialPicks = Books::where('editorial_pick', true)->take(5)->get();
        return view('home', compact('editorialPicks'));
    }

    public function index(){
        $books = Books::all();
        $totalBooks = Books::count();
        $editorialPicks = Books::where('editorial_pick', true)->take(3)->get();
        $totalHarga = Books::sum('harga');
        return view('index', compact('books',  'totalBooks', 'totalHarga', 'editorialPicks'));
    }

    public function create(){
        return view('create');
    }
    public function show($id)
{
    // Ambil buku berdasarkan id
    $book = Books::with('galleries')->findOrFail($id);

    return view('detailBuku', compact('book'));
}

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'author' => 'required|string|max:30',
        'harga' => 'required|numeric',
        'discount' => 'nullable|numeric|min:0|max:100',
        'tanggal_terbit' => 'required|date',
        'image' => 'required|file|mimes:jpeg,jpg,png,gif|max:10000',
        'gallery_images.*' => 'required|file|mimes:jpeg,jpg,png,gif|max:10000', // Validation for multiple images
        'caption.*' => 'required|string',
        'editorial_pick' => 'boolean',

    ]);

    // Store the image
    $imagePath = $request->file('image')->store('public/img');
    
    // Create the book record
    $book = Books::create([
        'title' => $request->title,
        'author' => $request->author,
        'harga' => $request->harga,
        'tanggal_terbit' => $request->tanggal_terbit,
        'image' => basename($imagePath),
        'editorial_pick' => $request->editorial_pick,
        'discount' => $request->discount ?? 0,
    ]);

    // Store gallery images if any
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $index => $image) {
            $galleryPath = $image->store('public/galleries');
            $book->galleries()->create([
                'image' => basename($galleryPath),
                'caption' => $request->captions[$index], // Masalah pada $index
            ]);
        }
    }

    return redirect('/buku')->with('status', 'Data Buku Berhasil Ditambahkan');
}
    
    
public function destroy($id)
{
    $book = Books::find($id);
    
    // Delete the book's image if it exists
    if ($book->image) {
        Storage::delete('public/img/' . $book->image);
    }

    // Delete associated galleries images
    foreach ($book->galleries as $gallery) {
        Storage::delete('public/galleries/' . $gallery->image);
    }

    // Delete the book
    $book->delete();

    return redirect('/buku')->with('status', 'Data Buku Berhasil Dihapus');
}
    public function edit($id){
        $books = Books::find($id);
        return view('edit', compact('books'));
    }

    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);
    
        // Validasi input
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'tanggal_terbit' => 'required|date',
            'image' => 'mimes:jpeg,jpg,png,gif|nullable|max:10000',
            'gallery_images.*' => 'file|mimes:jpeg,jpg,png,gif|nullable|max:10000', // Validasi untuk beberapa gambar
            'caption.*' => 'nullable|string',
            'editorial_pick' => 'boolean',
        ]);
    
        // Data untuk memperbarui buku
        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'harga' => $request->harga,
            'tanggal_terbit' => $request->tanggal_terbit,
            'editorial_pick' => $request->editorial_pick ?? 0,
            'discount' => $request->discount ?? 0,
        ];
    
        // Tangani pembaruan gambar buku jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($book->image) {
                Storage::delete('public/img/' . $book->image);
            }
    
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('public/img');
            $data['image'] = basename($imagePath);
        }
    
        // Perbarui data buku
        $book->update($data);
    
        // Tangani gambar galeri baru yang diunggah
        if ($request->hasFile('gallery_images')) {
            // Simpan gambar galeri baru
            foreach ($request->file('gallery_images') as $index => $image) {
                $galleryPath = $image->store('public/galleries');
                $book->galleries()->create([
                    'image' => basename($galleryPath),
                    'caption' => $request->captions[$index] ?? '', // Jika tidak ada caption, kosongkan
                ]);
            }
        }
        
        return redirect('/buku')->with('status', 'Data Buku Berhasil Diubah');
    }

    public function toggleEditorialPick($id)
{
    $book = Books::findOrFail($id);
    $book->editorial_pick = !$book->editorial_pick;
    $book->save();

    return redirect()->back()->with('status', 'Editorial Pick berhasil diperbarui!');
}
}

// public function search(Request $request){
//     $batas = 5;
//     $search = $request->search;
//     $books = Books::where('title', 'like', "%" . $search . "%")->orwhere('author','like','%'.
//     $search.'%')->paginate($batas);
//     $totalBooks = $books->count();
//     $totalHarga = Books::sum('harga');
//     $no = $batas * ($books->currentPage() - 1);
//     return view('search', compact('books', 'no', 'search', 'totalBooks', 'totalHarga'));
// }