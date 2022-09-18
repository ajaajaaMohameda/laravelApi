<?php
namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class CommentRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return  DB::transaction(function() use ($attributes) {
            $comment = DB::query()->create(
                [
                    'body' => data_get($attributes, 'body'),
                    'user_id' => data_get($attributes, 'user_id'),
                    'post_id' => data_get($attributes, 'post_id')
                ]
            );

            return $comment;
        });
    }


    public function update($model, array $attributes)
    {
        return DB::transaction(function() use($attributes, $model) {
            $updated = $model->update([
                'body' => data_get($attributes, 'body', $model->body),
                'user_id' => data_get($attributes, 'user_id', $model->user_id),
                'post_id' => data_get($attributes, 'post_id', $model->post_id)
            ]);

            throw_if(!$updated, GeneralJsonException::class, 'Failed to update');

            return $model;
        });
    }


    public function forceDelete($model)
    {
        return DB::transaction(function() use ($model) {

            $deleted = $mode->forceDelete();
            throw_if(!$deleted, GeneralJsonException::class, 'Failed to delete');


            return $deleted;
        });
    }
}