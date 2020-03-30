<?php

require_once '../lib_readxlsx/src/SimpleXLSX.php';

$filename = "kh-muulphikad-lat-long-thiibngchiichuue-tambl-ameph-cchanghwad.xlsx";

if ( $xlsx = SimpleXLSX::parse($filename) ) {
    // print_r( $xlsx->rows() );
    // echo $xlsx->rows();

    $data_xlsx = $xlsx->rows();
    // $length = count($data_xlsx);
    $length = 20;
    $feature = array();
    $checkRowDup = array();

    for ($i = 1; $i < $length; $i++) {
        $TA_ID = $data_xlsx[$i][1];

        // for ($k=0; $k < count($checkRowDup); $k++) { 
        //     // if (in_array($TA_ID, $checkRowDup, true)) {
        //     // } else {
        //     // }
        // }

        if (in_array($TA_ID, $checkRowDup, true)) {
            $check = true;
        } else {
            $check = false;
        }
        
        if ( $check == false ) {
            echo $TA_ID;
            echo "</br>";
            echo " &emsp; | ";
            for ($j=0; $j < $length; $j++) { 
                if( $TA_ID == $data_xlsx[$j][1] ) {
                    $properties = $data_xlsx[$j][7];
                    echo $properties." , ";
                }
            }
        }

        array_push($checkRowDup, $TA_ID);
        

        // $properties = new StdClass;
        // $properties->CHANGWAT_T = $data_xlsx[$j][8];
        // $properties->CHANGWAT_E = $data_xlsx[$j][9];
        // $properties->CH_ID = $data_xlsx[$j][7];
        // $properties->AMPHOE_T = $data_xlsx[$j][5];
        // $properties->AMPHOE_E = $data_xlsx[$j][6];
        // $properties->AM_ID = $data_xlsx[$j][4];
        // $properties->TAMBON_T = $data_xlsx[$j][2];
        // $properties->TAMBON_E = $data_xlsx[$j][3];
        // $properties->TA_ID = $data_xlsx[$j][1];


        // $option = array(
        //     'type' => "Feature",
        //     'properties' => $properties,
        //     'Ad_Level' => $data_xlsx[$i][1]
        // );
        // array_push($feature, $option);
        echo "</br>";
    }

    // $responce = new StdClass;
    // $responce->type = "FeatureCollection";
    // $responce->features = $feature;

    // $jsonstring = json_encode($responce);
    // echo $jsonstring;

} else {
    // echo SimpleXLSX::parse_error();
    echo "Fail";
}

?>