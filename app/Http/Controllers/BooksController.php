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
            ->join('books', 'reviews.book_id', '=', 'books.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->where('books.name', 'LIKE', '%' . $search . '%')
            ->orWhere('authors.name', 'LIKE', '%' . $search . '%')
            ->groupBy('books.name', 'books.id', 'authors.name', 'categories.name')
            ->orderByDesc('average_rating')
            ->orderByDesc('voter')
            ->take($listShown)
            ->get();

        return view('book-list', compact('books', 'search', 'listShown'));
    }

    public function topAuthors()
    {
        $authors = Ratings::select(
            'authors.name as author_name',
            DB::raw('count(rating) as voter')
        )
            ->join('books', 'reviews.book_id', '=', 'books.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->where('rating', '>', 5)
            ->groupBy('authors.name')
            ->orderByDesc('voter')
            ->take(10)
            ->get();
        return view('top-authors', compact('authors'));
    }

    public function insertRating(Request $request)
    {
        $authors = Authors::orderBy('name', 'asc')->get();
        $bookAuthor = $request->author;
        if ($bookAuthor) {
            $authorSelected = Authors::findOrFail($bookAuthor);
        } else {
            $authorSelected = $authors->first();
        }
        $books = Books::select('name', 'id')
            ->where('author_id', $authorSelected->id)
            ->orderBy('name', 'asc')
            ->get();

        if ($request->ajax()) {
            return view('book', [
                'books' => $books,
            ]);
        }
        $list = view('book', [
            'books' => $books,
        ])->render();

        return view('insert-rating', compact('authorSelected', 'authors', 'list'));
    }

    public function storeRating(Request $request)
    {

        $book = Books::findOrFail($request->book);
        if ($book->author_id == $request->author) {
            if ($request->rating >= 1 && $request->rating <= 10) {
                Ratings::create([
                    'book_id' => $request->book,
                    'rating' => $request->rating
                ]);
                return redirect('/')->with('success', 'success add new book rating');
            } else {
                return redirect('/insert-rating')->with('faild', 'faild to add new rating, because the rating you entered not between 1 - 10 !. Maybe you are trying to change the value of the available input options ');
            }
        } else {
            return redirect('/insert-rating')->with('faild', 'faild to add new rating, because the name of the book you entered and the name of the author you entered did not match !. Maybe you are trying to change the value of the available input options ');
        }
    }
}
