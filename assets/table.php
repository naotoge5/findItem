<?php
class CompanyTable
{

    function set() {
        
    }
    /**
     * @return int|companytable
     */
    function getOne()
    {
        try {
            $pdo = getPDO();
            $stmt = $pdo->prepare("select * from companies where id=? limit 1");
            $stmt->execute([$this->id]);
            $result = $stmt->fetch();
            if ($result) {
                $this->name = $result['name'];
                $this->tel = $result['tel'];
                $this->postal = $result['postal'];
                $this->prefecture = $result['prefecture'];
                $this->city = $result['city'];
                $this->town = $result['town'];
                $this->details = $result['details'];
                $this->mail = $result['mail'];
                $this->password = $result['password'];
            }
            alert('不正なアクセスです', "caution");
        } catch (PDOException $e) {
            alert('データーベース接続エラー', "error");
        } finally {
            unset($pdo);
        }
        return 0;
    }

    function getMultiple()
    {
        $query = $this->getQuery();
        $param = $this->getParam();
        try {
            $pdo = getPDO(); //pdo取得
            $stmt = $pdo->prepare($query);
            $stmt->execute($param);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            alert('データーベース接続エラー', "error");
        } finally {
            unset($pdo);
        }
        return 0;
    }

    function getQuery()
    {
        $query = "select id, name, details from companies";
        if (!empty($this->name)) {
            $query .= " where name like ?";
        } else if (!empty($this->prefecture)) {
            $query .= " where prefecture = ?";
            if (!empty($this->city)) $query .= " and city = ?";
            if (!empty($this->town)) $query .= " and town = ?";
        }
    }

    function getParam()
    {
        if (!empty($this->name)) return ['%' . $this->name . '%'];
    }
}
class ObjectTable
{
    static function readObjectList(CompanyTable $company)
    {
        try {
            $pdo = getPDO();
            $stmt = $pdo->prepare("select * from objects where company_id=?");
            $stmt->execute([$company->id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            alert('データーベース接続エラー', "error");
        } finally {
            unset($pdo);
        }
        return 0;
    }
}
