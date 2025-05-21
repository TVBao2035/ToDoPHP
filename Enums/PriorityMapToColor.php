<?php
function PriorityMapToColor($type)
{
    if ($type == 1)
        return "text-green-500";
    if ($type == 2)
        return "text-yellow-500";
    if ($type == 3)
        return "text-red-400";

    return "text-green-500";
}

?>