<?php

class MaterialPrintingType{

    use Model;

    protected $table = 'material_printingtype';

    protected $allowedCloumns = [
        'mp_id',
        'stock_id',
        'ptype_id'
    ];

    public function getFullData()
    {
        $quary = "SELECT material_printingtype.*, material_stock.*, printing_type.* 
                FROM material_printingtype  
                INNER JOIN material_stock   
                ON material_printingtype.stock_id = material_stock.stock_id 
                INNER JOIN printing_type 
                ON material_printingtype.ptype_id = printing_type.ptype_id
                ORDER BY mp_id";
        return $this->quary($quary);
    }

}

?>