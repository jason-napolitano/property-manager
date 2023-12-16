<?php

namespace App\Models {
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Concerns\HasUuids;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Notifications\Notifiable;
    use Spatie\Permission\Traits\HasRoles;
    use Illuminate\Foundation\Auth\User;
    use Laravel\Sanctum\HasApiTokens;

    /**
     * @method static create(array $data)
     * @method static paginate(int $x)
     */
    class Authenticatable extends User
    {
        use HasApiTokens;
        use SoftDeletes;
        use Notifiable;
        use HasFactory;
        use HasRoles;
        use HasUuids;
    }
}
