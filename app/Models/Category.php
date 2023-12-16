<?php

namespace App\Models {
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Dyrynda\Database\Support\CascadeSoftDeletes;

    class Category extends Model
    {
        use CascadeSoftDeletes;

        protected $cascadeDeletes = ['tasks'];

        protected $fillable = [
            'description',
            'name',
        ];

        public function tasks(): HasMany
        {
            return $this->hasMany(Task::class);
        }
    }
}
