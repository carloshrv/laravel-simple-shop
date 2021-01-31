<!DOCTYPE html>

<html>
<head>

<meta charset="utf-8">
<title>Reset Password</title>
<link rel="stylesheet" href="{{  asset('css/stylesheet.css')  }}">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">

</head>
<body>
    <div class="background">

    </div>

    <section id="conteudo-view" class="login">

    @if(session('error'))
        <div>
        {{session('error')}}
        </div>
    @endif

    @if(session('sucess'))
        <div>
        {{session('sucess')}}
        </div>
    @endif

    {!! Form::open(['route' => 'admin.forgot.password', 'method' => 'post'])   !!}
    <p id="email">Type your e-mail</p>

    <label>
        {!!  Form::text('username', null, ['class' => 'input', 'placeholder' => 'Email'])  !!}
    </label>

    {!!   Form::submit('Send E-mail')   !!}

    {!! Form::close()    !!}
    
    
    
</section>

</body>

