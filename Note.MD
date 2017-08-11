Слідкувати за змінами файлу (логів) в реальному часі. Тільки для лінукс!
```tail -f /log/any.log```

```
class CareerController extends Controller
{

    private $users = []; //Массив со всеми пользователями
    private $data = []; //Массыв с деревом пользователей для построения пирамиды

    public function getCareer()
    {

        $user = \Auth::user();
        $consultName = $user->belongsToConsult->name;
        $consultPhone = $user->belongsToConsult->hasManyContacts->where('is_main', true)->first()->value;
        $consultEmail = $user->belongsToConsult->email;

        $userPoints = $user->career->points;
        $userLevel = $user->career->level;
        $userM2 = Transaction::getAmount($user->balance->m2_cli);

        $careerType = '';
        $m2Req = 0;
        $pointReq = 0;

        if ($user->career->path == Career::TYPE_INDIVIDUAL) {
            $careerType = Career::TYPE_INDIVIDUAL;
            $req = Thebestm2::getIndCareer($userLevel + 1);
            $m2Req = $req['up_req'];
        } else if ($user->career->path == Career::TYPE_GROUP) {
            $careerType = Career::TYPE_GROUP;
            $req = Thebestm2::getGroupCareer($userLevel + 1);
            $m2Req = $req['up_req'];
            $pointReq = $req['up_point'];
        }

        return view('consult.career',
            [
                'careers' => Career::allTypes(),
                'user' => $user,
                'consultName' => $consultName,
                'consultPhone' => $consultPhone,
                'consultEmail' => $consultEmail,
                'careerType' => $careerType,
                'userLevel' => $userLevel,
                'userPoints' => $userPoints,
                'userM2' => $userM2,
                'm2Req' => $m2Req,
                'pointReq' => $pointReq,
                'tree' => $this->getTree($user->id),
            ]
        );
    }


    private function test($id)
    {
        $start = microtime(true);
        $this->getTree($id);
        exit("Время выполнения скрипта: " . (microtime(true) - $start));
    }

    /**
     * Метод для построения иерархического дерева пользователей
     *
     * @param $id
     * @return array|null
     */
    private function getTree($id)
    {
        $this->users = User::withTrashed()->with('hasManyContactsWithDeleted')->with('careerWithDeleted')->get()->toArray();
        if (is_null($this->users)) return null;
        $neededUser = $this->findUsers([$id, 'id']);
        $neededUser = array_shift($neededUser);
        if (!is_null($neededUser))
            return $this->single($neededUser);
        else
            return null;
    }

    /**
     * Метод для поиска пользователя(ей) в массиве
     *
     * @param $params
     * @return array
     */
    private function findUsers($params)
    {
        return array_filter($this->users, function ($e) use (&$params) {
            return $e[$params[1]] == $params[0];
        });
    }

    /**
     * Рекурсивная функция для поиска одиночно вложения
     *
     * @param $user
     * @return array|null
     */
    private function single($user)
    {
        if (is_null($user)) return null;
        $arr = [];
        $phone = isset($user['has_many_contacts_with_deleted']) ? $user['has_many_contacts_with_deleted'][0]['value'] : '';
        $arr['text'] = ['title' => $user['career_with_deleted']['level'],
            'name' => $user['name'], 'desc' => 'email: ' . $user['email'], 'contact' => 'тел: ' . $phone];
        $data = $this->findUsers([$user['id'], 'cons_id']);
        if (count($data) == 1) {
            $arr['children'][] = $this->single(array_shift($data));
        } else if (count($data) > 1) {
            $arr['children'] = $this->multiple($data);
        }
        return $arr;
    }

    /**
     * Рекурсивная функция для поиска многомерного вложения
     *
     * @param $users
     * @return array
     */
    private function multiple($users)
    {
        $arr = [];
        foreach ($users as $u) $arr[] = $this->single($u);
        return $arr['cons_id'][array_shift($users)['cons_id']] = $arr;
    }

    public function switchCareer(Request $request)
    {

        //todo: validate request

        //__d($request->all());

        if (User::Root()->id == \Auth::user()->id || \Auth::user()->id == $request->get('userID')) {
            $user = User::find($request->get('userID'));
            $days = (strtotime(date('Y-m-d H:i:s')) - strtotime($user->career->path_change_date))/60/60/24;
            if ($user && $user->career->level > 3 && $days >= 30) {
                $career = $request->get('careerType');
                switch ($career) {
                    case Career::TYPE_GROUP:
                        if ($user->career->education) {
                            $user->career->switchCareer($career);
                        } else {
                            //log?
                        }
                        break;
                    case Career::TYPE_NONE:
                    case Career::TYPE_INDIVIDUAL:
                        $user->career->switchCareer($career);
                        break;
                    default:
                        break;
                }
            }
            return \Redirect::to(m2route('career'));
        } else {
            abort(403);
        }
    }

    /*private function single($obj){
        if (!is_null($obj)) {
            $arr = [];
            $lvl = $obj->career->level;
            $phone = $obj->hasManyContacts->where('is_main',true)->first()->value;
            $mail = $obj->email;

            $arr['text'] = ['title' => $lvl,
                'name' => $obj->name, 'desc' => 'email: '.$mail, 'contact' => 'тел: '.$phone];

            $chld = User::where('cons_id', $obj->id);

            if($chld->count() == 1){
                $arr['children'][]   = $this->single($chld->first());
            } elseif ($chld->count() > 0 && $chld->count() != 1){
                $arr['children'] = $this->multiple($chld->get());
            }

            return $arr['cons_id'][$obj->cons_id] = $arr;

        } else {
            return null;
        }
    }
    private function multiple($obj){
        $arr = [];
        $cons_id = 0;
        foreach($obj as $v){
            $cons_id = $v->cons_id;
            $arr[] = $this->single($v);
        }
        return $arr['cons_id'][$cons_id] = $arr;
    }*/


    public function educated($id)
    {
        $data['education'] = $id;
        $user = User::find($id);
        if ($user && $user->career->level > 3) {
            $user->career->education = 1;
            $user->career->save();
            $data['success'] = 'Изминения сохранены!';
        } else {
            $data['error'] = 'OOpppsss!!!';
        }

        return response()->json($data);
    }

    public function getTreeCareerParentJson(){
        $data = [
            [
                'id'       => 'ajson1',
                'parent'   => '#',
                'text'     => 'Simple root node'
            ],
            [
                'id'       => 'ajson2',
                'parent'   => '#',
                'text'     => 'Root node 2'
            ],
            [
                'id'       => 'ajson3',
                'parent'   => 'ajson2',
                'text'     => 'Child 1'
            ],
            [
                'id'       => 'ajson4',
                'parent'   => 'ajson2',
                'text'     => 'Child 2'
            ],
            [
                'id'       => 'ajson5',
                'parent'   => '#',
                'text'     => 'Simple root node',
                "children" => true
            ]
        ];
        return response()->json($data);
    }

    public function getTreeCareerChildrenJson(){
        $data = [
            [
                'id'       => 'ajson6',
                'parent'   => 'ajson5',
                'text'     => 'Child 3'
            ]
        ];
        return response()->json($data);
    }
}
```
