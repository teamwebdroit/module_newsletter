<?php

class TemplateController extends BaseController {

    public function buildingBlocs()
    {
        return View::make('newsletter.templates.building-blocs');
    }

    public function imageLeftText()
    {
        return View::make('newsletter.templates.image-left-text');
    }

    public function imageRightText()
    {
        return View::make('newsletter.templates.image-right-text');
    }

    public function imageText()
    {
        return View::make('newsletter.templates.image-text');
    }

    public function image()
    {
        return View::make('newsletter.templates.image');
    }

    public function text()
    {
        return View::make('newsletter.templates.text');
    }

    public function arret()
    {
        return View::make('newsletter.templates.arret');
    }

}
