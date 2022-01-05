<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnershipProposalRequest;
use App\Http\Requests\UpdatePartnershipProposalRequest;
use App\Http\Resources\PartnershipProposalResource;
use App\Models\PartnershipProposal;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
     * @param StorePartnershipProposalRequest $request
     * @return PartnershipProposalResource|JsonResponse
     */
    public function store(StorePartnershipProposalRequest $request): PartnershipProposalResource|JsonResponse
    {
        $partnershipProposal = new PartnershipProposal();

        $userProposalsCount = PartnershipProposal::query()
            ->where('user_id', auth()->user()->id)
            ->where('type', $request->type)
            ->count();

        if ($userProposalsCount > 0) {
            return response()->json([
                'message' => 'У вас уже есть заявка на ' . $partnershipProposal->types[$request->type]
            ], 400);
        }

        $partnershipProposal->user_id = auth()->user()->id;
        $partnershipProposal->passport_front_side = $request->passport_front_side;
        $partnershipProposal->passport_back_side = $request->passport_back_side;
        $partnershipProposal->selfie_with_passport = $request->selfie_with_passport;
        $partnershipProposal->type = $request->type;

        if (!$partnershipProposal->save()) {
            return response()->json([
                'message' => 'Произошла ошибка создании запроса проверте данные'
            ], 400);
        }

        return new PartnershipProposalResource($partnershipProposal);
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
     * @param UpdatePartnershipProposalRequest $request
     * @param int $id
     * @return PartnershipProposalResource|JsonResponse
     */
    public function update(UpdatePartnershipProposalRequest $request, int $id): PartnershipProposalResource|JsonResponse
    {
        $partnershipProposal = PartnershipProposal::query()
            ->where('user_id', auth()->user()->id)
            ->where('id', $id);

        $values = [
            'passport_front_side' => $request->passport_front_side,
            'passport_back_side' => $request->passport_back_side,
            'selfie_with_passport' => $request->selfie_with_passport,
            'type' => $request->type
        ];

        if (!$partnershipProposal->update($values)) {
            return response()->json([
                'message' => 'Произошла ошибка обновлении запроса проверте данные'
            ], 400);
        }

        return new PartnershipProposalResource($partnershipProposal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $partnershipProposal = PartnershipProposal::query()
            ->where('id', $id);

        $values = ['status' => 'canceled'];

        if (!$partnershipProposal->update($values)) {
            return response()->json([
                'message' => 'Произошла ошибка отмене запроса проверте данные'
            ], 400);
        }

        return response()->json([
            'message' => 'Запрос успешно отменён'
        ]);

    }
}
