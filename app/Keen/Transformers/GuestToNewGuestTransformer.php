<?php namespace App\Keen\Transformers;

class GuestToNewGuestTransformer extends AbstractTransformer
{
    public function transform()
    {
        $guest = $this->model;

        return [
            'id' => $guest->id,
            'nick_name' => $guest->nick_name,
        ];
    }
}