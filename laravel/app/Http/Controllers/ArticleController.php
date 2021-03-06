<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->only(['title', 'body']);
        $article = Article::create([
            "title" => $data["title"],
            "body" => $data["body"]
        ]);

        if ($article) {
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $article = Article::find($request->id);

        $article->delete();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->only(['title', 'body', 'id']);

        $article = Article::find($data['id']);

        if (!$article) {
            return abort(404);
        }

        $article->title = $data["title"];
        $article->body = $data["body"];
        $article->save();

        return redirect()->to('/project');
    }
}
