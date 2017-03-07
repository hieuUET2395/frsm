<?php
namespace App\Repositories\Eloquent;

use App\Models\Candidate;
use App\Repositories\Contracts\CandidateRepositoryInterface;

class CandidateRepository extends Repository implements CandidateRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Candidate::class;
    }
}
