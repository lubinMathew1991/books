<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarksRequest;
use App\Http\Requests\UpdateMarksRequest;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::with('students', 'marks', 'marks.subject')
                    ->orderBy('student_id')
                    ->orderBy('id', 'desc')
                    ->get()->toArray();
        $subjects = Subject::all();

        return view('exams.index', compact('exams', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('exams.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarksRequest $request)
    {
        $exam = [
                    'student_id' => $request->student,
                    'term' => $request->term,
                ];

        $exam = Exam::create($exam);

        foreach ($request->mark as $markKey => $mark) {
            $marks = [
                        'exam_id' => $exam->id,
                        'subject_id' =>  $markKey,
                        'mark' => $mark,
                    ];
            Mark::create($marks);
        }
        return redirect()->route('exams.index')->with('success','Mark added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $mark = $exam->marks->toArray();
        $students = Student::all();
        $subjects = Subject::all();
        return view('exams.edit', compact('students', 'subjects', 'exam', 'mark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarksRequest $request, Exam $exam)
    {
        $examData = [
            'student_id' => $request->student,
            'term' => $request->term,
        ];

        $exam->update($examData);

        $exam->marks()->delete();

        foreach ($request->mark as $markKey => $mark) {
            $marks = [
                        'exam_id' => $exam->id,
                        'subject_id' =>  $markKey,
                        'mark' => $mark,
                    ];
            Mark::create($marks);
        }

        return redirect()->route('exams.index')->with('success','Mark updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        $exam->marks()->delete();
        return redirect()->route('exams.index')->with('success','Exam deleted successfully!');
    }
}
