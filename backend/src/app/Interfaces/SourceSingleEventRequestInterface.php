<?php

namespace App\Interfaces;

interface SourceSingleEventRequestInterface {
        public function toDTO(): SourceEventDTOInterface;
}
