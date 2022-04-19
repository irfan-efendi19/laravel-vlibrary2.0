@extends('dashboard.layouts.core')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upload New Developer</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/developers" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus
                value="{{ old('name') }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                value="{{ old('role') }}">
                @error("role")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="profession" class="form-label">Profession</label>
                <input type="text" class="form-control @error('profession') is-invalid @enderror" id="profession" name="profession"
                value="{{ old('profession') }}">
                @error("profession")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="region" class="form-label">Region</label>
                <select class="form-select @error('region') is-invalid @enderror" name="region">
                    @foreach($regions as $r)
                        <option>{{ $r["Name"] }}</option>
                    @endforeach
                </select>
                @error("region")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram_link" class="form-label">Instagram Link</label>
                <input type="text" class="form-control @error('instagram_link') is-invalid @enderror" id="instagram_link" name="instagram_link"
                value="{{ old('instagram_link') }}">
                @error("instagram_link")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="github_link" class="form-label">Github Link</label>
                <input type="text" class="form-control @error('github_link') is-invalid @enderror" id="github_link" name="github_link"
                value="{{ old('github_link') }}">
                @error("github_link")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_link" class="form-label">Email Link</label>
                <input type="text" class="form-control @error('email_link') is-invalid @enderror" id="email_link" name="email_link"
                value="{{ old('email_link') }}">
                @error("email_link")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dev-photo" class="form-label">Photo</label>
                <input class="form-control @error('dev-photo') is-invalid @enderror" type="file" id="dev-photo" name="dev-photo">

                @error("dev-photo")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <input id="bio" type="hidden" name="bio" class="@error('bio') is-invalid @enderror" value="{{ old('bio') }}">
                <trix-editor input="bio"></trix-editor>
                @error("bio")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection