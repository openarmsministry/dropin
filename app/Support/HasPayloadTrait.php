<?php namespace App\Support;

trait HasPayloadTrait {
    protected $payload;

    function setPayload($value) {
        $this->payload = $value;
    }

    function getPayload() {
        return $this->payload;
    }
}