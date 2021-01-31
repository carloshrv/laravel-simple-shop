<!DOCTYPE html>

<html>
<head>

<meta charset="utf-8">
<title>FlightWithUS</title>
<link rel="stylesheet" href="{{  asset('css/stylesheet.css')  }}">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">

</head>
<body>
    <div class="background">

    </div>

    <section id="conteudo-view" class="login">
    
    {!! Form::open(['route' => 'admin.auth', 'method' => 'post'])   !!}
    <p id='welcome'>Admin Panel</p>

    <label>
        {!!  Form::text('username', null, ['class' => 'input', 'placeholder' => 'usuario'])  !!}
    </label>

    <label >
        {!!  Form::password('password', ['placeholder' => 'senha'])  !!}
    </label>

    {!!   Form::submit('Sign-in')   !!} <a id='ForgotPass' href="{{route('forgot.password')}}"><p>Forgot my password</p></a>

    {!! Form::close()    !!}
    
    
    
</section>

</body>

