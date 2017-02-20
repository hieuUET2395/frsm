<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Criteria\Field\FieldNotEvaluateCriteria;
use App\Repositories\Contracts\ScheduleRepositoryInterface as ScheduleRepository;
use App\Repositories\Contracts\FieldRepositoryInterface as FieldRepository;
use DB;

/*Room interview*/
class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $fieldRepository;

    public function __construct(
        ScheduleRepository $scheduleRepository,
        FieldRepository $fieldRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = $this->scheduleRepository->all();

        return view('web.schedule.index', [
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show room interview.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $schedule = $this->scheduleRepository->find($id);
        $fieldsNotEvaluated = $this->fieldRepository
            ->pushCriteria(new FieldNotEvaluateCriteria($schedule->fields->pluck('id')))
            ->all();

        return view('web.schedule.show', compact('schedule', 'fieldsNotEvaluated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update Score and Info evaluate for candidate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'field.*' => 'required',
        ]);

        DB::beginTransaction();
        try {
             // Update evaluation field
            $inputSchedule = $request->only('evaluation');
            $this->scheduleRepository->update($inputSchedule, $id);
            // Add score for candidate in schedule_field
            $schedule = $this->scheduleRepository->find($id);
            $scoreField = [];
            foreach ($request->field as $key => $value) {
                $scoreField [$key] = ['score' => $value];
            }
            $schedule->fields()->sync($scoreField);
            DB::commit();

            return response()->json([trans('interview.success_update_evaluate')]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([trans('interview.error_update_evaluate')], 500);
        }
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

    public function getEvents(Request $request)
    {
        $schedules = $this->scheduleRepository->findWhere(
            [
                ['time', '>', $request->input('start')],
                ['time', '<', $request->input('end')],
            ]
        );

        $events = $schedules->map(function ($schedule) {

            return [
                'title' => $schedule->candidate->position->name,
                'start' => $schedule['time'],
                'description' => $schedule['description'],
                'room' => $schedule->room->name,
                'round' => $schedule->round->name,
                'roomUrl' => action('Web\ScheduleController@show', $schedule->id),
                'candidateName' => $schedule->candidate->name,
                'candidateUrl' => '#', //TODO: link to candidate profile
            ];
        });

        return $events->all();
    }
}
