<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Test</title>
</head>
<body>
    <div class="container">
        <div class="row">

                <form action="{{ url('test') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <div class="form-group">
                          <label for="">nombre</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="helpId">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                          <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                
                
                    </form>
        </div>
           
    </div>
    <script src="js/test.js"></script>
</body>
</html>