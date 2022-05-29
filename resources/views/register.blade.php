@extends('layouts.app')

@section('content')
<section class="books login-form pt-4 ">
    <div class="container">
        <div class="row gutters-sm d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-title p-4 bg-light">Registration</h5>
                    <div class="card-body">
                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nickname</label>
                            <input type="text" name="nickname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('nickname') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Group</label>
                            <input type="text" name="group" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('group') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Id card photo</label>
                            <input type="file" name="idcard" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telegram username</label>
                            <input type="text" name="tg_username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('tg_username') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <button type="submit" class="submit btn btn-dark">Submit</button> or <a href="/register">Register</a>
                    </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection