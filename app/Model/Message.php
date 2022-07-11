<?php

namespace App\Model;

use Base\Db;
use Intervention\Image\ImageManagerStatic as IImage;

class Message
{
    private $messageId;
    private $text;
    private $user_id;
    private $insert_date;
    private $img;
    public function __construct($data = [])
    {
        if ($data) {
            $this->messageId = $data['messageId'];
            $this->text = $data['text'];
            $this->user_id = $data['user_id'];
            $this->insert_date = $data['insert_date'];
            $this->img = $data['img'] ?? '';
            var_dump($data);
        }
    }

    public function getText(): string
    {
        return $this->text;
    }
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }
    public function getMessageId(): int
    {
        return $this->messageId;
    }
    public function setMessageId(int $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }
    public function getUser_id(): int
    {
        return $this->user_id;
    }
    public function setUser_id(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }
    public function getImg(): string
    {
        return $this->img;
    }
    public function setImg($img): self
    {
        $this->img = $img;
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
    public static function deleteMessage(int $messageId)
    {
        $db = Db::getInstance();
        $query = "DELETE FROM `message` WHERE id = $messageId";
        return $db->exec($query, [], __METHOD__);
    }


    public function saveMessage()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO `message`(`text`,`user_id`, `img`)
        VALUES (:text,:user_id,:img)";
        $db->exec($insert, [
            ':text' => $this->text,
            ':user_id' => $this->user_id,
            ':img' => $this->img
        ], __METHOD__);
        $id = $db->lastinsertId();
        $this->id = $id;

        return $id;
    }

    public function loadFile($file)
    {
        if (file_exists($file)) {
            $this->img = $this->genFileName();
            $filename = getcwd() . './img/' . $this->img;
            $image = IImage::make($file);
            $image->resize(200, null, function (\Intervention\Image\Constraint $constraint) {
                $constraint->aspectRatio();
            });
            $image->text('Watermark', $image->getWidth() - 10, $image->getHeight() - 10, function (\Intervention\Image\AbstractFont $font) {
                $font->size(24);
                $font->file(__DIR__.'/arial.ttf');
                $font->color([255, 255, 255, 0.3]);
                $font->align('right');
                $font->valign('bottom');
            });
            
            $image->save($filename);

        }
    }

    public function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    public static function getListMessages()
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `message` order by id DESC LIMIT 20";
        $data = $db->findAll($select, [], __METHOD__);
        if (!$data) {
            return [];
        }
        $messages = [];
        foreach ($data as $elem) {
            $messages[] = $elem;
        }
        return $messages;
    }

    public static function getUserMessages(array $messages): array
    {
        $data = [];
        $user_name = new User();
        foreach ($messages as $elem) {
            $user = $user_name->getNameById($elem['user_id']);
            if (!$user) {
                $user['name'] = 'Пользователь не найден';
            }
            $elem['name'] = $user['name'];
            $data[] = $elem;
        }
        return $data;
    }

    public static function getListUserMessages(int $user_id)
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `message` where user_id =$user_id order by id DESC LIMIT 20";
        $data = $db->findAll($select, [], __METHOD__);
        if (!$data) {
            return [];
        }
        $messages = [];
        foreach ($data as $elem) {
            $messages[] = $elem;
        }

        return $messages;
    }

    public function getData()
    {
        // var_dump($this->messageId);
        return [
            'id' => $this->messageId,
            'text' => $this->text,
            'user_id' => $this->user_id,
            'insert_date' => $this->insert_date,
            'img' => $this->img
        ];
    }
}
