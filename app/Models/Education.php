<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = ['institution', 'degree', 'resume_id'];

    // Define the inverse one-to-many relationship with Resume
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
