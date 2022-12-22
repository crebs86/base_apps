<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

trait Helpers
{
    function resetCache()
    {
    }

    function auditable($key)
    {
        return json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
            return Setting::where('name', 'general')->first();
        })->settings)->saveUpdates->$key[1];
    }

    function saveUpdates(object|array $before, object $after, string $classModel, array $columns): void
    {
        $model = new $classModel;
        $b = is_array($before) ? $before['id'] : $before->id;
        if ($model instanceof Model && $after->id === $b) {
            $m = $model->find($after->id);
            if ($m) {
                $m->update(
                    [
                        'updates' => array_merge_recursive(
                            [
                                'user_id' => auth()->id(),
                            ],
                            json_decode(
                                $m->updates,
                                true
                            ),
                            collect($after->toArray())->only($columns)->all()
                        ),
                        'updated_at' => now()
                    ]
                );
            } else {
                $model->create([
                    'id' => $after->id,
                    'updates' => json_encode(
                        array_merge_recursive(
                            [
                                'user_id' => auth()->id(),
                            ],
                            [
                                'user_id' => 0,
                            ],
                            !is_array($before) ? collect($before->toArray())->only($columns)->all() : collect($before)->only($columns)->all(),
                            collect($after->toArray())->only($columns)->all()
                        )
                    ),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
