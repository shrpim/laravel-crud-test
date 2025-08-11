<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/comments",
     *     summary="Get all comments",
     *     tags={"Comments"},
     *     @OA\Response(
     *         response=200,
     *         description="List of comments"
     *     )
     * )
     *
     * @OA\Post(
     *     path="/api/comments",
     *     summary="Create new comment",
     *     tags={"Comments"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"post_id", "user_id", "body"},
     *             @OA\Property(property="post_id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="body", type="string", example="Comment text")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comment created successfully"
     *     )
     * )
     *
     * @OA\Get(
     *     path="/api/comments/{id}",
     *     summary="Get comment by ID",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment data"
     *     )
     * )
     *
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     summary="Update comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="body", type="string", example="Updated comment")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment updated successfully"
     *     )
     * )
     *
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     summary="Delete comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Comment deleted"
     *     )
     * )
     */
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());
        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
