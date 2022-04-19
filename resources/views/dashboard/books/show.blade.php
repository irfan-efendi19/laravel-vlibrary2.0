@extends("dashboard.layouts.core")

@section("container")
    <div class="container">
        <div class="row my-5">
            @foreach($books as $b)
                <div class="col-md-8">
                    <h2>{{ $b->title }}</h2>
                    
                    <div class="my-3">
                        <a href="/dashboard/books/{{ $b->slug }}/edit" class="btn btn-warning text-white">Edit</a>
                        <form action="/dashboard/blogs/{{ $b->slug }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete ?');">Delete</button>
                        </form>
                    </div>
                        
                    <div class="mt-4">
                        <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7); border-bottom-right-radius: 10px;">
                            <a href='/books?category={{ $b->category->slug }}' class="text-white text-decoration-none">{{ $b->category->name }}</a>
                        </div>
                        {{-- {{ dd(asset('storage/' . $blogs[0]->image)) }} --}}

                        @if($b->book_image != NULL)
                            <img src="{{ asset('storage/' . $b->book_image) }}" class="img-fluid" alt="inet_err">
                        @else
                            <img src="https://source.unsplash.com/1200x400?{{ $b->category->name }}" class="img-fluid" alt="inet_err" style="height: 300px;">
                        @endif
                    </div>
                    
                    <article class="my-4">
                        
                            <h6 class="mb-3"><strong>Author :</strong> <a href="/books?author={{ $b->author->name }}">{{ $b->author->name }}</a></h6>
                            <h6 class="mb-3"><strong>Publisher :</strong> {{ $b->publisher }}</h6>
                            <h6 class="mb-3"><strong>Publication year :</strong> {{ $b->publication_year }}</h6>
                            <h6 class="mb-3"><strong>Total Pages :</strong> {{ $b->total_pages }} pages</h6>
                            <h6 class="mb-3"><strong>Synopsis :</strong></h6>
                            {!! $b->body !!}
                    </article>
                </div>
            @endforeach
        </div>
    </div>
@endsection