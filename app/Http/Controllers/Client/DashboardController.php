<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        // Chatbot data
        $questions = Chatbot::select('ChatbotID', 'Question')->get();

        return view('client.dashboard', compact( 'title', 'questions'));
    }

    
}