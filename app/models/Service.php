<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Service extends Eloquent {
    
    protected $table = 'service';
    
    public function profession() {
    	return $this->belongsTo('Profession', 'profession_id');
    }
}
