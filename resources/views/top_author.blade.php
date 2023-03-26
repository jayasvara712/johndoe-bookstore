@extends('layouts.main')
@section('container')

    <div class="container d-flex justify-content-center">
        <div class="col-lg-10 card p-4 mt-4">
            <h1 class="text-center">Top 10 Most Famous Author</h1>

            {{-- Top Author Data --}}
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Author Name</th>
                        <th>Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $author->author_name }}</td>
                        <td class="text-center">{{ $author->voter }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Top Author Data --}}

        </div>
    </div>

@endsection