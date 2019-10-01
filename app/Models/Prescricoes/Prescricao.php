<?php

namespace App\Models\Prescricoes;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelDefault;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescricao extends ModelDefault
{
    //
    use SoftDeletes;
}
