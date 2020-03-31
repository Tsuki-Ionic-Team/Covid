<?php

require_once '../lib_readxlsx/src/SimpleXLSX.php';

$filename = "kh-muulphikad-lat-long-thiibngchiichuue-tambl-ameph-cchanghwad.xlsx";

// echo date("h:i:sa")."<br>";
if ( $xlsx = SimpleXLSX::parse($filename) ) {
    $data_xlsx = $xlsx->rows();
    $length = count($data_xlsx);
    // $length = 50;
    $feature = array();
    $checkRowDup = array();

    for ($i = 1; $i < $length; $i++) {
        $coordinates = array();
        $TA_ID = $data_xlsx[$i][1];

        if (in_array($TA_ID, $checkRowDup, true)) {
            $check = true;
        } else {
            $check = false;
        }
        
        if ( $check == false ) {
            // echo $TA_ID;
            // echo "</br>";
            // echo " &emsp; | ";
            // for ($j=0; $j < $length; $j++) { 
            //     if( $TA_ID == $data_xlsx[$j][1] ) {
            //         $properties = $data_xlsx[$j][7];
            //         echo $properties." , ";
            //     }
            // }
            // echo "</br>";

            for ($j=0; $j < $length; $j++) { 
                if( $TA_ID == $data_xlsx[$j][1] ) {
                    $properties = new StdClass;
                    $properties->CHANGWAT_T = $data_xlsx[$j][8];
                    $properties->CHANGWAT_E = $data_xlsx[$j][9];
                    $properties->CH_ID = $data_xlsx[$j][7];
                    $properties->AMPHOE_T = $data_xlsx[$j][5];
                    $properties->AMPHOE_E = $data_xlsx[$j][6];
                    $properties->AM_ID = $data_xlsx[$j][4];
                    $properties->TAMBON_T = $data_xlsx[$j][2];
                    $properties->TAMBON_E = $data_xlsx[$j][3];
                    $properties->TA_ID = $data_xlsx[$j][1];

                    $LAT = $data_xlsx[$j][10];
                    $LNG = $data_xlsx[$j][11];

                    array_push($coordinates, [$LNG,$LAT]);
                }
            }
            $geometry  = new StdClass;
            $geometry->type = "Polygon";
            $geometry->coordinates = $coordinates;

            $option = array(
                'type' => "Feature",
                'properties' => $properties,
                'geometry' => $geometry,
            );
            array_push($feature, $option);
        }
        array_push($checkRowDup, $TA_ID);
    }

    $responce = new StdClass;
    $responce->type = "FeatureCollection";
    $responce->features = $feature;

    $jsonstring = json_encode($responce);
    echo $jsonstring;

} else {
    echo "Fail";
}
// echo date("h:i:sa")."<br>";

?>