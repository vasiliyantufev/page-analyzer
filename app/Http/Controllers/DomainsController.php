<?php

namespace App\Http\Controllers;

use App\Jobs\DomainJob;

use Finite\Loader\ArrayLoader;
use Finite\StateMachine\StateMachine;
use Illuminate\Http\Request;
use App\Domain;
use Illuminate\Support\Facades\Queue;


class DomainsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|url'
        ]);

        $stateMachine = new StateMachine();
        $loader = new ArrayLoader(config('machine_states'));
        $loader->load($stateMachine);

        $domain = Domain::create(['name' => $request->get('name')]);
        $stateMachine->setObject($domain);

        $stateMachine->initialize();

        Queue::push(new DomainJob($domain, $stateMachine));

        return redirect(route('domains.show', ['id' => $domain->id]));
    }

    public function show(int $domainId)
    {
        $domain = Domain::find($domainId);
        return view('domains.show', [
            'domain' => $domain
        ]);
    }

    public function index()
    {
        $domains = Domain::paginate(10);
        return view('domains.index', [
            'domains' => $domains
        ]);
    }
}
