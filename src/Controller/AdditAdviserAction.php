<?php

namespace App\Controller;

use App\Entity\Adviser;
use App\Library\ImageOptimizer;
use App\Repository\AdviserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

final class AdditAdviserAction
{
    public function __invoke(Request $request): Adviser
    {
        /** @var Adviser $adviser */
        $adviser = $request->attributes->get('data');

        if ($adviser instanceof Adviser === false) {
            throw new BadRequestHttpException('');
        }

        // resize the profile image
        if($base64String = stream_get_contents($adviser->getProfileImage())){
            $resizedProfileImage = ImageOptimizer::resizeBase64($base64String, AdviserRepository::PROFILE_IMAGE_WIDTH, AdviserRepository::PROFILE_IMAGE_WIDTH);
            if ($resizedProfileImage === false) {
                throw new UnprocessableEntityHttpException('profile image could not be resized');
            }
            $adviser->setProfileImage($resizedProfileImage);
        }

        return $adviser;
    }
}
