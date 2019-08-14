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
        $domains = Domains::getDomain($domainId);
        return view('info',[
            'domain' => $domains
        ]);
    }
}
