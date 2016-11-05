<?php namespace App\Keen\Transformers;

class AttendanceToGuestCheckedInTransformer extends AbstractTransformer
{
    public function transform()
    {
        $attendance = $this->model;
        return [
            'guest_id' => $attendance->guest->id,
            'need_clothing' => $attendance->services->contains('short_name', 'Clothing'),
            'need_id_card' => $attendance->services->contains('short_name', 'OAM ID'),
        ];
    }
}