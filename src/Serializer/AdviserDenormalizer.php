<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use App\Entity\Adviser;

class AdviserDenormalizer implements ContextAwareDenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function __construct(DenormalizerInterface $decorated)
    {
        $this->denormalizer = $decorated;
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        if ($type !== Adviser::class) return false;

        return $this->denormalizer->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $data['pricePerMinute'] = (string)$data['pricePerMinute'];

        // transform string to stream
        $stream = fopen('php://memory','r+');
        fwrite($stream, $data['profileImage']);
        rewind($stream);
        $data['profileImage']  = $stream;

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }
}
