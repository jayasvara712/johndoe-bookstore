@extends('layouts.main')
@section('container')

    <div class="container d-flex justify-content-center">
        <div class="col-lg-10 card p-4 mt-4">
            
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>  
            @endif
            
            <h1 class="text-center">Insert Rating</h1>

            {{-- Insert Data --}}
            <form action="/save" method="POST">
                @csrf

                <div class="form-group row">
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <label>Book Author</label>
                    </div>
                    <div class="col-sm-5 col-md-8 col-lg-9">
                        <select name="author_id" class="form-control" id="author">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>   
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <label>Book Name</label>
                    </div>
                    <div class="col-sm-5 col-md-8 col-lg-9">
                        <select name="book_id" class="book form-control" id="book">
                            
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <label>Rating</label>
                    </div>
                    <div class="col-sm-5 col-md-8 col-lg-9">
                        <select name="rating" class="form-control">
                            @for ($i = 1; $i <= 10; $i++) 
                                <option value="{{ $i }}">{{ $i }}</option>    
                            @endfor
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                
            </form>
            {{-- END Insert Data --}}
        </div>
    </div>

@endsection