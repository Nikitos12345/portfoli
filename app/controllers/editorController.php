<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 27.10.2018
 * Time: 13:46
 */

namespace App\controllers;


use App\models\editorModel;
use App\models\userModel;

class editorController extends AppController
{
    /**
     * @var editorModel
     */
    private $editor;
    /**
     * @var userModel
     */
    private $user;

    public function __construct(editorModel $editor, userModel $user)
    {
        parent::__construct();
        $this->editor = $editor;
        $this->user = $user;
    }

    public function getAllTemp()
    {
        $this->checkAuth();
        $isAdmin = $this->user->isAdmin();
        $temps = $this->editor->getAllTemp();
        echo $this->engine->render('editor::templates', compact('temps', 'isAdmin'));
    }

    public function editTemplate($id)
    {
        $this->checkAuth();
        $isAdmin = $this->user->isAdmin();
        $template = $this->editor->getOneTemp($id);
        echo $this->engine->render('editor::edit', compact('template', 'isAdmin'));
    }

    public function updateTemplate($id)
    {
        $this->editor->updateTemp($id);
        header("Location:/admin/editor");
    }

    public function updateTemplatesOrder()
    {
        $this->editor->updateTemplatesOrder();
        header("Location:/admin/editor");
    }
    private function checkAuth()
    {
        if (!$this->user->AuthCheck()){
            header("Location:/admin");
        }
    }

}