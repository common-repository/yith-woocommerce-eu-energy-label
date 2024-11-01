<?php
if ( !function_exists( 'yith_wceue_get_energy_label_array' ) ) {
    /**
     * get the energy label array
     *
     * @return array
     */
    function yith_wceue_get_energy_label_array() {
        $energy_label_array = array(
            1  => 'A+++',
            2  => 'A++',
            3  => 'A+',
            4  => 'A',
            5  => 'B',
            6  => 'C',
            7  => 'D',
            8  => 'E',
            9  => 'F',
            10 => 'G',
        );

        return apply_filters( 'yith_wceue_get_energy_label_array', $energy_label_array );
    }
}