<?php

class UserDAO{

    const _CLASS = "User";
    const _TABLE = "users";


    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT id,login,email,firstname,lastname,registerdate,role from users";
        $userlist = $ds->fetchAllToClass($sql,"User");
        $ds->close();
        
        return $userlist;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT id,login,email,firstname,lastname,registerdate,role from users where id=?";
        $params = array($id);
        $user = $ds->fetchToClass($sql,"User",$params);
        $ds->close();
        
        return $user;
        
    }
    
    
    public function getByLogin($login){
        
        $ds = new DataSource();
        $sql = "SELECT id,login,firstname,lastname,password,email,registerdate,role from users where login=?";
        $params = array($login);
        $user = $ds->fetchToClass($sql,"User",$params);
        $ds->close();
        
        return $user;        
        
    }
    
    
    public function getByLoginPassword($login,$password){
        
        $ds = new DataSource();
        $sql = "SELECT * from users where login=? and password=?";
        $params = array($login,$password);
        $user = $ds->fetchToClass($sql,"User",$params);
        $ds->close();
        
        return $user;        
        
    }
    
    
    public function getByEmail($email){
        
        $ds = new DataSource();
        $sql = "SELECT id,login,email,firstname,lastname,registerdate,role from users where email=?";
        $params = array($email);
        $user = $ds->fetchToClass($sql,"User",$params);
        $ds->close();
        
        return $user;        
        
    }
    
    
    public function isAdmin($login){
        
        $ds = new DataSource();
        $sql = "SELECT r.role from users u ,user_roles r where u.role=r.id and u.login=?";
        $params = array($login);
        $role = $ds->fetch($sql,$params)[0];
        $ds->close();
        
        if($role=="admin")
            return true;
        else 
            return false;
        
    }    
    
    
    public function insert($user){
        
        $ds = new DataSource();
        
        $sql = "insert into users (login,password,email,firstname,lastname,role) 
                 values ( 
                    :login,
                    :password,
                    :email, 
                    :firstname,
                    :lastname,
                    :role)";
                
        $params = array(
                        ":login" => $user->getLogin(),
                        ":password" => $user->getPassword(),
                        ":email" => $user->getEmail(),
                        ":firstname" => $user->getFirstName(),
                        ":lastname" => $user->getLastName(),
                        ":role" => $user->getRole()
                        );
        $result = $ds->execute($sql,$params); 
        $ds->close();
        
        return $result; 
        
    }
    
    
    public function update($user){
        
        $ds = new DataSource();
        
        $sql = "update users set 
                login = :login,
                email=:email, 
                firstname=:firstname,
                lastname=:lastname,
                role=:role";
                
        $params = array(
                        ":login" => $user->getLogin(),
                        ":email" => $user->getEmail(),
                        ":firstname" => $user->getFirstName(),
                        ":lastname" => $user->getLastName(),
                        ":role" => $user->getRole()
                        );
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result; 
        
    }


    public function updateSinRol($user, $id)
    {


        $ds = new DataSource();

        $sql = sprintf("update %s set 
                login = :login,
                email=:email, 
                firstname=:firstname,
                lastname=:lastname
                 where id=%s", self::_TABLE, $id);

        $params = array(
            ":login" => $user->getLogin(),
            ":email" => $user->getEmail(),
            ":firstname" => $user->getFirstName(),
            ":lastname" => $user->getLastName()
        );
        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;
    }

    
    public function delete($id){
        
        $ds = new DataSource();
        $sql = "delete from users where id = ?";
        $params = array($id);
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result;
        
    }
    
    
    
}


?>