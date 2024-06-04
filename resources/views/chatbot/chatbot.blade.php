<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechRevive Chatbot</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            width: 400px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 10px;
        }
        .title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 10px;
        }
        .inbox {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .icon {
            width: 40px;
            height: 40px;
            background: #f2f2f2;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #333;
            margin-right: 10px;
        }
        .msg-header {
            max-width: 70%;
            padding: 10px;
            border-radius: 5px;
            background: #f2f2f2;
            position: relative;
        }
        .user-inbox .msg-header {
            background: #d1e7dd;
        }
        .bot-inbox .icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
        .query-button {
            background: #e7e7e7;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px 0;
            display: block;
            width: fit-content;
        }
        .query-button:hover {
            background: #ccc;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="title">
            <img src="{{ asset('img/logo.jpg') }}" alt="Logo" style="width: 30px; height: 30px; vertical-align: middle;">
            TechRevive Chatbot
        </div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo">
                </div>
                <div class="msg-header">
                    <p>👋 salut  Posez vos questions et obtenez de l'aide instantanément</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // Charger les queries disponibles
            $.ajax({
                url: '{{ route("get-queries") }}',
                type: 'GET',
                success: function(result){
                    result.queries.forEach(function(query){
                        var queryHTML = '<div class="bot-inbox inbox"><div class="icon"><img src="{{ asset('img/logo.jpg') }}" alt="Logo"></div><div class="msg-header"><button class="query-button">'+ query +'</button></div></div>';
                        $(".form").append(queryHTML);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });

            $(document).on("click", ".query-button", function(){
                var value = $(this).text();
                var messageHTML = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ value +'</p></div></div>';
                $(".form").append(messageHTML);

                // AJAX code
                $.ajax({
                    url: '{{ route("get-message") }}',
                    type: 'POST',
                    data: { 
                        text: value,
                        _token: '{{ csrf_token() }}' // Ajoutez le jeton CSRF ici
                    },
                    success: function(result){
                        var replyHTML = '<div class="bot-inbox inbox"><div class="icon"><img src="{{ asset('img/logo.jpg') }}" alt="Logo"></div><div class="msg-header"><p>'+ result.reply +'</p></div></div>';
                        $(".form").append(replyHTML);
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                    }
                });
            });
        });
    </script>
</body>
</html>
