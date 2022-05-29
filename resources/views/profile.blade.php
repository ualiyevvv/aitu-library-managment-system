@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main-body">
    
        <!-- Breadcrumb -->
        <!-- <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
        </ol>
        </nav> -->
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{asset('img/profile.png')}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4>{{ Auth::user()->nickname }}</h4>
                        <!-- <p class="text-secondary mb-1">Full Stack Developer</p>
                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                        <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button> -->
                    </div>
                    </div>
                </div>
                </div>
                <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Telegram</h6>
                        <span class="text-secondary">{{ Auth::user()->tg_username }}</span>
                    </li>
                </ul>
                </div>
            </div>
            <div class="col-md-8">
                <h4>Status</h4>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(Auth::user()->email_verified_at == null)
                                    <h6 class="mb-0">ожидайте верификации, или напишите в тех.поддержу в телеграм @mitxp</h6>
                                @else
                                    <h6 class="mb-0">verified</h6>
                                @endif
                            </div>
                        </div>
                        <hr>
                        
                    </div>
                </div>
                <h4>History</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Caption</th>
                        <th scope="col">Author</th>
                        <th scope="col">Start date</th>
                        <th scope="col">Finish date</th>
                        <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $countborrowedbooks = 0 ?>
                    @if(count($borrowed_books) > 0)
                        @foreach($borrowed_books as $borrowed_book)
                            <? $countborrowedbooks++ ?>
                            <tr>
                                <th scope="row">{{ $countborrowedbooks }}</th>
                                <td>{{ $borrowed_book->book->caption }}</td>
                                <td>{{ $borrowed_book->book->author }}</td>
                                @if( $borrowed_book->start_date == null)
                                    <td>in process</td>
                                @else
                                    <td>{{ $borrowed_book->start_date }}</td>
                                @endif
                                @if( $borrowed_book->finish_date == null)
                                    <td>not yet</td>
                                @else
                                    <td>{{ $borrowed_book->finish_date }}</td>
                                @endif

                                
                                @if( $borrowed_book->status == 0)
                                    <td>ждет подтверждения</td>
                                @elseif( $borrowed_book->status == 1 )
                                    <td>возвращено</td>
                                @elseif( $borrowed_book->status == 2 )
                                    <td>выдано</td>
                                @else
                                    <td>отказано</td>
                                @endif
                            </tr>
                        @endforeach
                        @else
                            <p>вы не получали книги. возьмите книгу из <a href="/">каталога</a></p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection