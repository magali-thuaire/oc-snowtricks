<?php

namespace App\Form\DataTransformer;

use App\Entity\Media;
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
            return null;
        }

        if (!$value instanceof Media) {
            throw new TransformationFailedException('The VideoUrl can only be used with Media object');
        }

        $value->setType(array_search('video', Media::TYPE));
        $url = $value->getFile();

        $file_headers = @get_headers($url);

        if (!$file_headers) {
            throw new TransformationFailedException('No headers');
        }

        $header = $file_headers[0];

        if (str_contains($header, 303)) {
            $searchword = 'Location: ';
            $headers = array_filter(get_headers($url), function ($var) use ($searchword) {
                return preg_match("/\b$searchword\b/i", $var);
            });
            $url = str_replace($searchword, '', current($headers));
            $header = get_headers($url)[0];
        }

        if (str_contains($header, 200)) {
            $temp = str_replace('https://', '', $url);
            $domain = substr_replace($temp, '', strpos($temp, '/'));
            if (!($domain === 'www.youtube.com')) {
                throw new TransformationFailedException('Domain invalid : ' . $domain);
            }

            $url = str_replace('watch?v=', 'embed/', $url);
            $url = str_replace('&feature=youtu.be', '', $url);

            $value->setFile($url);

            return $value;
        }

        throw new TransformationFailedException($url . ' : ' . $header);
    }
}
