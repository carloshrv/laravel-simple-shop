<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FlightWithUS</title>
    @yield('css-view')
    <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1b99131786.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}" defer >
    </script>
</head>

<body>
    
    @include ('templates.menu_lateral')
    
    
    <section id="panel">
     @yield('panel')
    </section>

    <section id="view-conteudo">
     @yield('conteudo-view')
    </section>

    @yield('js-view')

</body>


</html>