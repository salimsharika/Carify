<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title> </title>
        <body>
              <h1>ADMIN</h1> 

              <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <input type="submit" value="Logout">
                </form>
        </body>
    </head>
</html>