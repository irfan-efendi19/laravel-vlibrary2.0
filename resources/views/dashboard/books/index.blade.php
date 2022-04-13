@extends("dashboard.layouts.core")

@section("container")
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Provided Books</h1>
    </div>

    @if (session()->has("success"))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session("success") }}
      </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/dashboard/books/loan/create" class="btn btn-success mb-2 text-decoration-none">Loan Book</a> 
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th></th>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Author</th>
            </tr>
          </thead>
          <tbody>
            @foreach($books as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->title }}</td>
                    <td>{{ $b->category->name }}</td>
                    <td>{{ $b->author->name }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
@endsection