<?php

namespace App;

use Finite\Loader\ArrayLoader;
use Finite\StatefulInterface;
use Finite\StateMachine\StateMachine;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model implements StatefulInterface
{

    public $timestamps = true;
    private $stateMachine;

    public function __construct()
    {
        $this->stateMachine = new StateMachine();
        $loader = new ArrayLoader($this->stateMachineConfig());
        $loader->load($this->stateMachine);
        $this->stateMachine->setObject($this);
        $this->stateMachine->initialize();
    }

    protected function stateMachineConfig()
    {
        return [
            'class'  => 'DomainState',
            'states' => [
                'initial'    => ['type' => 'initial', 'properties' => []],
                'pending' => ['type' => 'normal',  'properties' => []],
                'failed' => ['type' => 'final',   'properties' => []],
                'completed'  => ['type' => 'final',   'properties' => []],
            ],
            'transitions' => [
                'run' => ['from' => ['initial'],    'to' => 'pending'],
                'failure'  => ['from' => ['pending'], 'to' => 'failed'],
                'success'  => ['from' => ['pending'], 'to' => 'completed'],
            ]
        ];
    }

    /**
     * Gets the object state.
     *
     * @return string
     */
    public function getFiniteState()
    {
        return $this->state;
    }

    /**
     * Sets the object state.
     *
     * @param string $state
     */
    public function setFiniteState($state)
    {
        $this->state = $state;
    }

    public function transition($transitionName)
    {
        $this->stateMachine->apply($transitionName);
    }
}
