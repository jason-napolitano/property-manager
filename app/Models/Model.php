<?php

namespace App\Models {
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model as BaseModel;
    use Illuminate\Database\Eloquent\Concerns\HasUuids;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * @method static where(string $x, string $equals, string|bool|int $y)
     * @method static create(array $data)
     * @method static paginate(int $x)
     */
    class Model extends BaseModel
    {
        use SoftDeletes;
        use HasFactory;
        use HasUuids;
    }
}
