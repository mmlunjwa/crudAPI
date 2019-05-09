<?php


namespace App\Controllers;

use App\Models\Presenters;
use App\Models\Shows;
use App\Models\Slots;
use App\Models\Stations;
use App\Helpers\Validator;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class RadioController extends Controller
{

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function addModel(Request $request, Response $response, $args){

        $models = array('Presenters', 'Shows', 'Slots', 'Stations');
        $model_name = ucfirst($request->getParam('model'));

        if(in_array($model_name,$models)){
            if($model_name == 'Shows'){
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'name' => Validator::alnum("'-_")->notBlank(),
                    'slot_id' => Validator::intVal()->noWhitespace()->notBlank(),
                ]);
            }elseif ($model_name == 'Stations'){
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'name' => Validator::alnum("'-_")->notBlank(),
                ]);
            }elseif ($model_name == 'Presenters'){
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'name' => Validator::alnum("'-_")->notBlank(),
                ]);
            }else if ($model_name == 'Slots') {
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'show_id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'station_id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'time_in' => Validator::notBlank(),
                    'time_out' => Validator::notBlank(),
                    'day_of_week' => Validator::alnum("'-_")->notBlank(),
                ]);
            }
        }else{
            return $response->withStatus(400)->withJson([
                'status' => 'Error',
                'message' => 'Incorrect model specified'
            ]);
        }

        if ($validator->isValid()) {
            if(in_array($model_name,$models)){
                if($model_name == 'Shows'){
                    $model       =   new Shows();
                }elseif ($model_name == 'Stations'){
                    $model       =   new Stations();
                }elseif ($model_name == 'Presenters'){
                    $model       =   new Presenters();
                }else if ($model_name == 'Slots') {
                    $model = new Slots();
                }
            }

            $model_details     =   $model->create($request);

            if ($model_details) {
                return $response->withStatus(200)->withJson([
                    'status' => 'Success',
                    'count'     => count($model_details),
                    'data'     => $model_details
                ]);

            } else {
                //return failure message if user does not exist
                return $response->withStatus(400)->withJson([
                    'status' => 'Error',
                    'message' => "{$model_name} does not exist"
                ]);
            }
        } else {
            return $response->withStatus(400)->withJson([
                'status' => 'Validation Error',
                'message' => $validator->getErrors()
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function listModel(Request $request, Response $response, $args){

        $models = array('Presenters', 'Shows', 'Slots', 'Stations');
        $model_name = ucfirst($request->getParam('model'));

        if(in_array($model_name,$models)){
            $filter_attribute = $request->getParam('filter_attribute');
            $filter_value = $request->getParam('filter_value');
            if(isset($filter_attribute) &&  isset($filter_value)){
                $validator = $this->c->validator->validate($request, [
                    'filter_attribute' => Validator::alnum("'-_")->notBlank(),
                    'filter_values' => Validator::alnum("'-_")->notBlank(),
                    'model' => Validator::alnum("'-_")->notBlank(),
                ]);
            } else{
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                ]);
            }
        }else{
            return $response->withStatus(400)->withJson([
                'status' => 'Error',
                'message' => 'Incorrect model specified'
            ]);
        }

        if ($validator->isValid()) {
            if(in_array($model_name,$models)){
                if($model_name == 'Shows'){
                    $model       =   new Shows();
                }elseif ($model_name == 'Stations'){
                    $model       =   new Stations();
                }elseif ($model_name == 'Presenters'){
                    $model       =   new Presenters();
                }else if ($model_name == 'Slots') {
                    $model = new Slots();
                }
            }

            $model_details     =   $model->getList($request);

            if ($model_details) {
                return $response->withStatus(200)->withJson([
                    'status' => 'Success',
                    'count'     => count($model_details),
                    'data'     => $model_details
                ]);

            } else {
                //return failure message if user does not exist
                return $response->withStatus(400)->withJson([
                    'status' => 'Error',
                    'message' => "{$model_name} does not exist"
                ]);
            }
        } else {
            return $response->withStatus(400)->withJson([
                'status' => 'Validation Error',
                'message' => $validator->getErrors()
            ]);
        }
    }


    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function updateModel(Request $request, Response $response, $args){

        $models = array('Presenters', 'Shows', 'Slots', 'Stations');
        $model_name = ucfirst($request->getParam('model'));
        if(in_array($model_name,$models)){
            if($model_name == 'Shows'){
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'name' => Validator::alnum("'-_")->notBlank(),
                    'id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'slot_id' => Validator::intVal()->noWhitespace()->notBlank(),
                ]);
            }elseif ($model_name == 'Stations'){
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'name' => Validator::alnum("'-_")->notBlank(),
                ]);
            }elseif ($model_name == 'Presenters'){
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'name' => Validator::alnum("'-_")->notBlank(),
                ]);
            }else if ($model_name == 'Slots') {
                $validator = $this->c->validator->validate($request, [
                    'model' => Validator::alnum("'-_")->notBlank(),
                    'id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'show_id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'station_id' => Validator::intVal()->noWhitespace()->notBlank(),
                    'time_in' => Validator::notBlank(),
                    'time_out' => Validator::notBlank(),
                    'day_of_week' => Validator::alnum("'-_")->notBlank(),
                ]);
            }
        }else{
            return $response->withStatus(400)->withJson([
                'status' => 'Error',
                'message' => 'Incorrect model specified'
            ]);
        }

        if ($validator->isValid()) {
            if($model_name == 'Shows'){
                  $model       =   new Shows();
            }elseif ($model_name == 'Stations'){
                $model       =   new Stations();
            }elseif ($model_name == 'Presenters'){
                $model       =   new Presenters();
            }else if ($model_name == 'Slots') {
               $model = new Slots();
            }

            $model_details     =   $model->update($request);

            if ($model_details) {
                return $response->withStatus(200)->withJson([
                    'status' => 'Success',
                    'count'     => count($model_details),
                    'data'     => $model_details
                ]);

            } else {
                //return failure message if user does not exist
                return $response->withStatus(400)->withJson([
                    'status' => 'Error',
                    'message' => "{$model_name} does not exist"
                ]);
            }
        } else {
            return $response->withStatus(400)->withJson([
                'status' => 'Validation Error',
                'message' => $validator->getErrors()
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function deleteModel(Request $request, Response $response, $args){
        $models = array('Presenters', 'Shows', 'Slots', 'Stations');
        $model_name = ucfirst($request->getParam('model'));
        if(in_array($model_name,$models)) {
            $validator = $this->c->validator->validate($request, [
                'model' => Validator::alnum("'-_")->notBlank(),
                'id' => Validator::intVal()->noWhitespace()->notBlank(),
            ]);
        }else{
            return $response->withStatus(400)->withJson([
                'status' => 'Error',
                'message' => 'Incorrect model specified'
            ]);
        }

        if ($validator->isValid()) {
            if(in_array($model_name,$models)){
                if($model_name == 'Shows'){
                    $model       =   new Shows();
                }elseif ($model_name == 'Stations'){
                    $model       =   new Stations();
                }elseif ($model_name == 'Presenters'){
                    $model       =   new Presenters();
                }else if ($model_name == 'Slots') {
                    $model = new Slots();
                }
            }else{
                return $response->withStatus(400)->withJson([
                    'status' => 'Error',
                    'message' => 'Incorrect model specified'
                ]);
            }

            //check
            $model_details     =   $model->remove($request);

            if ($model_details) {
                return $response->withStatus(200)->withJson([
                    'status' => 'Success',
                    'count'     => count($model_details),
                    'data'     => $model_details
                ]);

            } else {
                //return failure message if user does not exist
                return $response->withStatus(400)->withJson([
                    'status' => 'Error',
                    'message' => "{$model_name} does not exist"
                ]);
            }
        } else {
            return $response->withStatus(400)->withJson([
                'status' => 'Validation Error',
                'message' => $validator->getErrors()
            ]);
        }
    }

}