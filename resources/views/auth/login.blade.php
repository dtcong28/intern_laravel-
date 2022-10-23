<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body>
<div class="wrapper">
    <div class="container pt-5">
        @if (session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.post_login') }}" class="m-3" method="post">
            @csrf
            <div class="form-group mb-3">
                <label class="label" for="email">Email</label>
                <input type="text" id="email" value="{{old('email')}}" name="email"
                       class="form-control col-5" placeholder="Email">
                @error('email')
                <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="password">Password</label>
                <input type="password" name="password" class="form-control col-5" placeholder="Password">
                @error('password')
                <span style="color: red">{{ $message }}</span>
                @enderror
                @if (session('msg'))
                    <small class="form-text text-danger "
                           style="font-style: italic;font-size: 15px;">
                        {{ session('msg') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary ">Sign
                    In
                </button>
            </div>
        </form>
    </div>
    @include('layout.footer')
</div>
</body>
