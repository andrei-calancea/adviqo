<?php

namespace App\Serializer;

use App\Entity\Adviser;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AdviserNormalizer implements ContextAwareNormalizerInterface
{
    use NormalizerAwareTrait;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @param Adviser $object
     * @param string|null $format
     * @param array $context
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($object, ?string $format = null, array $context = []): array
    {
        $profileImage = is_resource($object->getProfileImage()) ? stream_get_contents($object->getProfileImage()) : $object->getProfileImage();
        $object->setProfileImage($profileImage);

        $data = $this->normalizer->normalize($object, $format, $context);

        $data['pricePerMinute'] = (float)$object->getPricePerMinute();

        return $data;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Adviser;
    }
}
