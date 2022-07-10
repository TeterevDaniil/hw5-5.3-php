<?php

namespace APP\Model;

use Base\AbstractModel;
use Base\Db;


class User extends AbstractModel
{
   private $id;
   private $name;
   private $email;
   private $password;
   private $insert_date;

   public function __construct($data = [])
   {
      if ($data) {
         $this->id = $data['id'];
         $this->name = $data['name'];
         $this->email = $data['email'];
         $this->password = $data['password'];
         $this->insert_date = $data['insert_date'];
      }
   }

   public function getName(): string
   {
      return $this->name;
   }
   public function setName(string $name)
   {
      $this->name = $name;
      return $this;
   }
   public function getId(): int
   {
      return $this->id;
   }
   public function setId(int $id): self
   {
      $this->id = $id;
      return $this;
   }
   public function getPassword(): string
   {
      return $this->password;
   }
   public function setPassword(string $password): self
   {
      $this->password = $password;
      return $this;
   }
   public function getEmail(): string
   {
      return $this->email;
   }
   public function setEmail($email): self
   {
      $this->email = $email;
      return $this;
   }
   public function getInsertDate(): string
   {
      return $this->insert_date;
   }
   public function setInsertDate(string $insert_date): self
   {
      $this->insert_date = $insert_date;
      return $this;
   }
   public function save()
   {
      $db = Db::getInstance();
      $insert = "INSERT INTO `clients`(`name`, `email`, `password`)
       VALUES (:name,:email,:password)";
      $db->exec($insert, [
         ':name' => $this->name,
         ':email' => $this->email,
         ':password' => $this->password
      ], __METHOD__);
      $id = $db->lastinsertId();
      $this->id = $id;

      return $id;
   }
   public static function getById(int $id): ?self
   {
      $db = Db::getInstance();
      $select = "SELECT * FROM `clients` WHERE id = $id";
      $data = $db->findOne($select, [], __METHOD__);
      if (!$data) {
         return null;
      }
      return new self($data);
   }

   public static function getNameById(int $id)
   {
      $db = Db::getInstance();
      $select = "SELECT name FROM `clients` WHERE id = $id";
      $data = $db->findOne($select, [], __METHOD__);
      if (!$data) {
         return null;
      }
      return $data;
   }

   public static function getByName(string $name): ?self
   {
      $db = Db::getInstance();
      $select = "SELECT * FROM `clients` WHERE `name` = :name";
      $data = $db->findOne($select, [':name' => $name], __METHOD__);
      if (!$data) {
         return null;
      }

      return new self($data);
   }

   public static function getByEmail(string $email): ?self
   {
      $db = Db::getInstance();
      $select = "SELECT * FROM `clients` WHERE `email` = :email";
      $data = $db->findOne($select, [':email' => $email], __METHOD__);
      if (!$data) {
         return null;
      }

      return new self($data);
   }

   public function isAdmin():bool
   {
     return in_array($this->id, ADMIN_IDS);
   }

}
