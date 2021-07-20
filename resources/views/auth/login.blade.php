<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Log In</title>
  </head>
  <body>
     <div class="card bg-light">
        @include('admin.layout.notification')
        <article class="card-body mx-auto">
            <h4 class="card-title mt-3 text-center">Đăng nhập </h4>
            <p>
                <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i> Đăng nhập bằng Google</a>
                <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i> Đăng nhập bằng Facebook</a>
            </p>
            <p class="divider-text">
                <span class="bg-light">Hoặc</span>
            </p>
            <form action="{{ route('post.login')}}" method="POST">
                @csrf
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" type="email"  value="{{old('email')}}" required="" />
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control @error('password') is-invalid @enderror" placeholder="Create password" type="password" name="password" value="{{old('password')}}" required="" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                </div>
            </form>
        </article>
    </div>
  </body>
</html>
