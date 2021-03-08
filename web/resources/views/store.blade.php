<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create post</title>

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
    <p><a href="/">Contents</a></p>
        <h1>Create post</h1>

        <form method="post" action="/store" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="f">
                <div>
                    <div>Title</div>
                    <div><input type="text" name="title" value="" /></div>
                </div>

                <div>
                    <div>alt</div>
                    <div><input type="text" name="alt" value="" /></div>
                </div>

                <div>
                    <div>Picture</div>
                    <div><input type="file" name="pict"  /></div>
                </div>

                <div>
                    <div><input type="submit" value="Store" /></div>
                </div>
            </div>
        </form>



    </body>
</html>
