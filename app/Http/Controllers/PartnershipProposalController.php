<?php

namespace App\Http\Controllers;

use App\Http\Resources\PartnershipProposalResource;
use App\Models\PartnershipProposal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PartnershipProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $partnershipProposals = PartnershipProposal::paginate(20);
        return PartnershipProposalResource::collection($partnershipProposals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PartnershipProposalResource
     */
    public function show(int $id): PartnershipProposalResource
    {
        $partnershipProposal = PartnershipProposal::with('user')->findOrFail($id);
        return new PartnershipProposalResource($partnershipProposal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
