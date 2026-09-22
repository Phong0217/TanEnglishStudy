<?php

namespace App\Domain\AI;

interface AiQuestionGeneratorInterface
{
    public function generate(array $request, array $sources): array;
}
