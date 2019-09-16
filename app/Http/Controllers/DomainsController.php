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
        $domain = new Domain();
        $domain->name = $request->get('name');
        $domain->save();

        Queue::push(new DomainJob($domain));

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
