<?php

namespace App\Models {
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Task extends Model
    {
        protected $fillable = [
            'description',
            'category_id',
            'exemptable',
            'price',
            'name',
        ];

        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }
    }
}
