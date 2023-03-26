<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>John Doe BookStore</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">John Doe Bookstore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">List Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="/top_authors">Top Author</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="/insert_rating">Input Rating</a>
            </li>
            </ul>
        </div>
    </nav>
    
    {{-- for content --}}
    @yield('container')

    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        $(document).ready(() => {
             $("#author").change(select_book);
        })

        function select_book() {

            // variabel dari nilai combo box
            var author = document.getElementById("author");
            var author_val = author.options[author.selectedIndex].value;
            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            var dataJson = {
                author_id: author_val
            };
            console.log(dataJson);
            $.ajax({
                url: "/select_book/"+author_val,
                method: "get",
                data: dataJson,
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(dataJson);
                    console.log(data);
                    var html = '';
                    var i;

                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                    }
                    $('#book').html(html);

                },
                error: function(err, e) {
                    for (var x in err) {
                        console.log(x + " <=> error index of <=> " + err[x])
                    }
                }
            });
        }
    </script>
</body>

</html>