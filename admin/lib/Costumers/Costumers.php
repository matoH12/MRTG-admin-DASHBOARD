<?php
class Costumers
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function __destruct()
    {
    }
    
    /**
     * Set friendly columns\' names to order tables\' entries
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'f_name' => 'First Name',
            'l_name' => 'Last Name',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at'
        ];

        return $ordering;
    }


    public function setOrderingValuesswzoznam()
    {
        $ordering = [
            'id' => 'ID',
            'swname' => 'Switch name',
            'swip' => 'Switch IP',
            'snmpuptime' => 'Switch Uptime',

        ];

        return $ordering;
    }


    public function setOrderingValueslokalita()
    {
        $ordering = [
            'id' => 'ID',
            'nazov' => 'Lokalita',
        ];

        return $ordering;
    }

    public function setOrderingValuesbudovy()
    {
        $ordering = [
            'id' => 'ID',
            'nazov' => 'Budova',
        ];

        return $ordering;
    }

    public function setOrderingValueslogs()
    {
        $ordering = [
            'id' => 'ID'];

        return $ordering;
    }



}
?>
