<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Borrowreq;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('email_verified_at', null)
            ->get();
        $books = Book::where('status', 0)
            ->get();
        $allbooks = Book::where('status', '>', 0)
            ->with('user')
            ->get();
        $borrowreqs = Borrowreq::where('status', 0)
            ->with('user')
            ->with('book')
            ->get();
        $borrowedbooks = Borrowreq::where('status', 2)
            ->with('user')
            ->with('book')
            ->get();
        return view('admin.index', compact('users', 'books', 'borrowreqs', 'allbooks', 'borrowedbooks'));
    }

    public function verifyUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $date = date('Y-m-d H:i:s');
        if (!$user) {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда'); 
        }
        $user->update(['email_verified_at' => $date]);
        return redirect()->route('admin.index')->with('success', 'User successfully verified');
    }

    public function verifybook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }
        $book->status = 1;
        $book->save();
        return redirect()->route('admin.index')->with('success', 'книга успешно прошла проверку');
    }
    public function borrow($borrowid)
    {
        $borrowreq = Borrowreq::find($borrowid);

        $book = Book::where('id', $borrowreq->book_id)
            ->first();
        if (!$book) {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }
        $book->status = 3;
        $book->save();
        
        $borrowreq->start_date = date('Y-m-d H:i:s');
        $borrowreq->status = 2;
        $borrowreq->save();
        return redirect()->route('admin.index')->with('success', 'книга успешно выдана мемберу');
    }
    public function returnBook($borrowid)
    {
        $borrowreq = Borrowreq::find($borrowid);

        $book = Book::where('id', $borrowreq->book_id)
            ->first();
        if (!$book) {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }
        $book->status = 1;
        $book->save();

        $borrowreq->finish_date = date('Y-m-d H:i:s');
        $borrowreq->status = 1;
        $borrowreq->save();
        return redirect()->route('admin.index')->with('success', 'книга успешно возвращена на место');
    }


    public function failBook($borrowid)
    {
        $borrowreq = Borrowreq::find($borrowid);

        $book = Book::where('id', $borrowreq->book_id)
            ->first();
        if (!$book) {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }
        $book->status = 1;
        $book->save();

        $borrowreq->finish_date = date('Y-m-d H:i:s');
        $borrowreq->status = 3;
        $borrowreq->save();
        return redirect()->route('admin.index')->with('success', 'книга успешно возвращена на место');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
