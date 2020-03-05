<?php

namespace App\Support;

final class GenerateUniqueToken
{
    /**
     * Gerar token aleatório
     *
     * @return string
     */
    public static function run(): string
    {
        $token = str_random(60);

        $test = true;

        do {

            $check = app('db')->table('users')->where('api_token', $token)->exists();

            if ($check) {
                $token = str_random(60);
                continue;
            }

            $test = false;

        } while ($test);

        return $token;
    }
}
