<?php

namespace Database\Seeders;

use App\Http\Resources\AttributeGroupResource;
use App\Models\Faq;
use App\Models\PartnershipProposal;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $users = User::factory(10)->create();
        $posts = Post::factory(50)->create();
        $faqs = Faq::factory(50)->create();

        $this->createPartnershipProposalsForUsers($users);
        $this->call(CountryCodeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(AttributeGroupSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(OrderSeeder::class);
    }

    private function createPartnershipProposalsForUsers($users): void
    {
        $users->each(function ($user){
            $partnershipProposal = PartnershipProposal::factory(1)->create(['user_id' => $user->id]);
            $partnershipProposalId = $partnershipProposal->pluck('id')[0];
            $user->partnership_proposal_id = $partnershipProposalId;
            $user->save();
        });
    }
}
