<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function index(Request $request)
    {

        $listShown = $request->listShown;
        $search = $request->search;
        if ($listShown == null) {
            $listShown = 10;
        }
        $books = Ratings::select(
            'books.name as book_name',
            'books.id',
            'authors.name as author_name',
            'categories.name as category_name',
            DB::raw('avg(rating) as average_rating'),
            DB::raw('count(rating) as voter')
        )
            ->join('books', 'ratings.book_id', '=', 'books.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->where('books.name', 'LIKE', '%' . $search . '%')
            ->orWhere('authors.name', 'LIKE', '%' . $search . '%')
            ->groupBy('books.name', 'books.id', 'authors.name', 'categories.name')
            ->orderByDesc('average_rating')
            ->orderByDesc('voter')
            ->take($listShown)
            ->get();

        return view('list_book', compact('books', 'search', 'listShown'));
    }

    public function topAuthors()
    {
        $authors = Ratings::select(
            'authors.name as author_name',
            DB::raw('count(rating) as voter')
        )
            ->join('books', 'ratings.book_id', '=', 'books.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->where('rating', '>', 5)
            ->groupBy('authors.name')
            ->orderByDesc('voter')
            ->take(10)
            ->get();
        return view('top_author', compact('authors'));
    }

    public function insertRating()
    {
        return view('input_rating', [
            'title' => 'insert_rating',
            'authors' => Authors::all()->sortBy('name')
        ]);
    }

    public function select_book($author_id)
    {

        $books = DB::table('books')->where('author_id', $author_id)->get();

        echo json_encode($books);
    }

    public function storeRating(Request $request)
    {

        $validateData = $request->validate([
            'book_id' => 'required',
            'rating' => 'required'
        ]);

        Ratings::create($validateData);

        return redirect('/')->with('success', 'Rating Successfully Added!');
    }
}
