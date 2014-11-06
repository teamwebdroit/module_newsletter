<?php

class TemplateController extends BaseController {

    public function buildingBlocs()
    {
        return View::make('newsletter.templates.building-blocs');
    }

    public function postText()
    {
        return View::make('newsletter.templates.post-text');
    }

    /**
     * Create templates
     */
    public function imageLeftText()
    {
        return View::make('newsletter.templates.create.image-left-text');
    }

    public function imageRightText()
    {
        return View::make('newsletter.templates.create.image-right-text');
    }

    public function imageText()
    {
        return View::make('newsletter.templates.create.image-text');
    }

    public function image()
    {
        return View::make('newsletter.templates.create.image');
    }

    public function text()
    {
        return View::make('newsletter.templates.create.text');
    }

    public function arret()
    {
        return View::make('newsletter.templates.create.arret');
    }

    /**
     * Edit templates
     */
    public function imageLeftTextEdit()
    {
        return View::make('newsletter.templates.edit.image-left-text');
    }

    public function imageRightTextEdit()
    {
        return View::make('newsletter.templates.edit.image-right-text');
    }

    public function imageTextEdit()
    {
        return View::make('newsletter.templates.create.image-text');
    }

    public function imageEdit()
    {
        return View::make('newsletter.templates.edit.create.image');
    }

    public function textEdit()
    {
        return View::make('newsletter.templates.edit.create.text');
    }

}
