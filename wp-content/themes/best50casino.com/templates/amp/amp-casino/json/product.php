<?php
$ret =[
        "gr"=>[
            "name"=>[
                'title'=>'Ελλάδα',
                'id'=>$_GET['id']
            ]],
        "gb"=>["name"=>['title'=>'United Kingdom']]
];
$ret = json_encode(array('items' => [$ret[$_GET['country']]]));
echo $ret;
die();