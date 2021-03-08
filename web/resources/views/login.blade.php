<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            div#f{
                display:table;
            }

            div#f > div{
                display:table-row;
            }

            div#f > div > div{
                display:table-cell;
            }

        </style>
    </head>
    <body>
        <h1>Login</h1>
        For this test - test@gmail.com/test
        <form method="post" action="/login">
            {{ csrf_field() }}
            <div id="f">
                <div>
                    <div>Login</div>
                    <div><input type="email" name="email" value="test@gmail.com" /></div>
                </div>

                <div>
                    <div>Password</div>
                    <div><input type="password" name="password" value="test" /></div>
                </div>

                <div>
                    <div><input type="submit" value="Login" /></div>
                </div>
            </div>
        </form>



    </body>
</html>
