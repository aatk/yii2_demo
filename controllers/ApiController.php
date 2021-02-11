<?php

namespace app\controllers;

use app\models\Users;
use yii\rest\Controller;

class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $result = parent::behaviors();
        return $result;
    }
    
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
    }
    
    public function actionInstall()
    {
        //@Get("/api/install")
        
        $maxcount    = 1000;
        $firstnames  = [ "Александр", "Иван", "Максим", "Олег", "Марат", "Людмила", "Оксана" ];
        $secondnames = [ "Ткаченко", "Жуков", "Чкалов", "Путин", "Шамузинов", "Дахно", "Карась" ];
        $surnames    = [ "Александрович", "Иванович", "Максимович", "Олегович", "Маратович", "Евгеньевич", "Джонович" ];


        $Users = new Users();
        $count           = $Users->count();

        $ID = false;
        if ($count < $maxcount)
        {
            for ($next_item = $count; $next_item < $maxcount; $next_item++)
            {
                //заполним таблицу
                $rnd_f  = rand(0, 6);
                $rnd_s  = rand(0, 6);
                $rnd_ss = rand(0, 6);

                $Users = new Users();
                $Users->setFirstname($firstnames[$rnd_f]);
                $Users->setSecondname($secondnames[$rnd_s]);
                $Users->setSurname($surnames[$rnd_ss]);
    
                $Users->save();
                $ID = $Users->getId();
            }
        }

        $res = [ 'result' => $ID ];

        $result = $this->asJson($res);
        return $result;
    }
    
    public function actionGetid()
    {
        $id = $this->request->get("id");

        //@Get("/api/get/{id}")
        $result = $this->response;
        $id     = $id ?? 0;
        if ($id > 0)
        {
            $user = Users::findOne($id)->getAttributes();
            $UserArray       = [];
            $UserArray[]     = $user;
            $result = $this->asJson($UserArray);
        }
        else
        {
            $result->setStatusCode(404);
        }

        return $result;
    }
    
    public function actionList()
    {
        $id    = $this->request->get("id");
        $limit = $this->request->get("limit");

        // @Get("/api/list/{id}/{limit}")
        $result = $this->response;
        $id     = $id ?? 0;
        $limit  = $limit ?? 1;
        if ($id > 0)
        {
            $Users = Users::find()->where(['>=', 'id', $id])->limit($limit)->all();
            $result          = $this->asJson($Users);
        }
        else
        {
            $result->setStatusCode(404);
        }

        return $result;
    }
    
    public function actionSearch()
    {
        $find  = $this->request->get("find");
        $id    = $this->request->get("id");
        $limit = $this->request->get("limit");

//        //@Get("/api/search/{find}/{id}/{limit}")
//        $usersRepository = new UsersRepository($this->getDoctrine());
//        $findresult      = $usersRepository->findByText($find, $id, $limit);
//        $result          = $this->json($findresult);
//
//        return $result;
        $res = [ "find" => $find, $limit => $id ];
        return $this->asJson($res);
    }

    private function saveUsers($json)
    {
        $result = false;
        
        if (isset($json["firstname"]) && isset($json["secondname"]) && isset($json["surname"]))
        {
            $User = new Users();
            if (isset($json["id"]))
            {
                $User->setId($json["id"]);
                $User->refresh();
            }
            $User->setFirstname($json["firstname"]);
            $User->setSecondname($json["secondname"]);
            $User->setSurname($json["surname"]);
            $User->save();
            $UserId = $User->getId();

            if ($UserId)
            {
                $result = $User;
            }
        }

        return $result;
    }

    public function actionPost()
    {
    
        //@Post("/api/post")
        $result = $this->response;
        $result->setStatusCode(404);
    
        $content    = $this->request->getRawBody();
        $json_items = json_decode($content, true);
        foreach ($json_items as $json)
        {
            unset($json["id"]);
            $UserInfo = $this->saveUsers($json);
            if ($UserInfo)
            {
                $userjson = $UserInfo->getAttributes();
                $UserInfoArray   = [];
                $UserInfoArray[] = $userjson;
                $result          = $this->asJson($UserInfoArray)->setStatusCode(201);
            }
        }

        return $result;
    }

    public function actionPut()
    {
        //@Put("/api/put")
        $result = $this->response;
        $result->setStatusCode(404);

        $content    = $this->request->getRawBody();
        $json_items = json_decode($content, true);
        foreach ($json_items as $json)
        {
            $id = $json["id"] ?? 0;
            if ($id > 0)
            {
                $UserInfo = $this->saveUsers($json);
                if ($UserInfo)
                {
                    $result->setStatusCode(201);
                }
            }
        }

        return $result;
    }

    public function actionDelete()
    {
        //@Delete("/api/delete")
        $result = $this->response;
        $result->setStatusCode(404);
    
        $content    = $this->request->getRawBody();
        $json_items = json_decode($content, true);
        foreach ($json_items as $json)
        {
            $id = $json["id"] ?? 0;
            if ($id > 0)
            {
                $User = Users::findOne($id);
                $User->delete();
                
                $result->setStatusCode(201);
            }
        }

        return $result;
    }

}