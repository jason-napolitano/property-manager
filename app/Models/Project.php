<?php

namespace App\Models {
    use Illuminate\Database\Eloquent;
    use Znck\Eloquent\Relations;
    use Znck\Eloquent\Traits;

    class Project extends Model
    {
        use Traits\BelongsToThrough;

        protected $fillable = [
            'scheduled_at',
            'completed_at',
            'employee_id',
            'property_id',
            'building_id',
            'notes',
            'name',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            // ...
        ];

        public function property(): Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(Property::class);
        }

        public function building(): Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(Building::class);
        }

        public function employee(): Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(User::class, 'employee_id');
        }

        public function client(): Relations\BelongsToThrough
        {
            return $this->belongsToThrough(User::class, Property::class, 'client_id');
        }
    }
}
