<?php


class GarmentOrder
{
	use Model;

	protected $table = 'garment_order';

	// $this->order_column = 'garment_id';


	protected $allowedCloumns = [
		'garment_order_id',
		'emp_id',
		'garment_id',
		'order_id',
		'cut_dispatch_date',
		'sew_dispatch_date',
		'status',
		'placed_date',
		'cut_price',
		'sewed_price'
		// 'last modified'
	];
	public $selectedCloumns = [
		'garment_id',
		'order_id',
		'status',
		'cut_price',
		'sewed_price'
		// 'last modified'
	];


	// public function getOrdersDetails($id)
	// {
	// 	// $quary	= 'SELECT * FROM garment_order
	// 	// LEFT JOIN table2 ON table1.user_id = table2.user_id
	// 	// UNION
	// 	// SELECT * FROM table1
	// 	// RIGHT JOIN table2 ON table1.user_id = table2.user_id
	// 	// WHERE table1.user_id IS NULL OR table2.user_id IS NULL';

	// 	$quary	= "SELECT * FROM $this->table
	// 	FULL OUTER JOIN order
	// 	ON garment_order.order_id = order.order_id
	// 	WHERE garment_id = :garment_id";

	// 	return $this->quary($quary, $id);

	// 	// $quary .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

	// }

	function getMaterialData()
	{

		$quary = "SELECT $this->table.order_id, order_material.*, material_stock.material_type, sleeves.type, printing_type.printing_type
        FROM order_material 
        INNER JOIN $this->table 
        ON $this->table.order_id = order_material.order_id 
        INNER JOIN material_stock
        ON material_stock.stock_id = order_material.material_id
        INNER JOIN sleeves
        ON sleeves.sleeve_id = order_material.sleeve_id
        INNER JOIN printing_type
        ON printing_type.ptype_id = order_material.ptype_id ";

		return $this->quary($quary);
	}

	function getGarmentOrderData($data)
	{
		// select only session user orders only
		$quary = "SELECT $this->table.*, order_material.*, material_stock.material_type, sleeves.type, printing_type.printing_type
        FROM order_material 
        INNER JOIN $this->table 
        ON $this->table.order_id = order_material.order_id 
        INNER JOIN material_stock
        ON material_stock.stock_id = order_material.material_id
        INNER JOIN sleeves
        ON sleeves.sleeve_id = order_material.sleeve_id
        INNER JOIN printing_type
        ON printing_type.ptype_id = order_material.ptype_id WHERE garment_id = :garment_id";

		$data = array_merge($data);

		return $this->quary($quary, $data);
	}


	// find the garment order table current orders count
	public function whereAndOR($data, $data_not = [])
	{
		$keys = array_keys($data);

		$quary = "SELECT COUNT(*) AS current_orders FROM $this->table WHERE ";

		$quary .= " status NOT IN (";

		foreach ($data_not as $value) {
			$quary .= "'" . $value . "'" . " ,";
		}

		$quary = trim($quary, ",");
		$quary .= " ) AND ";

		foreach ($keys as $key) {
			$quary .= $key . " = :" . $key . " AND";
		}

		$quary = trim($quary, " AND");

		$data = array_merge($data);

		return $this->quary($quary, $data);
	}
}
