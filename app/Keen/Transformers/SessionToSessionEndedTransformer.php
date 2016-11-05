<?php namespace App\Keen\Transformers;

class SessionToSessionEndedTransformer extends AbstractTransformer
{
    public function transform()
    {
        $session = $this->model;

        $output = [
            'guests_count' => $session->attendances->count(),
            'start_timestamp' => $session->start_timestamp,
            'end_timestamp' => $session->end_timestamp,
        ];

        return $output;
    }
}