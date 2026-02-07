<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = [
	'title',
	'content',
	'photo_path',
	'entry_date',
   ];

    protected $casts = [
	'entry_date' => 'datetime',
   ];
}
