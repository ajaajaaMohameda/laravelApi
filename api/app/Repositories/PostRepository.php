<?php
namespace App\Repositories;

use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function() use($attributes) {
            $post = Post::query()->create([
                'name' => data_get($attributes, 'name', 'untitled'),
                'body' => data_get($attributes, 'body')
            ]);
            event(new PostCreated($post));
            if($user_ids = data_get($attributes, 'user_ids')) {
            $post->users()->sync($user_ids);
            }



            return $post;
        });

    }

    public function update($model, array $attributes)
    {
        return DB::transaction(function() use($attributes, $model) {
           $updated  = $model->update([
            'name' => data_get($attributes, 'name', $model->name),
            'body' => data_get($attributes, 'body', $model->body)
           ]);

           event(new PostUpdated($post));
           throw_if(!$updated, GeneralJsonException::class, 'Failed to update');


           if($user_ids = data_get($attributes, 'user_ids')) {
            $post->users()->sync($user_ids);
           }

           return $post;
        });
    }

    public function forceDelete($model)
    {
        
        return DB::transaction(function() use($model) {
            $deleted = $model->forceDelete();

            event(new PostDeleted($post));
            throw_if(!$deleted, GeneralJsonException::class, 'Failed to delete');



            return $deleted;
        })
    }
}