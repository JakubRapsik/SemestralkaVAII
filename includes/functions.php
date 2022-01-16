<?php


function getValuesFromDB($db, $sql, $param, $pocetReturn, $rownum): array
{
    $results = array();
    $rows = array();
    $finalParam = array();
    $request = $db->prepare($sql);
    if ($param != null) {
        foreach ($param as $paramName => $paramType) {
            array_push($finalParam, $paramName);
            $types .= $paramType;
        }
        switch (count($param)) {
            case 1:
            {
                $request->bind_param($types, $finalParam[0]);
                break;
            }
            case 2:
            {
                $request->bind_param($types, $finalParam[0], $finalParam[1]);
                break;
            }
            case 3:
            {
                $request->bind_param($types, $finalParam[0], $finalParam[1], $finalParam[2]);
                break;
            }
        }
    }
    $request->execute();
    $request->store_result();
    if ($rownum == false) {
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
    } else {
        $request->fetch();
        $rows[0] = $request->num_rows;
        return $rows;
    }


}


function updateData($db, $sql, $param, $type)
{
    $request = $db->prepare($sql);
    switch (count($param)) {
        case 1:
        {
            $request->bind_param($type, $param[0]);
            break;
        }
        case 2:
        {
            $request->bind_param($type, $param[0], $param[1]);
            break;
        }
        case 3:
        {
            $request->bind_param($type, $param[0], $param[1], $param[2]);
            break;
        }
        case 4:
        {
            $request->bind_param($type, $param[0], $param[1], $param[2], $param[3]);
            break;
        }
    }
    $request->execute();

}