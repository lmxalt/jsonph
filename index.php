<?php
class JSONPh
{ 
    public function displayUsers($id) { //метод отображения пользователей
        $ch = curl_init(); //сеанс CURL
        if ($id == NULL){
            $url = "https://jsonplaceholder.typicode.com/users"; 
        } else $url = "https://jsonplaceholder.typicode.com/users/" . $id; //проверка id при вызове метода 

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true //получение ответа от сервера в $data
        ]);

        $data = curl_exec($ch);
        if($e = curl_error($ch)){ //вывод ошибки
            return $e;
        }
        else {
            $decoded = json_decode($data);
            echo '<pre>';
            print_r($decoded);  //Вывод данных о пользователях
            echo  '</pre>';
            return $decoded;
        }
        curl_close($ch); //завершение сеанса CURL
    }
    public function displayPosts($userId) { //метод отображения постов
        $ch = curl_init();
        
        if ($userId == NULL){
            $url = "https://jsonplaceholder.typicode.com/posts";
        } else $url = "https://jsonplaceholder.typicode.com/posts?userId=" . $userId; //проверка userId при вызове метода 
         
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $data = curl_exec($ch);
        if($e = curl_error($ch)){
            return $e;
        }
        else {
            $decoded = json_decode($data);
            echo '<pre>';
            print_r($decoded);
            echo  '</pre>';
            return $decoded;
        }
        curl_close($ch);
    }
    public function displayTodos($userId) { //метод отображения заданий пользователей
        $ch = curl_init();

        if ($userId == NULL){
            $url = "https://jsonplaceholder.typicode.com/todos";
        } else $url = "https://jsonplaceholder.typicode.com/todos?userId=" . $userId;  

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $data = curl_exec($ch);
        if($e = curl_error($ch)){
            return $e;
        }
        else {
            $decoded = json_decode($data);
            echo '<pre>';
            print_r($decoded);
            echo '<pre>';
        }
        return $data;
        curl_close($ch);
    }
   
    public function postPost($userId, $title, $body){ //метод добавления поста
        $ch = curl_init();
        $url = "https://jsonplaceholder.typicode.com/posts";

        $data_array = array( //значения передающиеся в поля
            'userId' => $userId,
            'id' => '',
            'title' => $title,
            'body' => $body
        );

        $data = http_build_query($data_array);

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,  //метод POST
            CURLOPT_POSTFIELDS => $data, //значения передаются в качестве полей
            CURLOPT_RETURNTRANSFER => true
        ]);

        $resp = curl_exec($ch);
        if($e = curl_error($ch)){
            return $e;
        }
        else {
            $decoded = json_decode($resp);
            
            foreach($decoded as $key =>$val){
                print_r($key . ': ' . $val . '<br>');   
            }
        }
        return $resp;
        curl_close($ch);
    }
    
    public function updatePost($id, $title, $body){ //метод обновления поста
        $ch = curl_init();
        $url = "https://jsonplaceholder.typicode.com/posts/" . $id;
        
        $data_array = array( 
            'id' => $id,
            'title' => $title,
            'body' => $body
        );
        

        $data = http_build_query($data_array);

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true
        ]);
      
        $resp = curl_exec($ch);
        if($e = curl_error($ch)){
            return $e;
        }
        else {
            $decoded = json_decode($resp, true);
            foreach($decoded as $key =>$val){
                print_r($key . ': ' . $val . '<br>');
            }
        }
        return $resp;
        curl_close($ch);
    }
    
    public function deletePost($id) { //метод удаления поста

    $url = "https://jsonplaceholder.typicode.com/posts/".$id;
    $ch = curl_init();
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => "DELETE",
    ]);
    
    /* $header = ["Content-type: application/json; charset=UTF-8",
        "Accept-language: en"];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_HEADER, true); */
    $result = curl_exec($ch);
    if($e = curl_error($ch)){
        return $e;
    }
    else {
        return $result;
    }
    //$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    //var_dump($http);
    }
}

$var = new JSONPh();

$var -> displayUsers(2);
echo '<br>';
$var -> displayPosts(2);
echo '<br>';
$var -> displayTodos(2);
echo '<br>'; 

$var -> postPost(2, 'insdds quibusdam temp', 'voluptatem insddsinsddsinsdds temp');
echo '<br>';
$var -> updatePost(2, 'insdds quibusdam temp', 'voluptatem insddsinsddsinsdds temp');
echo '<br>';
$var -> deletePost(14);
?>