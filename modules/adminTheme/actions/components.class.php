<?php

class AdminThemeComponents extends sfComponents
{

    /**
     * Create a search component
     *
     * @return null
     */
    public function executeGlobalSearch()
    {
        $this->selectOptions = isset($this->selectOptions) ? $this->selectOptions : [];

    }//end executeGlobalSearch()

    /**
     * Create a user menu
     *
     * @return null
     */
    public function executeUserMenu()
    {
        $this->actions = isset($this->actions) ? $this->actions : [];
        $this->languages = isset($this->languages) ? $this->languages : [];

    }//end executeUserMenu()

    /**
     * Create a navigation menu
     *
     * @return null
     */
    public function executeMenu()
    {
        $this->menu_config = isset($this->menu_config) ? $this->menu_config : [];
        $this->favorieten = isset($this->favorieten) ? $this->favorieten : [];

    }//end executeUserMenu()


    /**
     * Create a navigation menu
     *
     * @return null
     */
    public function executeLoader()
    {

    }//end executeLoader()

    /**
     * Create a flash message
     *
     * @return null
     */
    public function executeFlashMessage()
    {
        $this->message = isset($this->message) ? $this->message : "";

    }//end executeFlashMessage()

}//end class
