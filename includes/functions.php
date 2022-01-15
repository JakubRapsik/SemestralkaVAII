<?php


function getValuesFromDB($db, $sql, $param, $pocetReturn): array
{

    $results = array();
    $request = $db->prepare($sql);
    if ($param != null) {
        foreach ($param as $paramName => $paramType) {
            $request->bind_param($paramType, $paramName);
        }
    }
    $request->execute();
    $request->store_result();
    switch ($pocetReturn) {
        case 1:
        {
            $request->bind_result($results[0]);
            break;
        }
        case 2:
        {
            $request->bind_result($results[0], $results[1]);
            break;
        }
        case 3:
        {
            $request->bind_result($results[0], $results[1], $results[2]);
            break;
        }
        case 4:
        {
            $request->bind_result($results[0], $results[1], $results[2], $results[3]);
            break;
        }
    }
    $request->fetch();
    return $results;

}
