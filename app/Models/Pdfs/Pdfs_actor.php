<?php

namespace App\Models\Pdfs;

use Illuminate\Database\Eloquent\Model;

class Pdfs_actor extends Model
{
    protected $table = 'actor';

	protected $primaryKey = 'actor_id';

	protected $fillable = [
        'actor_id', 'first_name', 'last_name', 'last_update',
    ];
}
