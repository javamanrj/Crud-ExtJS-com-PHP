<?php

require_once 'Connection.php';

abstract class Base {

    protected $id = null;
    protected $database = null;
    protected $table = null;

    public function __construct(array $options=null, \PDO $database = null) {
        if (count($options))
            $this->setOptions($options);

        $this->config['adapter'] = "mysql";
        $this->config['hostname'] = "localhost";
        $this->config['dbname'] = "crudext";
        $this->config['user'] = "root";
        $this->config['password'] = "";

        $connection = new Connection();

        $this->database = $connection->getConnection($this->config);

        if (method_exists($this, $_GET['action'])) {
            call_user_func(array($this, $_GET['action']));
        }
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods))
                $this->$method($value);
        }
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if (!is_null($this->id))
            throw new \Exception('ID nao pode ser alterado');
        $this->id = (int) $id;
    }

    public function getTable() {
        return $this->table;
    }

    public function getDb() {
        return $this->database;
    }

    public function save() {
        if ($this->id)
            return $this->_update();
        else
            return $this->_insert();
    }

    public function find($id) {
        $db = $this->getDb();
        $stm = $db->prepare("select * from " . $this->getTable() . ' where id=:id');
        $stm->bindValue(':id', $id);
        $stm->execute();
        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll() {

        $start = $_POST['start'];
        $limit = $_POST['limit'];

        $sort = $_POST['sort'] ? $_POST['sort'] : 'nome';
        $dir = $_POST['dir']? $_POST['dir'] : 'ASC';
        $order = $sort . ' ' . $dir;
        
        $db = $this->getDb();
        
        $sql = "select * from " . $this->getTable() . " order by :order";
        
        if($start !== null && $start !== '' && $limit !== null && $limit !== ''){
            $sql .= " LIMIT " . $start . " , " . $limit;
        }
        
        $stm = $db->prepare($sql);
        $stm->bindValue(":order", $order);
        $stm->execute();
        
        $sql = "SELECT COUNT(*) AS total FROM " . $this->getTable();
        $total = $db->query($sql)->fetch();

        echo json_encode(array(
            "data" => $stm->fetchAll(\PDO::FETCH_ASSOC),
            "success" => true,
            "total" => $total['total']
        ));
    }

    public function delete() {

        $arrUsuarios = json_decode($_POST['data']);

        if (is_array($arrUsuarios)) {

            foreach ($arrUsuarios as $usuario) {

                $id = $usuario->id;

                $db = $this->getDb();
                $stm = $db->prepare("delete from " . $this->table . " where id=:id");
                $stm->bindValue(":id", $id);
                $usuarioExcluido = $stm->execute();

                if (!$usuarioExcluido)
                    break;
            }
        }else {

            $id = $arrUsuarios->id;

            $db = $this->getDb();
            $stm = $db->prepare("delete from " . $this->table . " where id=:id");
            $stm->bindValue(":id", $id);
            $usuarioExcluido = $stm->execute();
        }

        $msg = $usuarioExcluido ? 'Registro(s) excluído(s) com sucesso' : 'Erro ao excluir, tente novamente.';

        echo json_encode(array(
            "success" => $usuarioExcluido,
            "message" => $msg
        ));
    }
}