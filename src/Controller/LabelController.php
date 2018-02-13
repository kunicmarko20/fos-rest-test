<?php

namespace App\Controller;

use App\Entity\Label;
use App\Form\LabelType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Post;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
class LabelController extends FOSRestController
{
    /**
     * @Post(path="/labels")
     * @View(serializerGroups={"labelComplete"})
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(LabelType::class, $label = new Label());

        $form->submit($request->request->all());

        if ($form->isValid()) {
            return $label;
        }

        return $form;
    }
}
