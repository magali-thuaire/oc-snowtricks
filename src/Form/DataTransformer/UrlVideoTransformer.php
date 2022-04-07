<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UrlVideoTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {

        if (!$value) {
            return $value;
        }

        $file_headers = @get_headers($value);

        if (!$file_headers) {
            throw new TransformationFailedException('No headers');
        }

        $header = $file_headers[0];

        if (str_contains($header, 303)) {
            $searchword = 'Location: ';
            $headers = array_filter(get_headers($value), function ($var) use ($searchword) {
                return preg_match("/\b$searchword\b/i", $var);
            });
            $value = str_replace($searchword, '', current($headers));
            $header = get_headers($value)[0];
        }

        if (str_contains($header, 200)) {
            $test = str_replace('https://', '', $value);
            $domain = substr_replace($test, '', strpos($test, '/'));
            if (!($domain === 'www.youtube.com')) {
                throw new TransformationFailedException('Domain invalid : ' . $domain);
            }

            $value = str_replace('watch?v=', '/embed/', $value);
            $value = str_replace('&feature=youtu.be', '', $value);
            return $value;
        }

        throw new TransformationFailedException($value . ' : ' . $header);
    }
}
