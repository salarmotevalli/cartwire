<?php
$prod = array(
  'model' => [
      ['id' => 1, 'name' => 'table'],
      ['id' => 2, 'name' => 'pen'],
      ['id' => 3, 'name' => 'eraser'],
  ]
);

$result= array_search(1, array_column($prod['model'], 'id'));
print_r(!empty($result));
