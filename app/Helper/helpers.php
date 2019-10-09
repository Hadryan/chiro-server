<?php

function public_relative_path($path = '')
{
    return str_ireplace(base_path('public'), '', public_path($path));
}
