<?php 

interface Hook_Listener {
    public function call($params, &$return);
}