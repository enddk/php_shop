<?php
    include 'dbconnect.php';

    class Product extends DB{ //商品データを取得する　データベースに接続するのでクラスを継承
        public function getData() {
            try {
                $PDO = parent::ConnectDB();
                
                $sql = 'SELECT code, name, price, gazou FROM mst_product WHERE 1';

                $stmt = $PDO->prepare($sql);
                $stmt->execute();

                $data = array();
                
                while(true)
                {
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec == false)
                    {
                        break;
                    }
                    $data[] = $rec;
                }

                return $data;
            }

            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getDataOnly(int $pro_code) {
            try{
                $PDO = parent::ConnectDB();
    
                $sql = 'SELECT name, price, gazou FROM mst_product WHERE code=?';
                $stmt = $PDO->prepare($sql);
                $data[] = $pro_code;
                $stmt->execute($data);
    
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
                $data = array();
    
                $data['code'] = $pro_code;
                $data['name'] = $rec['name'];
                $data['price'] = $rec['price'];
                $data['gazou'] = $rec['gazou'];

                return $data;
            } 
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getCart(Session $Session) {
            try {
                $PDO = parent::ConnectDB();

                $cart = $Session->CartLook();

                if(!empty($cart))
                {
                    $carts = array();
    
                    foreach($cart['cart'] as $key => $val)
                    {
                        $sql = 'SELECT code, name, price, gazou FROM mst_product WHERE code=?';
                        $stmt = $PDO->prepare($sql);
                        $data[0] = $val;
                        $stmt->execute($data);
    
                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
                        $pro_name[] = $rec['name'];
                        $pro_price[] = $rec['price'];
    
                        if($rec['gazou'] == '')
                        {
                            $pro_gazou[] = '';
                        }
                        else
                        {
                            $pro_gazou[] = '<img src="../../product/gazou/'.$rec['gazou'].'" style="width:100%; height:150px;" class="img-fluid">';
                        }
                    }
    
                    $carts['name'] = $pro_name;
                    $carts['price'] = $pro_price;
                    $carts['gazou'] = $pro_gazou;
                    $carts['kazu'] = $cart['kazu'];
                    $carts['max'] = $cart['max'];

                    $sum = 0;

                    for($i = 0; $i < $carts['max']; $i++){
                        $sum += $carts['price'][$i] * $carts['kazu'][$i];
                    }

                    $carts['sum'] = $sum;
    
                } else {
                    $carts['max'] = 0;
                    $carts['sum'] = 0;
                }
                return $carts;
            }
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }
    }
?>