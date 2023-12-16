<?php

namespace App\Models {
    use Illuminate\Database\Eloquent;
    use Znck\Eloquent\Relations;
    use Znck\Eloquent\Traits;

    class Building extends Model
    {
        use Traits\BelongsToThrough;

        protected $fillable = [
            'description',
            'property_id',
            'units',
            'name',
        ];

        public function property(): Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(Property::class);
        }

        public function projects(): Eloquent\Relations\HasMany
        {
            return $this->hasMany(Project::class);
        }

        public function client(): Relations\BelongsToThrough
        {
            return $this->belongsToThrough(User::class, Property::class, 'client_id');
        }
    }
}
