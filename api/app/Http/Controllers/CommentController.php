<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $pageSize = $request->page_size ?? 20;
        $comments = Comment::query()->paginate($pageSize);

        return CommentResource::collection($comments);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CommentRepository $repository)
    {
        //
       $created =  $repository->create($request->only(
        [
            'body',
            'user_id',
            'post_id'
        ]
        ));

        


        return new JsonResponse([
            'data' => $created,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //

        return new CommentResource($comment);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment, CommentRepository $repository)
    {
        //

        $comment = $repository->update($comment, $request->only([
            'body',
            'user_id',
            'post_id'
        ]));

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, CommentRepository $repository)
    {

    $repository->forceDelete($comment);

    return new JsonResponse([
        'data' => 'success'
    ]);
    }
}
