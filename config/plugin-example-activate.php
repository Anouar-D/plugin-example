<?php
    /**
    * @package plugin 
    */

    class PluginExampleActivate{
        public static function activate(){
            flush_rewrite_rules();
        }
    }