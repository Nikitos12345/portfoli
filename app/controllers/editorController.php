<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 27.10.2018
 * Time: 13:46
 */

namespace App\controllers;


use App\models\editorModel;

class editorController extends AppController
{
    /**
     * @var editorModel
     */
    private $editor;

    public function __construct(editorModel $editor)
    {
        parent::__construct();
        $this->editor = $editor;
    }

    public function getAllTemp()
    {
        $temps = $this->editor->getAllTemp();
        echo $this->engine->render('editor::templates', compact('temps'));
    }

    public function editTemplate($id)
    {
        $template = $this->editor->getOneTemp($id);
        echo $this->engine->render('editor::edit', compact('template'));
    }

}