<?php

class Content_Type_Exception extends Exception {
    const CODE_DUP_CONTENT_TYPE = 1;
    const CODE_DUP_FIELD = 2;
    const CODE_REQUIRED_FIELD = 3;
    const CODE_NOT_FOUND = 4;
    
}