<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>サンプル掲示板　編集画面</title>
    <link rel="stylesheet" href="/css/style.css"/>
    <script type='text/javascript' src='/js/index.js'></script>
</head>
<body>
    <header class="Area_header">投稿内容の更新</header>
    @if(session('message') !== null)
    <div class="'alert ' + {{session('alert_class')}}" role="alert" id="flash-message">
        {{session('message')}}
    </div>
    @endif
    <div class="Area_register">
        <form action="/update" method="post">
        @csrf
            <table border="1" class="Area_register_table">
                <tr>
                    <td class="heading">名前</td>
                    <td class="body">
                        <input type="text" name="name" size="50" value="{{$article['name']}}" >
                    </td>
                </tr>
                <tr>
                    <td class="heading">題名</td>
                    <td class="body">
                        <input type="text" name="title" size="50" value="{{$article['title']}}" >
                    </td>
                </tr>
                <tr>
                    <td class="heading">内容</td>
                    <td class="body">
                        <textarea name="contents" rows="6" cols="65"> {{$article['contents']}} </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        投稿KEY　<input type="password" value="" name="articleKey">
                        <button type="submit">更新</button>
                        <button type="button" onclick="backToTop()">戻る</button>
                        <button type="reset">リセット</button>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="id" value="{{$article['id']}}">
        </form>
    </div>
</body>
</html>