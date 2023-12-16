<?php

namespace App\Models {
    use Illuminate\Database\Eloquent;

    class User extends Authenticatable
    {
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'first_name',
            'last_name',
            'password',
            'email',
            'phone',
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'email_verified_at',
            'remember_token',
            'password',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];

        public function properties(): Eloquent\Relations\HasMany
        {
            return $this->hasMany(Property::class, 'client_id');
        }

        public function projects(): Eloquent\Relations\HasManyThrough
        {
            return $this->hasManyThrough(Project::class, Property::class);
        }
    }
}
