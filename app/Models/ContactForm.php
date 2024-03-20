<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactForm extends Model
{
    use HasFactory;

    function job(): HasOne {
        return $this->hasOne(Job::class);
    }
}
