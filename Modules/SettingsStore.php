<?php
class SettingsStore{
    private settings = [];

    function save($newSettings){
        $this->settings = $newSettings;
    }

    function clear(){
        $this->settings = [];
    }

    function get(){
        return $this->settings;
    }
}
?>
