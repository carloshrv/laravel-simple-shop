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
    
    {!! Form::model($admin, ['route' => ['reset.pass', $admin->id], 'method' => 'put'])   !!}
    <p id="newpass">Type your new password</p>
    
    <label >
        {!!  Form::password('password', ['placeholder' => 'senha'])  !!}
    </label>

    {!!   Form::submit('Update')   !!} 

    {!! Form::close()    !!}
    
    
    
</section>

</body>

