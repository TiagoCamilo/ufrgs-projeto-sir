<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 10/11/18
 * Time: 11:37
 */

namespace App\Helpers;


class TemplateManager
{
    public $edit;
    public $new;
    public  $form;
    public  $delete;
    public  $indexActions;
    public  $indexFooter;
    public  $showActions;

    /**
     * @return mixed
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * @param mixed $edit
     */
    public function setEdit($edit): void
    {
        $this->edit = $edit;
    }

    /**
     * @return mixed
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * @param mixed $new
     */
    public function setNew($new): void
    {
        $this->new = $new;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form): void
    {
        $this->form = $form;
    }

    /**
     * @return mixed
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * @param mixed $delete
     */
    public function setDelete($delete): void
    {
        $this->delete = $delete;
    }

    /**
     * @return mixed
     */
    public function getIndexActions()
    {
        return $this->indexActions;
    }

    /**
     * @param mixed $indexActions
     */
    public function setIndexActions($indexActions): void
    {
        $this->indexActions = $indexActions;
    }

    /**
     * @return mixed
     */
    public function getIndexFooter()
    {
        return $this->indexFooter;
    }

    /**
     * @param mixed $indexFooter
     */
    public function setIndexFooter($indexFooter): void
    {
        $this->indexFooter = $indexFooter;
    }

    /**
     * @return mixed
     */
    public function getShowActions()
    {
        return $this->showActions;
    }

    /**
     * @param mixed $showActions
     */
    public function setShowActions($showActions): void
    {
        $this->showActions = $showActions;
    }



}