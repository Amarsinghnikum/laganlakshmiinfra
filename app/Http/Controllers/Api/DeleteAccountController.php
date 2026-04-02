<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeleteAccountController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'password' => ['required', 'string'],
            'reason'   => ['nullable', 'string', 'max:500'],
        ]);

        if (! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid password',
            ], 401);
        }

        DB::transaction(function () use ($user, $data) {
            if (!empty($data['reason'])) {
                DB::table('account_deletion_feedback')->insert([
                    'user_id'    => $user->id,
                    'reason'     => $data['reason'],
                    'created_at' => now(),
                ]);
            }

            // revoke tokens (Sanctum)
            if (method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }

            // delete user (soft delete if SoftDeletes is on the model)
            $user->delete();
        });

        return response()->json([
            'status'  => true,
            'message' => 'Account deleted',
        ]);
    }
}
