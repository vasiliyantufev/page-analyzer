<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public $timestamps = true;
    protected $fillable = ['name'];
    protected $state;

    public function initialize()
    {
        $this->state = config('states.STATE_INITIALIZE');
    }

    public function pending()
    {
        $this->state = config('states.STATE_PENDING');
    }

    public function failed()
    {
        $this->state = config('states.STATE_FAILED');
    }

    public function completed()
    {
        $this->state = config('states.STATE_COMPLETED');
    }

    public function getState()
    {
        return $this->state;
    }
}
