<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    //
    public function blockUser(Request $request)
    {
        $user = auth()->user();
        $block = $user->block()->create([
            'blocked_user_id' => $request->get('blocked_user_id'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'User blocked successfully',
            'data' => $block
        ], 200);
    }

    public function unblockUser(Request $request)
    {
        $user = auth()->user();
        $block = $user->block()->where('blocked_user_id', $request->get('blocked_user_id'))->first();
        if ($block) {
            // update end date
            $block->update([
                'end_date' => now()
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'User unblocked successfully',
                'data' => $block
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not blocked',
                'data' => null
            ], 200);
        }
    }
}
