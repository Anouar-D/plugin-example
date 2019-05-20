<?php
    /**
    * @package plugin 
    */

    class PluginExampleDeactivate{
        public static function deactivate(){
            flush_rewrite_rules();
        }
    }