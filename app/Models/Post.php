<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
<<<<<<< HEAD
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    /**
=======
>>>>>>> dbc256aa08e4cdbf88a45dffd0e2386e93cea2ab
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'video',
        'user_id',
        'description',
    ];

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function UserPost()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
