<?php

namespace App\Http\Controllers;

use App\Jobs\DomainJob;
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

        $domain = Domain::create(['name' => $request->get('name')]);
        Queue::push(new DomainJob($domain));

        return redirect(route('domains.show', ['id' => $domain->id]));
    }

    public function show(int $domainId)
    {
        $domain = Domain::find($domainId);
        return view('info', [
            'domain' => $domain
        ]);
    }

    public function index()
    {
        $domains = Domain::paginate(15);
        return view('list', [
            'domains' => $domains
        ]);
    }
}
