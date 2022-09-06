<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

       return view('question.index', ['questions' => auth()->user()->question->all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',
            'content'=> 'required'
        ]);


        $question = $request->user()->question()->create($request->all());

        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Question $question )
    {
        if($request->user()->id != $question->user_id){

            abort(403);
        }

        dd($request);

       return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Question $question)
    {

        if($request->user()->id != $question->user_id){

            abort(403);
        }

        return view('question.edit', compact('question')); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        if($request->user()->id != $question->user_id){

            abort(403);
        }

        $question->update($request->all());

        return redirect()->route("question.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question)
    {

        if($request->user()->id != $question->user_id){

            abort(403);
        }

      $response = $question->delete(); 
    
      return redirect()->route('question.index');

    }
}
