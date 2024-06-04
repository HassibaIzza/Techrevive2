<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function getMessage(Request $request)
    {
        $getMesg = $request->input('text');
        $result = DB::table('bot')
                    ->where('queries', 'like', '%' . $getMesg . '%')
                    ->pluck('replies');

        if ($result->isNotEmpty()) {
            return response()->json(['reply' => $result[0]]);
        } else {
            return response()->json(['reply' => "Sorry, I can't understand you!"]);
        }
    }

    public function getQueries()
    {
        $queries = DB::table('bot')->pluck('queries');
        return response()->json(['queries' => $queries]);
    }
}
