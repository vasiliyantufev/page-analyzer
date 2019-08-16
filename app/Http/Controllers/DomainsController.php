<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains;

class DomainsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Request $request)
    {
        $idDomain = Domains::createDomain($request->get('name'));
        return redirect('domains/'.$idDomain);
    }

    public function show(int $domainId)
    {
        $domain = Domains::getDomain($domainId);
        return view('info',[
            'domain' => $domain
        ]);
    }

    public function all()
    {
        $domains = Domains::getAllDomains();
        return view('list',[
            'domains' => $domains
        ]);
//        dd($domains);
    }
}
