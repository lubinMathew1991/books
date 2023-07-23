<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use  App\Models\Book;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportBooks;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBooksRequest $request)
    {
        try {
            if ($files = $request->file('cover_image')){  
                $coverImage = $files->getClientOriginalName();  
                $files->move('cover_image', $coverImage);   
            }  
            $data = [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'publication_year' =>  $request->publication_year,
                'cover_image' => $coverImage
            ];
            Book::create($data);
            return redirect()->route('books.index')->with('success', 'Book created successfully!');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $Books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $Books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Books  $Books
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $Books
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBooksRequest $request, Book $book)
    {
        try {
            $coverImage = $book->cover_image;
            if ($files = $request->file('cover_image')){  
                $coverImage = $files->getClientOriginalName();  
                $files->move('cover_image', $coverImage);   
            }  
            $data = [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'publication_year' =>  $request->publication_year,
                'cover_image' => $coverImage
            ];
            $book->update($data);
            return redirect()->route('books.index')->with('success', 'Book updated successfully!');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $Books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','Book deleted successfully!');
    }

    /**
     * import data
     *
     * @param  \App\Models\Books  $Books
     * @return \Illuminate\Http\Response
     */

    public function import()
    {
        return view('books.import');
    }

    /**
     * import data
     *
     * @param  \App\Models\Books  $Books
     * @return \Illuminate\Http\Response
     */

    public function importSave(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            $excelFile = $request->file('excel_file');
            Excel::import(new ImportBooks, $excelFile);
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            session()->flash('import_errors', $failures);
            return redirect()->back();
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


}
