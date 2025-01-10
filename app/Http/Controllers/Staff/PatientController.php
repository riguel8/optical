<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use App\Models\User;
use App\Models\PrescriptionModel;
use App\Models\AmountModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\LOG;
use App\Models\AppointmentModel;



class PatientController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Patients';
        $patients = PatientModel::whereHas('appointments', function($query) {
            $query->where('Status', 'Confirmed');
        })
        ->orWhereHas('prescription', function($query) {
            $query->where('PresStatus', 'Completed');
        })
        ->get();

        return view('staff.patients', compact('patients', 'title'));
    }

    //Function to View Specific Patient
    public function view($id)
    {
        try {
            $patient = DB::table('patients')->where('PatientID', $id)->first();

            if (!$patient) {
                return response()->json(['error' => 'Patient not found'], 404);
            }

            $prescription = DB::table('prescriptions')->where('PatientID', $id)->first();

            $payment = null;

            if ($prescription && $prescription->AmountID) {
                $payment = DB::table('amount')->where('AmountID', $prescription->AmountID)->first();
            } else {
                Log::error("No AmountID found for prescription linked to PatientID: $id");
            }

            return response()->json([
                'patient' => [
                    'complete_name' => $patient->complete_name ?? '',
                    'age' => $patient->age ?? '',
                    'gender' => $patient->gender ?? '',
                    'contact_number' => $patient->contact_number ?? '',
                    'address' => $patient->address ?? '',
                ],
                'prescription' => [
                    'prescription' => $prescription->Prescription ?? 'Not Available',
                    'ODgrade' => $prescription->ODgrade ?? '',
                    'OSgrade' => $prescription->OSgrade ?? '',
                    'OUgrade' => $prescription->OUgrade ?? '',
                    'lens' => $prescription->Lens ?? '',
                    'lens_type' => $prescription->LensType ?? '',
                    'frame' => $prescription->Frame ?? '',
                    'ADD' => $prescription->ADD ?? '',
                    'PD' => $prescription->PD ?? '',
                ],
                'payment' => [
                    'total_amount' => $payment->TotalAmount ?? 'Not Available',
                    'deposit' => $payment->Deposit ?? 'Not Available',
                    'balance' => $payment->Balance ?? 'Not Available',
                    'mode_of_payment' => $payment->MOP ?? 'Not Available',
                    'status' => $payment->Payment ?? 'Not Available',
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching data for PatientID: $id", ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Data not found', 'exception' => $e->getMessage()], 404);
        }
    }
    

    // Function to Fetch data to the modal
    public function edit($id)
    {
        $patient = PatientModel::findOrFail($id);
        $prescription = PrescriptionModel::where('PatientID', $id)->first();
        $amount = $prescription ? AmountModel::find($prescription->AmountID) : null;
        $appointment = AppointmentModel::where('PatientID', $id)->first();

        return response()->json([
            'patient' => $patient,
            'prescription' => $prescription ?? (object)[
                'PrescriptionID' => null,
                'Prescription' => null,
                'ODgrade' => null,
                'OSgrade' => null,
                'OUgrade' => null,
                'Lens' => null,
                'LensType' => null,
                'Frame' => null,
                'ADD' => null,
                'PD' => null,
                'PrescriptionDetails' => null,
            ],
            'amount' => $amount ?? (object)[
                'AmountID' => null,
                'TotalAmount' => null,
                'Deposit' => null,
                'MOP' => null,
                'Balance' => null,
                'Payment' => null,
            ],
            'appointment' => $appointment ?? (object)[
                'AppointmentID' => null,
            ],
        ]);
    }
    
    
    

    //Function to Update the Appointment
    public function update(Request $request)
    {
        try {
            $patient = PatientModel::findOrFail($request->edit_patientId);
            $patient->update([
                'complete_name' => $request->edit_name,
                'gender' => $request->edit_gender,
                'age' => $request->edit_age,
                'contact_number' => $request->edit_contact,
                'address' => $request->edit_address,
            ]);

            $amount = AmountModel::updateOrCreate(
                ['AmountID' => $request->edit_amountId],
                [
                    'TotalAmount' => $request->edit_totalAmount,
                    'Deposit' => $request->edit_deposit,
                    'MOP' => $request->edit_modeOfPayment,
                    'Balance' => $request->edit_balance,
                    'Payment' => $request->edit_status,
                ]
            );

            $prescription = PrescriptionModel::updateOrCreate(
                ['PrescriptionID' => $request->edit_prescriptionId],
                [
                    'PatientID' => $patient->PatientID,
                    'AmountID' => $amount->AmountID,
                    'DoctorID' => auth()->id(),
                    'Prescription' => $request->edit_prescription,
                    'ODgrade' => $request->edit_ODgrade,
                    'OSgrade' => $request->edit_OSgrade,
                    'OUgrade' => $request->edit_OUgrade,
                    'Lens' => $request->edit_lens,
                    'LensType' => $request->edit_lensType,
                    'Frame' => $request->edit_frame,
                    'ADD' => $request->edit_add,
                    'PD' => $request->edit_pd,
                    'PrescriptionDetails' => $request->edit_prescriptionDetails,
                ]
            );

            if ($request->edit_appointmentId) {
                $appointment = AppointmentModel::find($request->edit_appointmentId);

                if ($appointment) {
                    $appointment->update([
                        'Status' => 'Completed',
                    ]);
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'The patient details and prescriptions have been successfully updated.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update patient details. Please try again later.',
            ]);
        }
    }


    // Function to Store Walk-in Patients
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|integer',
            'contact' => 'required|string',
            'address' => 'required|string',
            'prescription' => 'required|string',
            'lens' => 'nullable|string',
            'lensType' => 'nullable|string',
            'frame' => 'nullable|string',
            'add' => 'nullable|string',
            'pd' => 'nullable|string',
            'ODgrade' => 'nullable|string',
            'OSgrade' => 'nullable|string',
            'OUgrade' => 'nullable|string',
            'prescriptionDetails' => 'required|string',
            'totalAmount' => 'required|numeric',
            'deposit' => 'required|numeric',
            'modeOfPayment' => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request, $validated) {
                $patient = PatientModel::create([
                    'complete_name' => $validated['name'],
                    'gender' => $validated['gender'],
                    'age' => $validated['age'],
                    'contact_number' => $validated['contact'],
                    'address' => $validated['address'],
                ]);

                $amount = AmountModel::create([
                    'TotalAmount' => $validated['totalAmount'],
                    'Deposit' => $validated['deposit'],
                    'MOP' => $validated['modeOfPayment'],
                    'Balance' => $validated['totalAmount'] - $validated['deposit'],
                    'Payment' => ($validated['totalAmount'] - $validated['deposit']) > 0 ? 'Partial' : 'Paid',
                ]);

                PrescriptionModel::create([
                    'Prescription' => $validated['prescription'],
                    'OUgrade' => $request->OUgrade,
                    'ODgrade' => $request->ODgrade,
                    'OSgrade' => $request->OSgrade,
                    'Lens' => $validated['lens'],
                    'LensType' => $validated['lensType'],
                    'Frame' => $validated['frame'],
                    'ADD' => $validated['add'],
                    'PD' => $validated['pd'],
                    'PrescriptionDetails' => $validated['prescriptionDetails'],
                    'PatientID' => $patient->PatientID,
                    'DoctorID' => auth()->id(),
                    'AmountID' => $amount->AmountID,
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'The patient and prescription details have been successfully saved.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while saving the patient details. Please try again.',
            ]);
        }
    }
}