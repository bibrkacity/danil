<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My posts (Javascript Example)</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            table{
                border-collapse:collapse;
            }
            td,th{
                border:1px solid black;
                padding:3px;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
    <p><a href="/">Contents</a></p>
    <h1>My posts (Javascript Example)</h1>

    @inject('user', '\App\Http\Controllers\AuthController')

    <h2>Hello {{  $user->name() }}! Your posts:</h2>

    <span>Total: <span id="total"></span></p>

        <p id = "links"></p>

    <table id="table">
        <tbody>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Alt</th>
                <th>Picture</th>
            </tr>
        </tbody>
    </table>

    <script type="text/javascript">

            let params = new URLSearchParams(document.location.search.substring(1));

            let page = params.get("page") == undefined ? 1 : parseInt(params.get("page"));

            $.get("/posts", {page:page},function(data, status){
                create_table(data);
            });


            function create_table(data)
            {
                console.log(data);

                $('#total').html(data.total) ;

                let links = '';

                let pages = Math.ceil(data.total/data.per_page);
                if(pages > 1)
                    for(let i=1; i<=pages; i++)
                    {
                        if( i == data.current_page)
                            links += '<span>'+i+'</span> ';
                        else
                            links += '<a href="?page='+i+'">'+i+'</a> ';
                    }

                $('#links').html(links) ;

                let table = document.getElementById('table');

                for(i=0; i<data.posts.length; i++)
                {
                    let tr = table.insertRow(-1);

                    let td = tr.insertCell(-1);
                    let txt = document.createTextNode(data.posts[i].id);
                    td.appendChild(txt);

                    td = tr.insertCell(-1);
                    txt = document.createTextNode(data.posts[i].title);
                    td.appendChild(txt);

                    td = tr.insertCell(-1);
                    txt = document.createTextNode(data.posts[i].alt);
                    td.appendChild(txt);

                    td = tr.insertCell(-1);
                    if(data.posts[i].src == 'error')
                    {
                        txt = document.createTextNode('Picture disappeared');
                        td.appendChild(txt);
                    }
                    else {
                        let img = document.createElement('IMG');
                        img.src= data.posts[i].src;
                        img.alt = data.posts[i].alt;
                        img.width=200;
                        td.appendChild(img);
                    }



                }
            }

    </script>



    </body>
</html>
