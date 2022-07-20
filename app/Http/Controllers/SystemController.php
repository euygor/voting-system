<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function __construct()
    {
        $polls = Poll::all();

        foreach ($polls as $poll) {
            $iniciada = strtotime($poll->date_start) > strtotime(date('Y-m-d H:i:s'));
            $andamento = strtotime($poll->date_start) < strtotime(date('Y-m-d H:i:s')) && strtotime($poll->date_end) > strtotime(date('Y-m-d H:i:s'));
            $finalizada = strtotime(date('Y/m/d H:i:s')) > strtotime($poll->date_end);

            if ($iniciada) {
                $poll->status = 'Não iniciada';
            }

            if ($andamento) {
                $poll->status = 'Em andamento';
            }

            if ($finalizada) {
                $poll->status = 'Finalizada';
            }

            $poll->save();
        }
    }

    public function index()
    {
        $polls = Poll::orderBy('id', 'desc')->paginate(5);

        return view('index', ['polls' => $polls]);
    }

    public function create()
    {
        return view('create-poll');
    }

    public function createAction(PollRequest $request)
    {
        $request->validated();

        $dados = $request->only(['poll-title', 'poll-op-1', 'poll-op-2', 'poll-op-3', 'poll-date-start', 'poll-date-end']);

        $poll = Poll::create([
            'title' => ucwords($dados['poll-title']),
            'option1' => ucwords($dados['poll-op-1']),
            'option2' => ucwords($dados['poll-op-2']),
            'option3' => ucwords($dados['poll-op-3']),
            'date_start' => $dados['poll-date-start'],
            'date_end' => $dados['poll-date-end'],
        ]);

        Vote::create([
            'poll_id' => $poll->id,
            'option1' => 0,
            'option2' => 0,
            'option3' => 0,
        ]);

        return redirect()->route('index')->with('success', 'Enquete cadastrada com sucesso!');
    }

    public function update($id)
    {
        $poll = Poll::find($id);

        if (!$poll) {
            return redirect()->route('index')->with('error', 'Enquete não encontrada!');
        }

        return view('update-poll', ['poll' => $poll]);
    }

    public function updateAction(PollRequest $request)
    {
        $request->validated();

        $dados = $request->only(['poll-id', 'poll-title', 'poll-op-1', 'poll-op-2', 'poll-op-3', 'poll-date-start', 'poll-date-end']);

        $poll = Poll::find($dados['poll-id']);

        if (!$poll) {
            return redirect()->route('index')->with('error', 'Enquete não encontrada!');
        }

        if ($dados['poll-title']) {
            $poll->title = ucwords($dados['poll-title']);
        }

        if ($dados['poll-op-1']) {
            $poll->option1 = ucwords($dados['poll-op-1']);
        }

        if ($dados['poll-op-2']) {
            $poll->option2 = ucwords($dados['poll-op-2']);
        }

        if ($dados['poll-op-3']) {
            $poll->option3 = ucwords($dados['poll-op-3']);
        }

        if ($dados['poll-date-start']) {
            $poll->date_start = $dados['poll-date-start'];
        }

        if ($dados['poll-date-end']) {
            $poll->date_end = $dados['poll-date-end'];
        }

        $poll->save();

        return redirect()->route('update', ['id' => $poll->id])->with('success', 'Enquete atualizada com sucesso!');
    }

    public function view($id)
    {
        $poll = Poll::find($id);
        $votes = Vote::where('poll_id', $id)->first();

        if (!$poll || !$votes) {
            return redirect()->route('index')->with('error', 'Enquete não encontrada!');
        }

        return view('view-poll', ['poll' => $poll, 'votes' => $votes]);
    }

    public function viewAction(Request $request)
    {
        $id = $request->input('poll-id');
        $op1 = $request->only(['poll-op-1']);
        $op2 = $request->only(['poll-op-2']);
        $op3 = $request->only(['poll-op-3']);

        $poll = Poll::find($id);

        if (!$poll) {
            return redirect()->route('index')->with('error', 'Enquete não encontrada!');
        }

        $vote = Vote::where('poll_id', $poll->id)->first();

        if (!$vote) {
            return redirect()->route('index')->with('error', 'Enquete não encontrada!');
        }

        if ($op1 && $op1['poll-op-1'] == '1') {
            $vote->option1 = $vote->option1 + 1;
        }

        if ($op2 && $op2['poll-op-2'] == '2') {
            $vote->option2 = $vote->option2 + 1;
        }

        if ($op3 && $op3['poll-op-3'] == '3') {
            $vote->option3 = $vote->option3 + 1;
        }

        $iniciada = strtotime($poll->date_start) > strtotime(date('Y-m-d H:i:s'));
        $finalizada = strtotime(date('Y/m/d H:i:s')) > strtotime($poll->date_end);

        if ($iniciada) {
            return redirect()->route('view', ['id' => $poll->id])->with('warning', 'Enquete ainda não iniciada!');
        }

        if ($finalizada) {
            return redirect()->route('view', ['id' => $poll->id])->with('error', 'Enquete finalizada!');
        }

        $vote->save();

        return redirect()->route('view', ['id' => $poll->id])->with('success', 'Voto computado com sucesso!');
    }

    public function delete($id)
    {
        $poll = Poll::find($id);

        if ($poll) {
            $poll->delete();

            $vote = Vote::where('poll_id', $id)->first();
            $vote->delete();

            return redirect()->route('index')->with('success', 'Enquete excluída com sucesso!');
        }
        return redirect()->route('index')->with('error', 'Enquete não encontrada!');
    }
}
