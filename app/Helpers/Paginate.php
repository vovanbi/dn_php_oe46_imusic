<?php

if (!function_exists('loopNo')) {
    function loopNo($para, $loop)
    {
        return ($para->currentPage() - 1) * $para->perPage() + $loop->iteration;
    }
}
