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

}//end class
