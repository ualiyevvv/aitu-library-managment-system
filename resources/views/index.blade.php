@extends('layouts.app')

@section('content')
<section class="promo pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-block" style="background: url('img/banner.jpg') center center/cover no-repeat;">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-block" style="background: url('img/banner2.jpg') center center/cover no-repeat;">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-block" style="background: url('img/banner3.jpg') center center/cover no-repeat;">
                    </div>
                </div>
                
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<section class="books pt-4" id="bestsellers">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-4 mb-3 d-flex align-items-center">
                <h2>Catalog</h2>
                <a class="seeal link-secondary" href="#">see all</a>
            </div>
        </div>
        <div class="row">
            @if(count($books) > 0)
            @foreach($books as $book)
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="card-img" style="background: url('{{ $book->image }}') center center/cover no-repeat;">
                        @if($book->status == 2)
                            <h1><span class="badge badge-secondary">ждет выдачи</span></h1>
                        @elseif($book->status == 3)
                            <h1><span class="badge badge-secondary">уже читают</span></h1>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->caption }}</h5>
                        <h6 class="card-title link-secondary">{{ $book->author }}</h6>
                        <!-- <p class="card-text"><b>$14.5</b></p> -->
                        <a href="{{ route('bookshow', $book->id) }}" class="btn btn-outline-dark"><i class="fa fa-plus-circle" aria-hidden="true"></i>borrow</a>
                    </div>
                    </div>
            </div>
            @endforeach
            
            <div class="col-md-3">
                <div class="card">
                    <a href="{{ route('bookadd') }}" class="text-dark">
                            <div class="card-body">
                                <h5 class="card-title">add new book</h5>
                                <h6 class="card-title link-secondary"></h6>
                                <!-- <p class="card-text"><b>$14.5</b></p> -->
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="col-md-12">
                    <div class="row-md"><p>Нет загруженных книг. Нажмите чтобы добавить книгу.</p></div>
                    <a class="btn btn-outline-primary" href="{{ route('bookadd') }}">Добавить книгу</a>
                </div>
            @endif
        </div>
        <!-- <div class="row mt-4">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
                </nav>
        </div> -->
    </div>
</section>
@endsection