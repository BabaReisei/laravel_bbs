<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>サンプル掲示板</title>
    <link rel="stylesheet" href="/css/style.css"/>
    <script type='text/javascript' src='/js/index.js'></script>
</head>
<body>
    <header class="Area_header">サンプル掲示板</header>
    @if(session('message') !== null)
    <div class="'alert ' + {{session('alert_class')}}" role="alert" id="flash-message">
        {{session('message')}}
    </div>
    @endisset
    <div class = "Area_register">
        <form action="/" method="post">
        @csrf
            <table border="1" class="Area_register_table">
                <tr>
                    <td class="heading">名前</td>
                    <td class="body">
                        <input type="text" name="name" size="50">
                    </td>
                </tr>
                <tr>
                    <td class="heading">題名</td>
                    <td class="body">
                        <input type="text" name="title" size="50">
                    </td>
                </tr>
                <tr>
                    <td class="heading">内容</td>
                    <td class="body">
                        <textarea name="contents" rows="6" cols="65" maxlength="500"></textarea>
                        投稿KEY：<input type="password" name="articleKey" maxlength="4">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">送信</button>
                        <button type="reset">リセット</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="border_line"></div>

    <div class="Area_articles" >
    @foreach($articles as $article)
        <div>
            <table border="1" class="Area_articles_table">
                <tr class="Area_article_title">
                    <td>
                        <label>
                            <input type="radio" name="article_check" data-id="{{$article['id']}}"/>
                            {{$article['id']}}.　{{$article['title']}}
                        </label>
                    </td>
                </tr>
                <tr>
                    <td> 名前：　{{$article['name']}} 　投稿日：　{{$article['update_at'] -> format('Y/m/d H:i:s')}}</td>
                </tr>
                <tr>
                    <td>
                        <pre>{{$article['contents']}}</pre>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
    </div>

    <div class="Area_change_article">
        <form action="/" method="get" name="form_change_article">
            <button type="button" onclick="changeArticleSubmit('update')">編集</button>
            <button type="button" onclick="changeArticleSubmit('delete')">削除</button>
        </form>
    </div>
</body>
</html>