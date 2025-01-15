<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferCode extends Model
{
    use HasFactory;

    public function createTransferCode($referenceId, $user)
    {
        $verificationCodes = VerificationCode::where('registration_token', $user->registration_token)->get();

        $orderNo = 1;

        if (!empty($verificationCodes)) {
            foreach ($verificationCodes as $verificationCode) {
                if ($verificationCode->nature_of_code == "alnum") {

                    $transferCode = generateTransferCode($verificationCode->length, true);
                } else {

                    $transferCode = generateTransferCode($verificationCode->length, false);
                }

                if ($verificationCode->applicable_to == "All") {

                    $transferCodeData = [
                        'uuid'                  => Str::uuid(),
                        'code'                  => $transferCode,
                        'verification_code_id'  => $verificationCode->id,
                        'transfer_reference_id' => $referenceId,
                        'user_id'               => $user->id,
                        'order_no'              => $orderNo++
                    ];

                    TransferCode::create($transferCodeData);
                } elseif ($verificationCode->applicable_to == $user->id) {

                    $transferCodeData = [
                        'uuid'                  => Str::uuid(),
                        'code'                  => $transferCode,
                        'verification_code_id'  => $verificationCode->id,
                        'transfer_reference_id' => $referenceId,
                        'user_id'               => $user->id,
                        'order_no'              => $orderNo++
                    ];

                    TransferCode::create($transferCodeData);
                }
            }
        }
    }
    public function transfer()
    {
        return $this->belongsTo(Transfer::class, 'transfer_reference_id', 'reference_id');
    }

    public function verificationCode()
    {
        return $this->belongsTo(VerificationCode::class);
    }
    public function getTransferVerificationData($referenceId)
    {
        $query = DB::table('transfer_codes')
            ->select('transfer_codes.*', 'transfers.*', 'verification_codes.*')
            ->join('transfers', 'transfers.reference_id', '=', 'transfer_codes.transfer_reference_id')
            ->join('verification_codes', 'verification_codes.id', '=', 'transfer_codes.verification_code_id')
            ->where('transfer_codes.transfer_reference_id', $referenceId)
            ->get();

        return $query;
    }
}
