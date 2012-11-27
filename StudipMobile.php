<?php
	
class StudipMobile extends StudipPlugin implements SystemPlugin
{
    const DEFAULT_CONTROLLER = "activities";
    
    /**
     * This method dispatches and displays all actions. It uses the template
     * method design pattern, so you may want to implement the methods #route
     * and/or #display to adapt to your needs.
     *
     * @param  string  the part of the dispatch path, that were not consumed yet
     *
     * @return void
     */
    function perform($unconsumed_path) {
        $trails_root = $this->getPluginPath();
        $dispatcher = new Trails_Dispatcher($trails_root, 
                                            rtrim(PluginEngine::getURL($this, null, ''), '/'), 
                                            self::DEFAULT_CONTROLLER);
        $dispatcher->plugin = $this;
        $dispatcher->dispatch($unconsumed_path);
    }
}
