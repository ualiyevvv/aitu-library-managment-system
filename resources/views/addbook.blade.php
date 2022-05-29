@extends('layouts.app')

@section('content')
<section class="books login-form pt-4">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-6">
                <div class="card">
                    <h5 class="card-title p-4 bg-light">Add book</h5>
                    <div class="card-body">
                        <form action="{{ route('bookstore') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Caption</label>
                            <input type="text" class="form-control" name="caption" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('caption') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Author</label>
                            <input type="text" class="form-control" name="author" id="exampleInputPassword1" value="{{ old('author') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Lang</label>
                            <input type="text" class="form-control" name="lang" id="exampleInputPassword1" value="{{ old('lang') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="exampleInputPassword1" value="{{ old('category') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="text" class="form-control" name="descr" id="exampleInputPassword1" value="{{ old('descr') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" id="exampleInputPassword1" value="{{ old('country') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pages</label>
                            <input type="text" class="form-control" name="pages" id="exampleInputPassword1" value="{{ old('pages') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">isbn</label>
                            <input type="text" class="form-control" name="isbn" id="exampleInputPassword1" value="{{ old('isbn') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">shtrih</label>
                            <input type="text" class="form-control" name="shtrih" id="exampleInputPassword1" value="{{ old('shtrih') }}">
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Cover</label>
                            <input type="file" class="form-control" name="image" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="submit btn btn-dark">Upload</button>
                    </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section>

@endsection