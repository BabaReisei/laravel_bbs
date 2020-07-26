<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class BbsController extends Controller {

    // 定数の設定
    const MESSAGE_REGISTER_NORMAL = '正常に投稿できました。';
    const MESSAGE_ARTICLE_DOES_NOT_EXISTS = '対象の記事が見つかりませんでした。';
    const MESSAGE_UPDATE_NORMAL = '正常に更新しました。';
    const MESSAGE_ARTICLE_KEY_UNMATCH = '投稿KEYが一致しません。';
    const ALERT_CLASS_NORMAL = 'alert';
    const ALERT_CLASS_ERROR = 'alert-error';
    const MESSAGE_DELETE_NORMAL = '正常に削除しました。';

    // 記事の取得
    public function getArticleList() {
        $data=['articles'=>Article::all()];
        return view('index', $data);
    }

    // 記事の登録
    public function registerArticle(Request $request) {
        $article = new Article();
        $article -> name = $request -> name;
        $article -> title = $request -> title;
        $article -> contents = $request -> contents;
        $article -> article_key = $request -> articleKey;
        $article -> save();
        
        return redirect('/') -> with(['message' => self::MESSAGE_REGISTER_NORMAL,
                                      'alert_class' => self::ALERT_CLASS_NORMAL]);
    }

    // 記事の編集
    public function getArticleEdit($id) {
        if ($id !== null) {
            $data = Article::where ('id', $id) -> first ();
            return view('edit') -> with('article', $data);
        } else {
            return redirect('/')-> with(['message' => self::MESSAGE_ARTICLE_DOES_NOT_EXISTS,
                                         'alert_class' => self::ALERT_CLASS_ERROR]);
        }
    }

    // 記事の更新
    public function updateArticle(Request $request) {
        $id = $request -> id;
        if (empty($id)) {
            return redirect('/') -> with(['message' => self::MESSAGE_ARTICLE_DOES_NOT_EXISTS,
                                         'alert_class' => self::ALERT_CLASS_ERROR]);
        }
        $data = Article::where ('id', $id) -> first ();
        if ($data -> article_key !== $request -> articleKey) {
            
            return redirect("/edit/{$id}") -> with('article', $data)
                                           ->with(['message' => self::MESSAGE_ARTICLE_KEY_UNMATCH,
                                                   'alert_class' => self::ALERT_CLASS_ERROR]);
        }
        $article = Article::find($id);
        $article -> name = $request -> name;
        $article -> title = $request -> title;
        $article -> contents = $request -> contents;
        $article -> save();
        return redirect('/') -> with(['message' => self::MESSAGE_REGISTER_NORMAL,
                                      'alert_class' => self::ALERT_CLASS_NORMAL]);
    }

    // 記事の削除確認
    public function getDeleteConfirm($id) {
        if (empty($id)) {
            return redirect('/') -> with(['message' => self::MESSAGE_ARTICLE_DOES_NOT_EXISTS,
                                          'alert_class' => self::ALERT_CLASS_ERROR]);
        }
        $data = Article::where ('id', $id) -> first ();
        return view('delete_confirm') -> with('article', $data);
    }

    // 記事の削除
    public function deleteArticle(Request $request) {
        $id = $request -> id;
        if (empty($id)) {
            return redirect('/') -> with(['message' => self::MESSAGE_ARTICLE_DOES_NOT_EXISTS,
                                          'alert_class' => self::ALERT_CLASS_ERROR]);
        }
        $data = Article::where ('id', $id) -> first ();
        if ($data -> article_key !== $request -> articleKey) {
            return redirect("/delete/confirm/{$id}") -> with('article', $data)
                                                     ->with(['message' => self::MESSAGE_ARTICLE_KEY_UNMATCH,
                                                             'alert_class' => self::ALERT_CLASS_ERROR]);
        }
        $data = Article::where ('id', $id) -> delete();
        return redirect('/') -> with(['message' => self::MESSAGE_REGISTER_NORMAL,
                                      'alert_class' => self::ALERT_CLASS_NORMAL]);
    }
}