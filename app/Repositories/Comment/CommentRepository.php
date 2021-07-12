<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Repositories\Comment\ICommentRepository;

class CommentRepository extends BaseRepository implements ICommentRepository
{
    public function getModel()
    {
        return Comment::class;
    }

    public function create($data)
    {
        $comment = $this->model::create([
            'rate_star' => $data['rate_star'],
            'content' => $data['content'],
            'song_id' => $data['song_id'],
            'user_id' => $data['user_id'],
        ]);

        $comment->user = $comment->user;

        return $comment;
    }

    public function countComments()
    {
        $countComment = $this->model::countComment();

        return $countComment;
    }
}
