<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowreq;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where('status', '>', 0)
            ->get();

        return view('index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('addbook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'author' => 'required',
            'category' => 'required',
            'country' => 'required',
            'descr' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'pages' => 'required|int',
            'isbn' => 'required',
            'shtrih' => 'required',
            'lang' => 'required',
        ]);

        $data = $request->all();
        // $data['user_id'] = Auth::user()->id;
        // $data['strike_id'] = 1;
        if($request->hasFile('image'))
        {
            $folder = date('Y-m-d');
            $path = $request->file('image')->store("uploads/{$folder}", 'public');
            $data['image'] = "/".$path;
        }
        dd($path);
        $data['user_id'] = Auth::user()->id;
        $book = Book::create($data);

        return redirect()->route('bookshow', ['id'=>$book->id])->with('success', 'Книга добавлена в базу и ждет подтверждения, отнесите ее на полку и админы подтвердят заявку');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::where('id', $id)->first();
                    
        if(!$book)
        {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }
        

        return view('book', compact('book'));
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


    public function preborrow($id)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect()->back()->withErrors('You need verification, lets go to profile');
        }
        

        $book = Book::find($id);
        if ($book->status != 1) {
            return redirect()->back()->withErrors('Эта книга занята');
        }
        if (!$book) {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }

        $borrowreq = new Borrowreq;
        $borrowreq->user_id = Auth::user()->id;
        $borrowreq->book_id = $id;
        $borrowreq->save();
        
        $book->status = 2;
        $book->save();
        
        
        return redirect()->route('profile')->with('success', 'Ожидайте. Заявка находится на рассмотрении админа. Или напишите в тех.поддержку в телеграм @mitxp');
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
