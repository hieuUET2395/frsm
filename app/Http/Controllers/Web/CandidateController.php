<?php

namespace App\Http\Controllers\Web;

use App\Repositories\Contracts\CandidateRepositoryInterface as CandidateRepository;
use App\Repositories\Contracts\PositionRepositoryInterface as PositionRepository;
use App\Models\Contracts\PositionInterface as Position;
use App\Repositories\Criteria\Candidate\DateCriteria;
use App\Repositories\Criteria\Candidate\NameCriteria;
use App\Repositories\Criteria\Candidate\EmailCriteria;
use App\Repositories\Criteria\Candidate\PhoneCriteria;
use App\Repositories\Criteria\Candidate\PositionCriteria;
use App\Repositories\Criteria\Candidate\StatusCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateController extends Controller
{
    private $candidateRepository;
    private $positionRepository;

    /**
     *
     * CandidateController constructor.
     * @param CandidateRepository $candidateRepository
     * @param PositionRepository $positionRepository
     *
     */
    public function __construct(CandidateRepository $candidateRepository, PositionRepository $positionRepository)
    {
        $this->candidateRepository = $candidateRepository;
        $this->positionRepository = $positionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = $this->candidateRepository->paginate(setting('paginate'));
        $positions = $this->positionRepository->findAllBy('type', Position::TYPE_CANDIDATE)->pluck('name', 'id');
        $statuses = config('custom.status');

        return view('web.candidate.index', compact('candidates', 'positions', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO
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
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO
    }

    /**
     * Filter list of candidates.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        if ($request->input('resetFilters') == 0) {
            $this->candidateRepository->pushCriteria(new NameCriteria($request->input('name')))
                ->pushCriteria(new EmailCriteria($request->input('email')))
                ->pushCriteria(new PositionCriteria($request->input('position')))
                ->pushCriteria(new StatusCriteria($request->input('status')))
                ->pushCriteria(new PhoneCriteria($request->input('phone')))
                ->pushCriteria(new DateCriteria($request->input('date')));
        }

        $candidates = $this->candidateRepository->paginate(setting('paginate'));

        return view('web.candidate.filter', compact('candidates'));
    }
}
