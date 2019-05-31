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

}//end class
