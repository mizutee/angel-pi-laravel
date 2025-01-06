<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'questions';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'question',
        'type',
    ];

    // Define relationships, if any
    // For example, if a question belongs to a survey
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}