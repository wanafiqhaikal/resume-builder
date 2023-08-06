<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = 'work_experiences';
    protected $fillable = ['company', 'position', 'resume_id'];

    // Define the inverse one-to-many relationship with Resume
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
