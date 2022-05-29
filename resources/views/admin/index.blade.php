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
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mt-3">
                                <h4>admin dashboard</h4>
                                <!-- <p class="text-secondary mb-1">Full Stack Developer</p>
                                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body ">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Проверить юзеров <span class="badge badge-secondary">{{ count($users) }}</span></a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Выдать книги <span class="badge badge-secondary">{{ count($borrowreqs) }}</span></a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Проверить новую книгу <span class="badge badge-secondary">{{ count($books) }}</span></a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Все книги <span class="badge badge-secondary">{{ count($allbooks) }}</span></a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-memo" role="tab" aria-controls="v-pills-settings" aria-selected="false">Выданные книги <span class="badge badge-secondary">{{ count($borrowedbooks) }}</span></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4>Verification of users</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nickname</th>
                                <th scope="col">idcard</th>
                                <th scope="col">telegram</th>
                                <th scope="col">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $countuser = 0 ?>
                            @if(count($users) > 0)
                            @foreach($users as $user)
                                <? $countuser++ ?>
                                <tr>
                                <th scope="row">{{ $countuser }}</th>
                                <td>{{ $user->nickname }}</td>
                                <td><img src="{{ $user->idcard }}" alt="" style="width:300px"></td>
                                <td>{{ $user->tg_username }}</td>
                                <form action="{{ route('verify', $user->id) }}" method="post">
                                    @csrf
                                    <td><button class="btn btn-success">verify</button></td>
                                </form>
                                </tr>
                            @endforeach
                            @else
                                <p>нет пользователей в очереди на верификацию</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4>Verification of books crossing</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Caption</th>
                                <th scope="col">Author</th>
                                <th scope="col">User telegram</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $countborrowreq = 0 ?>
                            @if(count($borrowreqs) > 0)
                            @foreach($borrowreqs as $borrowreq)
                                <? $countborrowreq++ ?>
                                <tr>
                                <th scope="row">{{ $countborrowreq }}</th>
                                <td>{{ $borrowreq->book->caption }}</td>
                                <td>{{ $borrowreq->book->author }}</td>
                                <td>{{ $borrowreq->user->tg_username }}</td>
                                <form action="{{ route('borrowverify', $borrowreq->id) }}" method="post">
                                    @csrf
                                    <td><button class="btn btn-success">verify</button></td>
                                </form>
                                <form action="{{ route('failrequest', $borrowreq->id) }}" method="post">
                                    @csrf
                                    <td><button class="btn btn-danger">deny</button></td>
                                </form>
                                </tr>
                            @endforeach
                            @else
                                <p>нет заявок в очереди на верификацию</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4>Verification of books adding</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Caption</th>
                                <th scope="col">Author</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $countbooks = 0 ?>
                            @if(count($books) > 0)
                            @foreach($books as $book)
                                <? $countbooks++ ?>
                                <tr>
                                <th scope="row">{{ $countbooks }}</th>
                                <td>{{ $book->caption }}</td>
                                <td>{{ $book->author }}</td>
                                <td><img src="{{ $book->image }}" alt="" style="width:300px"></td>
                                <form action="{{ route('bookverify', $book->id) }}" method="post">
                                    @csrf
                                    <td><button class="btn btn-success">verify</button></td>
                                </form>
                                </tr>
                            @endforeach
                            @else
                                <p>нет книг в очереди на верификацию</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4>All books</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Caption</th>
                                <th scope="col">Author</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Status</th>
                                <th scope="col">Owner</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $countallbooks = 0 ?>
                            @if(count($allbooks) > 0)
                            @foreach($allbooks as $allbook)
                                <? $countallbooks++ ?>
                                <tr>
                                <th scope="row">{{ $countallbooks }}</th>
                                <td>{{ $allbook->caption }}</td>
                                <td>{{ $allbook->author }}</td>
                                <td><img src="{{ $allbook->image }}" alt="" style="width:300px"></td>
                                @if($allbook->status == 1)
                                    <td>на полке</td>
                                @elseif($allbook->status == 2)
                                    <td>ждет выдачи</td>
                                @else
                                    <td>уже читают</td>
                                @endif
                                <td>{{ $allbook->user->tg_username }}</td>
                                <!-- <form action="{{ route('bookverify', $allbook->id) }}" method="post">
                                    @csrf
                                    <td><button class="btn btn-primary">verify</button></td>
                                </form> -->
                                </tr>
                            @endforeach
                            @else
                                <p>нет книг в очереди на верификацию</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-memo" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4>All borrowed books</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Caption</th>
                                <th scope="col">Author</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Кому</th>
                                <th scope="col">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $countborrowedbooks = 0 ?>
                            @if(count($borrowedbooks) > 0)
                            @foreach($borrowedbooks as $borrowedbook)
                                <? $countborrowedbooks++ ?>
                                <tr>
                                <th scope="row">{{ $countborrowedbooks }}</th>
                                <td>{{ $borrowedbook->book->caption }}</td>
                                <td>{{ $borrowedbook->book->author }}</td>
                                <td><img src="{{ $borrowedbook->book->image }}" alt="" style="width:300px"></td>
                                <td>{{ $borrowedbook->user->tg_username }}</td>
                                <form action="{{ route('returnverify', $borrowedbook->id) }}" method="post">
                                    @csrf
                                    <td><button class="btn btn-primary">return</button></td>
                                </form>
                                </tr>
                            @endforeach
                            @else
                                <p>нет выданных книг</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
</div>
@endsection