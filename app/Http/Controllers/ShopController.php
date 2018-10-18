<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\author;
use App\book;
use App\Mail\OrderShipped;


class ShopController extends Controller
{


    public function getAuthors(Request $request) {


        $authors = author::paginate(2);

        $books = book::all();

        if ($request->ajax()) {
            return view('author', compact('authors', 'books'));
        }

        return view('author_list',compact('authors', 'books'));
    }

    public function getBooks(Request $request) {

        $books = book::paginate(5);
        $authors = Author::all();

        if ($request->ajax()) {
            return view('books', compact('books','authors'));
        }

        return view('book_list',compact('books', 'authors'));
    }





    public function sendMail(Request $request, $bookId)
    {

        $book = Book::findOrFail($bookId);
        $email = $request->email;
        $name = $request->name;
        $author = Author::find($book->author_id);



        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email',
        ]);

        if ($validator->passes())
        {
            Mail::to('artem.dragun@mail.ru')->send(new OrderShipped($email, $book, $name, $author));
            $books = book::paginate(5);
            return response()->json();

        }

        return response()->json(['errors'=>$validator->errors()->all()]);
    }
}
