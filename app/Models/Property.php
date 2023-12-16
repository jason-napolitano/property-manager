<?php

namespace App\Models {
    use Askedio\SoftCascade\Traits\SoftCascadeTrait;
    use Illuminate\Database\Eloquent;

    class Property extends Model
    {
        use SoftCascadeTrait;

        protected $softCascade = ['buildings', 'projects'];

        protected $fillable = [
            'description',
            'client_id',
            'address',
            'phone',
            'name',
        ];

        public function client(): Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function clients(): Eloquent\Relations\HasMany
        {
            return $this->hasMany(User::class, 'id', 'client_id');
        }

        public function buildings(): Eloquent\Relations\HasMany
        {
            return $this->hasMany(Building::class);
        }

        public function projects(): Eloquent\Relations\HasMany
        {
            return $this->hasMany(Project::class);
        }
    }
}
