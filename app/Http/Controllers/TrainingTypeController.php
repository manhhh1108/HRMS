<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingType;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Log;

class TrainingTypeController extends Controller
{
    /** Index page for training types */
    public function index()
    {
        $training_type = DB::table('training_types')->get();
        Log::info("type::" . json_encode($training_type));
        return view('trainingType.trainingType', compact('training_type'));
       
    }
    


    /** Save a new training type record */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'type'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status'      => 'required|string|max:255',
        ]);

        try {
            $trainingType = new TrainingType;
            $trainingType->type        = $request->type;
            $trainingType->description = $request->description;
            $trainingType->status      = $request->status;
            $trainingType->save();

            flash()->success('Created new Training Type successfully :)');
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Failed to add Training Type :)');
            return redirect()->back();
        }
    }

    /** Update a training type record */
    public function updateRecord(Request $request)
    {
        $request->validate([
            'id'          => 'required|integer|exists:training_types,id',
            'type'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status'      => 'required|string|max:255',
        ]);

        try {
            $trainingType = TrainingType::findOrFail($request->id);
            $trainingType->type        = $request->type;
            $trainingType->description = $request->description;
            $trainingType->status      = $request->status;
            $trainingType->save();

            flash()->success('Updated Training Type successfully :)');
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Failed to update Training Type :)');
            return redirect()->back();
        }
    }

    /** Delete a training type record */
    public function deleteTrainingType(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:training_types,id']);

        try {
            $trainingType = TrainingType::findOrFail($request->id);
            $trainingType->delete(); // Xóa bản ghi

            flash()->success('Training Type deleted successfully :)');
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Failed to delete Training Type :)');
            return redirect()->back();
        }
    }
}
