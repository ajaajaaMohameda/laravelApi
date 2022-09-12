<?php
namespace App\Repositories;

class UserRepository extends BaseRepository
{

    public function create(array $attributes)
    {
        return  DB::transaction(function() use ($attributes) {
            $comment = DB::query()->create(
                [
                    'name' => data_get($attributes, 'name'),
                    'email' => data_get($attributes, 'email'),
                ]
            );

            return $comment;
        });
    }


    public function update($model, array $attributes)
    {
        return DB::transaction(function() use($attributes, $model) {
            $updated = $model->update([
                'name' => data_get($attributes, 'name', $model->name),
                'email' => data_get($attributes, 'email', $model->email),
            ]);

            throw_if(!$updated, GeneralJsonException::class, 'Failed to update');

            return $model;
        });
    }


    public function forceDelete($model)
    {
        return DB::transaction(function() use ($model) {

            $deleted = $mode->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Failed to deleted');

            return $deleted;
        })
    }
}