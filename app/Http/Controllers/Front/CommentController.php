<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CommentRequest;
use App\Models\{Comment, Post};

class CommentController extends Controller
{
    public function __construct()
    {
        if (!request()->ajax()) {
            abort(403);
        }
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \App\Http\Requests\Front\CommentRequest $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post)
    {
        $data = [
            'body' => $request->message,
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
        ];

        $request->has('commentId') ?
            Comment::findOrFail($request->commentId)->children()->create($data) :
            Comment::create($data);

        $commenter = $request->user();

        return response()->json($commenter->valid ? 'ok' : 'invalid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        try {
            // Vérifie si l'utilisateur est autorisé à supprimer ce commentaire
            $this->authorize('delete', $comment);

            // Supprime le commentaire
            $comment->delete();

            // Retourne une réponse JSON avec un message de confirmation
            return response()->json(['message' => 'Commentaire supprimé avec succès'], 200);
        } catch (\Exception $e) {
            // Retourne une réponse JSON avec l'erreur en cas d'échec
            return response()->json(['error' => 'Erreur lors de la suppression du commentaire', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the comments for the specified post.
     *
     * @param  \App\Models\Post  $post
     * @param  integer $page
     * @return array
     */
    public function comments(Post $post)
    {
        $comments = $post->validComments()
            ->withDepth()
            ->latest()
            ->get()
            ->toTree();

        return [
            'html' => view('front/comments', compact('comments'))->render(),
        ];
    }
}
