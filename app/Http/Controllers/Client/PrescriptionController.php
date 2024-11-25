<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use App\Models\AppointmentModel;
use App\Models\PrescriptionModel;
use Illuminate\Support\Facades\DB;
use App\Models\AmountModel;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $title = 'Prescription';

        $userId = Auth::id();

        // Fetch prescriptions with related appointment and patient info
        $prescriptions = PrescriptionModel::with(['patient', 'appointment'])
            ->whereHas('appointment', function ($query) use ($userId) {
                $query->where('StaffID', $userId)->where('Status', 'Completed');
            })
            ->where('PresStatus', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get();

        $questions = Chatbot::select('ChatbotID', 'Question')->get();

        return view('client.prescription', compact('title', 'questions', 'prescriptions'));
    }

    public function show($id)
    {
        try {
            // Fetch the prescription by ID with related patient and amount
            $prescription = PrescriptionModel::with(['patient', 'amount'])->findOrFail($id);

            // Prepare the data to return
            $data = [
                'patient' => [
                    'complete_name' => $prescription->patient->complete_name ?? 'N/A',
                    'age' => $prescription->patient->age ?? 'N/A',
                    'gender' => $prescription->patient->gender ?? 'N/A',
                    'contact_number' => $prescription->patient->contact_number ?? 'N/A',
                    'address' => $prescription->patient->address ?? 'N/A',
                ],
                'prescription' => [
                    'prescription' => $prescription->Prescription ?? 'Not Available',
                    'ODgrade' => $prescription->ODgrade ?? 'Not Available',
                    'OSgrade' => $prescription->OSgrade ?? 'Not Available',
                    'OUgrade' => $prescription->OUgrade ?? 'Not Available',
                    'lens' => $prescription->Lens ?? 'Not Available',
                    'lens_type' => $prescription->LensType ?? 'Not Available',
                    'frame' => $prescription->Frame ?? 'Not Available',
                    'ADD' => $prescription->ADD ?? 'Not Available',
                    'PD' => $prescription->PD ?? 'Not Available',
                ],
                'payment' => [
                    'total_amount' => $prescription->amount->TotalAmount ?? 'Not Available',
                    'deposit' => $prescription->amount->Deposit ?? 'Not Available',
                    'balance' => $prescription->amount->Balance ?? 'Not Available',
                    'mode_of_payment' => $prescription->amount->MOP ?? 'Not Available',
                    'status' => $prescription->amount->Payment ?? 'Not Available',
                ]
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Prescription not found.'], 404);
        }
    }
}