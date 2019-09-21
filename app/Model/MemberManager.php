<?php

namespace App\Model;


class MemberManager extends Crud
{


    public function newMember($email,$password,$username,$name,$surname,$cp,$city)
    {
        $data = array(
            'status' => 2,
            'm_email' => $email,
            'm_password' => sha1($password),
            'm_username' => $username,
            'm_name' => $name,
            'm_surname' => $surname,
            'm_cp' => $cp,
            'm_city' => $city
        );

        $member = $this->insert('members',$data);

        if($member){
            $_SESSION['id']= $this->database->lastInsertId();
            return true;
        } else{
            return false;
        }
    }

    public function checkMember($username, $password)
    {

        $request = $this->database->prepare('SELECT status, m_id, m_password,m_username FROM members WHERE m_username=?');
        $request->execute(array($username));
        $member = $request->fetch();

        if ($member['m_password'] == sha1($password)) {

            return $member;
        } else {
            return false;
        }
    }

    public function checkUsername($username) {

        $member = $this->selectOneElement("members","m_username");
        $member->execute(array($username));
        $result = $member->fetch();
        return $result;
    }

    public function checkEmail($email) {

        $member = $this->selectOneElement("members","m_email");
        $member->execute(array($email));
        $result = $member->fetch();
        return $result;
    }

    public function getMemberInfos($memberId) {

        $member = $this->selectOneElement("members","m_id");
        $member->execute(array($memberId));
        $result = $member->fetch();
        return $result;
    }

    public function editMemberProfile($email, $password, $username,$name,$surname,$cp,$city,$date, $id){

        $fields = array(
            'status'=> $_SESSION['status'],
            'm_email'=> $email,
            'm_password'=>sha1($password),
            'm_username'=>$username,
            'm_name'=>$name,
            'm_surname'=>$surname,
            'm_cp'=>$cp,
            'm_city'=>$city,
            'created'=>$date,
            'm_id'=> $id
        );

        $newMember =$this->update("members",$fields, "m_id",$id);

        if ($newMember){
            return true;
        }else{
            return false;
        }
    }

    public function getAllMembers($current_page,$limit) {

        $request = $this->selectForPagination('members',$current_page,$limit);

        return $request;
    }

    public function countMembers()
    {
        $request = $this->selectAll('members');

        return $request;
    }

    public function changeStatus($memberId)
    {
        $fields = array(
            'status' => 1
        );
        $status = $this->update("members",$fields,$memberId);
        $status ->rowCount();

        return $status;
    }

    public function removeMember($memberId){

        $delete = $this->delete("members", "m_id", $memberId);

    }

}