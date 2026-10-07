<?php

namespace App\Support;

/**
 * Normalize text received from spreadsheet/CSV uploads before it reaches
 * database or JSON serialization.
 *
 * Excel CSV files exported on Windows are commonly encoded as Windows-1258 or
 * Windows-1252, while Laravel/MySQL and Inertia expect valid UTF-8.
 */
final class Utf8
{
    public static function clean(mixed $value): string
    {
        $value = (string) ($value ?? '');

        // Remove a UTF-8 BOM which otherwise becomes part of the first header.
        $value = preg_replace('/^\xEF\xBB\xBF/', '', $value) ?? $value;

        if ($value === '' || mb_check_encoding($value, 'UTF-8')) {
            return $value;
        }

        $sourceEncodings = [];
        if (strncmp($value, "\xFF\xFE", 2) === 0) {
            $sourceEncodings[] = 'UTF-16LE';
        } elseif (strncmp($value, "\xFE\xFF", 2) === 0) {
            $sourceEncodings[] = 'UTF-16BE';
        }

        // WINDOWS-1258 handles Vietnamese CSV exports; WINDOWS-1252 keeps
        // Western European exports readable. iconv supports 1258 even when
        // mbstring does not list it as an encoding.
        $sourceEncodings = [...$sourceEncodings, 'WINDOWS-1258', 'WINDOWS-1252', 'ISO-8859-1'];

        foreach ($sourceEncodings as $sourceEncoding) {
            $converted = @iconv($sourceEncoding, 'UTF-8//IGNORE', $value);

            if (is_string($converted) && mb_check_encoding($converted, 'UTF-8')) {
                return $converted;
            }
        }

        // Last-resort conversion for an unexpected byte sequence. The result
        // is always valid UTF-8 and therefore safe for JSON responses.
        $converted = @iconv('UTF-8', 'UTF-8//IGNORE', $value);

        return is_string($converted) ? $converted : '';
    }

    /**
     * A literal question mark in a Vietnamese name usually means the source
     * file already lost a character during an earlier ANSI conversion. It is
     * not possible to reconstruct that character safely on the server.
     */
    public static function containsReplacementMarker(string $value): bool
    {
        return str_contains($value, '?') || str_contains($value, "\u{FFFD}");
    }
}
