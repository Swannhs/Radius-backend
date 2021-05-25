<?php
namespace App\Controller\Component;
use Cake\ORM\TableRegistry;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Amount component
 */
class AmountComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    private $symbol = ' ৳';

    public function symbol_amount($query): array
    {
        $item = array();

        foreach ($query as $row){
            $row['paid'] = $this->add_symbol($row->paid);
            $row['payable'] = $this->add_symbol($row->payable);
            $row['receivable'] = $this->add_symbol($row->receivable);
            $row['received'] = $this->add_symbol($row->received);
//            $row['user'] = $row->user->username;
            array_push($item, $row);
        }
        return $item;
    }

    public function single_symbol_amount($query){
        $query['paid'] = $this->add_symbol($query->paid);
        $query['payable'] = $this->add_symbol($query->payable);
        $query['receivable'] = $this->add_symbol($query->receivable);
        $query['received'] = $this->add_symbol($query->received);

        return $query;
    }

    private function decimal($number): string
    {
        return number_format($number, 2);
    }

    private function add_symbol($value): string
    {

        return strval($this->decimal($value) . $this->symbol);
    }
}
