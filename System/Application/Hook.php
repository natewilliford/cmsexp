<?php 

interface Application_Hook {
    public function preDispatch();
    public function postDispatch();
}