@extends('layouts.app')

@section('content')

<section class="book pt-4">
    <div class="container">
        <div class="row mb-2">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="link-dark" href="index.html">Home</a></li>
                <!-- <li class="breadcrumb-item"><a class="link-dark" href="index.html#bestsellers">Top sellers</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">{{ $book->caption }}</li>
            </ol>
            </nav>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-md-3">
                <div class="book-img" style="background: url('{{ $book->image }}') center center/cover no-repeat;">
                    @if($book->status == 2)
                        <h1><span class="badge badge-secondary">ждет выдачи</span></h1>
                    @elseif($book->status == 3)
                        <h1><span class="badge badge-secondary">уже читают</span></h1>
                    @elseif($book->status == 0)
                        <h1><span class="badge badge-secondary">проходит проверку</span></h1>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="card p-4 pt-0">
                    <h1>{{ $book->caption }}</h1>
                    <a href="#" class="link-secondary"><h5>{{ $book->author }}</h5></a>
                    <div class="row mt-2 ml-0">
                        <div class="rank">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="book_text mt-4">
                        {{ $book->descr }}
                    </div>
                    <div class="book_text mt-4">
                        <b>Category:</b> {{ $book->category }}
                    </div>
                    <div class="book_text mt-4">
                        <b>Country:</b> {{ $book->country }}
                    </div>
                    <div class="book_text mt-4">
                        <b>Pages:</b> {{ $book->pages }}
                    </div>
                    <div class="book_text mt-4">
                        <b>Language:</b> {{ $book->lang }}
                    </div>
                    <!-- <div class="price mt-4"><b>$14.5</b></div> -->
                    <div class="buy mt-2">
                        <form method="post" action="{{ route('bookpreborrow', $book->id) }}">
                            @csrf
                            <button class="btn btn-dark" id="Addtocart">Borrow</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tabs mt-4">
    <div class="container">
    <div class="tab">
        <button id="reviews" class="tablinks" onclick="openCity(event, 'London')">Reviews</button>
        <button class="tablinks" onclick="openCity(event, 'Paris')">Characteristics</button>
        <button class="tablinks" onclick="openCity(event, 'Tokyo')">Delivery</button>
    </div>
    
    <div id="London" class="tabcontent">
        <h3>Reviews</h3>
        <p>London is the capital city of England.</p>
    </div>
    
    <div id="Paris" class="tabcontent">
        <h3>Characteristics</h3>
        <p>Paris is the capital of France.</p> 
    </div>
    
    <div id="Tokyo" class="tabcontent">
        <h3>Delivery</h3>
        <p>Tokyo is the capital of Japan.</p>
    </div>  
    </div>
</section>
<!-- <section class="similar mt-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 mb-3 d-flex align-items-center">
                <h2>Similar books</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-img" style="background: url('img/similar.jpg') center center/cover no-repeat;"></div>
                    <div class="card-body">
                        <h5 class="card-title">Atlas Shrugged</h5>
                        <h6 class="card-title link-secondary">Ayn Rand</h6>
                        <p class="card-text"><b>$14.5</b></p>
                        <a href="book.html" class="btn btn-outline-dark"><i class="fa fa-plus-circle" aria-hidden="true"></i>add to cart</a>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section> -->

<script src="{{ asset('js/script.js') }}"></script>
@endsection