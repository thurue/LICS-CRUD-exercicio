<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        @vite(['resources/js/app.js','resources/css/app.css'])

    </head>
    <body>
            <div id="card-app">
                <card-component :dados="{{json_encode($lics) }}" > </card-component>
            </div>
    </body>
</html>