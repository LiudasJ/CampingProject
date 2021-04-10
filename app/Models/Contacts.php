<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    public function store ($data) {

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->question = $data['question'];
        $this->save();

    }
}
