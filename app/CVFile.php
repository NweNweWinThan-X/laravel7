<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CVFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cv_info';

    protected $fillable = [
        'name', 'age', 'sex', 'email', 'phone'
    ];
}
