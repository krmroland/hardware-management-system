<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ company("name") }} System</title>
    <link rel="stylesheet" href="/css/hardware.css">
</head>
<body class="bg-grey relative">
    <div class="conatiner vertically-centered">
        <div class="card col-md-6">
            <h2 class="text-primary text-center p-3">{{ company("name")}}</h2>
            <div class="card-body">
                <h4 class="card-title text-center">Login Form</h4>

                @if (session('branch-error'))
                <div class="alert alert-danger">
                   
                    <strong>Sorry!</strong> 
                    {{ session('branch-error') }}

                </div>
                @endif
                <form action="/login" method="post">
                    {{ csrf_field() }}
                    {{-- Emaill Address --}}
                    <div class="form-group {{$errors->has("email")?'has-danger':''}}">
                        <label  for="email">
                                Emaill Address 
                                <strong class="text-primary">(admin@sales.com)</strong>
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="Emaill Address" value="{{old("email","admin@sales.com")}}">
                        @if($errors->has("email"))
                            <p class="form-text text-danger">
                                {{$errors->first("email")}}
                            </p>
                        @endif
                    </div>
                    
                    {{-- Password --}}
                    <div class="form-group {{$errors->has("password")?'has-danger':''}}">
                        <label  for="password">
                            Password
                            <strong class="text-primary">(password)</strong>
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{old("password",'password')}}">
                        @if($errors->has("password"))
                        <p class="form-text text-danger">
                            {{$errors->first("password")}}
                        </p>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-sign-in"></i>
                            Login
                        </button>
                    </div>
                    <p class="text-right">
                       A project by <a href="https://www.facebook.com/ahimbisibwe.roland" target="_blank">
                        <strong>Ahimbisibwe Roland</strong>
                    </a>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>

