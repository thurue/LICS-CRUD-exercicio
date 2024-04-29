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
            <div id="lics-app">
                <lic-component             
                delete-method="DELETE"
                csrf-token="{{ csrf_token() }}" :dados="{{json_encode($licUni) }}"> </lic-component>
            </div>
    </body>
</html>