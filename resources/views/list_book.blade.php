@extends('layouts.main')
@section('container')

    <div class="container d-flex justify-content-center">
        <div class="col-lg-10 card p-4 mt-4">

            @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>  
            @endif
            
            <h1>List Of Book</h1>

            {{-- for filter some data --}}
            <form action="/" method="GET">

                <div class="form-group row">
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <label>List Shown</label>
                    </div>
                    <div class="col-sm-5 col-md-8 col-lg-9">
                        <select class="form-control" name="listShown">
                            @for ($i = 10; $i <= 100; $i +=10) 
                                @if ($i == $listShown)
                                    <option selected value="{{ $i }}">{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>    
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <label>Search</label>
                    </div>
                    <div class="col-sm-5 col-md-8 col-lg-9">
                        <input class="form-control" type="text" placeholder="Search book or author name ..." name="search" value="{{ $search }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Submit</button>

            </form>
            {{-- end filter --}}

            {{-- books data --}}
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Book Name</th>
                        <th>Category Name</th>
                        <th>Author Name</th>
                        <th>Avarage Rating</th>
                        <th>Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $book->book_name }}</td>
                        <td>{{ $book->category_name }}</td>
                        <td>{{ $book->author_name }}</td>
                        <td class="text-center">{{ round($book->average_rating , 2) }}</td>
                        <td class="text-center">{{ $book->voter }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- end data --}}

        </div>
    </div>

@endsection