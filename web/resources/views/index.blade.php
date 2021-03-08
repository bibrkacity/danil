<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test task</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
    <h1>Test task</h1>

    @inject('user', '\App\Http\Controllers\AuthController')

    Hello {{  $user->name() }}!

    <ul>
        <li><a href="/profile">Profile</a></li>
        <li><a href="/posts">My posts (JSON)</a></li>
        <li><a href="/posts/example">My posts (Javascript Example)</a></li>
        <li><a href="/store">Create a post</a></li>
        <li><a href="/logout">LogOut</a></li>
    </ul>

    </body>
</html>
