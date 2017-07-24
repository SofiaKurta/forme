{{ route('admin.user.create', [43]) }}

{{ HTML::linkRoute('items.show', 'Show item #4', array(4)) }}

Слідкувати за змінами файлу (логів) в реальному часі. Тільки для лінукс!
```tail -f /log/any.log```

# Великий текст за втопереносом
# print('''Hello
# World''')

# Введення даних в консолі
# i = input("Як Вас звати: ")
# print(i)

# Вивести строку 10 раз
# print('Something strin...' * 10)

#test1 = 'Тестова строка'
#test2 = 2
#print(test1 + str(test2))

# Видалення перемінної
#del(test1)

#МЕТАСИНТАКСИЧНІ ПЕРЕМІННІ зарезервовані системою

from tkinter import *

root = Tk()
root.title('Бомба')
root.geometry('500x500')

root.mainloop()


```
<?php
    $data = array(
        (object)array(
            'id' => 1,
            'name' => 'first prject',
            'prj_id' => null,
        ),
        (object)array(
            'id' => 2,
            'name' => 'second prject',
            'prj_id' => null,
        ),
        (object)array(
            'id' => 3,
            'name' => 'three prject',
            'prj_id' => 2
        ),
        (object)array(
            'id' => 4,
            'name' => 'four prject',
            'prj_id' => 3,
        ),
        (object)array(
            'id' => 5,
            'name' => 'five prject',
            'prj_id' => 4,
        ),
        (object)array(
            'id' => 6,
            'name' => 'five prject',
            'prj_id' => 2,
        ),
        
    );
	
	function getTree($data, $parentId)
	{
		$childrens = array_filter($data, function ($element) use ($parentId)
		{
			/*Вертає масив елементів де $data->prj_id == $parentId */
			return $element->prj_id == $parentId; }
		);
		foreach ($childrens as $children) {
			$arrayOfElements = getTree($data, $children->id);
			if (!empty($arrayOfElements)) {
				$children->children = array_merge($arrayOfElements);
			}
		}

		return $childrens;
	}

	$d = getTree($data, null);


	echo "<pre>";
	echo print_r($d);
	echo "</pre>";
  ```
##!!!!!!!!!!!!!!!!!
```
<?php
use Baum\Node;

/**
* Category
*/
class Category extends Node {

  public static $validationAddCategory = array(
      'link'     =>  'max:1000',
      'name_category_ua'     =>  'required|cyrillic_num|min:3|max:100',
      'description_ua'     =>  'cyrillic_num|min:20|max:255',
      'name_category_ru'     =>  'required|cyrillic_num|min:3|max:100',
      'description_ru'     =>  'cyrillic_num|min:20|max:255',
      'name_category_en'     =>  'required|cyrillic_num|min:3|max:100',
      'description_en'     =>  'cyrillic_num|min:20|max:255',
      'category'  => 'required|numeric',
  );

  public static $validationPutEditCategory = array(
    'link'     =>  'max:1000',
    'name_category_ua'     =>  'required|cyrillic_num|min:3|max:100',
    'description_ua'     =>  'cyrillic_num|min:20|max:255',
    'keywords_ua'     =>  'cyrillic_num|min:20|max:255',
    'name_category_ru'     =>  'required|cyrillic_num|min:3|max:100',
    'description_ru'     =>  'cyrillic_num|min:20|max:255',
    'keywords_ru'     =>  'cyrillic_num|min:20|max:255',
    'name_category_en'     =>  'required|cyrillic_num|min:3|max:100',
    'description_en'     =>  'cyrillic_num|min:20|max:255',
    'keywords_en'     =>  'cyrillic_num|min:20|max:255',
    'category'  => 'required|numeric',
    'id'  => 'required|numeric',
  );

  public static $validationEditCategory = array(
      'category' => 'required|numeric',
  );

  public static $validationDeleteCategory = array(
      'category' => 'required|numeric',
  );

  public static function getLng(){
    return SecLang::get();
  }

  public static function clearCache(){
    $categories = Category::getCat();
    foreach($categories as $category){
      if (Cache::has('cat_'.$category['id'])){
        Cache::forget('cat_'.$category['id']);
      }
    }

    Cache::forget('categories_ua');
    Cache::forget('categories_ru');
    Cache::forget('categories_en');
    return true;
  }

  //Отримати дерево категорій в масиві/////////////////////////////////////////////////////////////
  public static function getCat(){
    $catsObj = Category::orderBy('sort','ASC')->get();

    $categoriesArray = array();
    foreach($catsObj as $cat){
      if(self::getLng() == 'ru') { $lng = $cat->name_ru; }
      elseif(self::getLng() == 'en') { $lng = $cat->name_en; }
      else { $lng = $cat->name_ua; }
      $categoriesArray[$cat->id] = array(
          'id' => $cat->id,
          'link' => $cat->link,
          'parent' => $cat->parent_id,
          'name' => $lng,
          'sort' => $cat->sort,
      );
    }
    return $categoriesArray;
  }

  public static function getListCategories(){
    $categories = self::getCat();
    $tree = array();
    foreach ($categories as $id => &$node) {
      //Якщо нема вкладень
      if (!$node['parent']){
        $tree[$id] = &$node;
      }else{
        //Якщо є нащадки то перебираємо масив
        $categories[$node['parent']]['childs'][$id] = &$node;
      }
    }
    return $tree;
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////


  //Формування тегу select з категоріями///////////////////////////////////////////////////////////
  public static function getSelectTree(){
    $tree = self::getListCategories();
    $categories = Category::getCat();
    if(is_array($tree)){
      $select = '<select name="category" style="width:470px;" class="form-control"><option value="0">'.trans('controllers/admin/category_controller.mdl_gst_general_branch').'</option>';
      $select .= self::tplOption($categories,$tree);
      $select .= '</select>';
      return $select;
    } else {
      return false;
    }
  }

  public static function getSelectForEditTree($id_selected){
    $tree = self::getListCategories();
    $categories = Category::getCat();
    if(is_array($tree)){
        $select = '<select name="category" style="width:470px;" class="form-control"><option value="0">'.trans('controllers/admin/category_controller.mdl_gst_general_branch').'</option>';
        $select .= self::tplOption($categories,$tree,$id_selected);
        $select .= '</select>';
        return $select;
    } else {
        return false;
    }
  }

  private static function tplOption(&$categories,$tpl = false,$id_selected = false){
    $ct = '';
    foreach($tpl as $val){
      if($id_selected == $val['id']) $selected = 'selected'; else $selected = '';
      $sub = self::getLevelt($categories, $val['id']);
      if(!empty($val['link'])){$b = '<strong>'; $bs = '</strong>';} else {$b = '<strong>'; $bs = '</strong>';}
      $ct .= '<option '.$selected.' value="'.$val['id'].'">'.self::makeHtmlMargin($sub).$b.$val['name'].$bs.'</option>';
      if(isset($val['childs'])){
        $ct .= self::tplOption($categories,$val['childs'],$id_selected);
      }
    }
    return $ct;
  }

  private static function makeHtmlMargin($level = 0){
    $subLevelMarker = '';
    for ($i = 0; $i < $level; $i++) $subLevelMarker .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    return $subLevelMarker;
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////

  //Рівень вкладеності категорії///////////////////////////////////////////////////////////////////
  public static function getLevelt(&$categories, $id)
  {
      if($id > 0){
        $level = 0;
        while( $id = $categories[$id]['parent'] ) $level++;
        return $level;
      } else {
        return 0;
      }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////

  //Сортування категорій///////////////////////////////////////////////////////////////////////////
  private static function sortCategory($categories,$cat){
    //Відфільтровуємо масив. Отримуємо потрібну гілку.
    $catFilter = array_filter($categories, function($v) use ($cat) {
      return $v['parent'] == $cat;
    });
    $count = 1;
    foreach($catFilter as $category){
      if ($category['sort'] != $count) break;
      $count++;
    }
    return $count;
  }

  private static function sortCategoryPush($categories,$category){
    $sort = 1;
    $retreat = 1;
    foreach($categories as $cat){
      if($cat['sort'] == $retreat) $retreat++;
      if($cat['parent'] == $category){
        $sort++;
      }
    }
    if($retreat > $sort) $sort++;
    return $sort;
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////

  //Додаємо нову категорію/////////////////////////////////////////////////////////////////////////
  public static function addNewCategory(){

    if(!empty(Input::get('name_category_ua')) && !empty(Input::get('name_category_ru')) && !empty(Input::get('name_category_en'))){
      $categories = Category::getCat();
      $sort = self::sortCategoryPush($categories,Input::get('category'));
      Keywords::setKeywordCount(10);
      $res_ua = Keywords::generateMeta(Input::get('description_ua'));
      $res_ru = Keywords::generateMeta(Input::get('description_ru'));
      $res_en = Keywords::generateMeta(Input::get('description_en'));

      $result = Category::insert(
          array(
              'link' => self::checkEmptiness(Input::get('link')),
              'name_ua' => Input::get('name_category_ua'),
              'name_ru' => Input::get('name_category_ru'),
              'name_en' => Input::get('name_category_en'),
              'desc_ua' => self::checkEmptiness(Input::get('description_ua')),
              'desc_ru' => self::checkEmptiness(Input::get('description_ru')),
              'desc_en' => self::checkEmptiness(Input::get('description_en')),
              'keywords_ua' => self::checkEmptiness($res_ua['keywords']),
              'keywords_ru' => self::checkEmptiness($res_ru['keywords']),
              'keywords_en' => self::checkEmptiness($res_en['keywords']),
              'parent_id' => Input::get('category'),
              'sort' => $sort,
              'created_at' => date('Y-m-d H:m:s'),
              'updated_at' => date('Y-m-d H:m:s'),
          )
      );
      self::clearCache();
      return $result;
    } else {
      return false;
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////

  //Редагуємо категорію////////////////////////////////////////////////////////////////////////////
  /**
   * @return bool|int
   */
  public static function updateCategory(){
    $id = Input::get('id');
    $categories = Category::getCat();
    //Перевірка чи категорія не переміщається в дочірню гілку
    if(self::paternityTest($categories,Input::get('category'),$id)) return false;
    if(Input::get('parent') == Input::get('category')) return false;

    $upd = array(
      'link' => self::checkEmptiness(Input::get('link')),
      'name_ua' => Input::get('name_category_ua'),
      'name_ru' => Input::get('name_category_ru'),
      'name_en' => Input::get('name_category_en'),
      'desc_ua' => self::checkEmptiness(Input::get('description_ua')),
      'desc_ru' => self::checkEmptiness(Input::get('description_ru')),
      'desc_en' => self::checkEmptiness(Input::get('description_en')),
      'keywords_ua' => self::checkEmptiness(Input::get('keywords_ua')),
      'keywords_ru' => self::checkEmptiness(Input::get('keywords_ru')),
      'keywords_en' => self::checkEmptiness(Input::get('keywords_en')),
    );

    DB::beginTransaction();
    $sortInput = Input::get('sort');
    if(!empty($sortInput) && is_numeric($sortInput)){
      //Перевіряємо чи значення Input::get('sort') не більше кількості самих категорій
      $catFilter = array_filter($categories, function($v) {
        return $v['parent'] == Input::get('parent');
      });
      if(Input::get('sort') > count($catFilter)) return false;
      //Міняємося значенням SORT
      $res_resort = Category::where('sort', Input::get('sort'))
          ->where('parent_id', Input::get('parent'))
          ->update(array('sort' => Input::get('old_sort')));
      if($res_resort){
        $upd['sort'] = Input::get('sort');
      } else {
        $upd['sort'] = self::sortCategory($categories,Input::get('parent'));
      }
    }
    //Якщо категорія переміщається в іншу гілку тоді виконуємо значення
    if(Input::get('category') != $id){
        $upd['sort'] = self::sortCategoryPush($categories,Input::get('category'));
      if(empty($sortInput)){
        $upd['parent_id'] = Input::get('category');
      }
    }
    if(Category::where('id', $id)->update($upd)){
      DB::commit();
      self::clearCache();
      return true;
    } else {
      DB::rollback();
      return false;
    }
  }

  private static function paternityTest($categories,$cat,$id){
    if(!$cat) return false;
    while( $cat = $categories[$cat]['parent']){
      if($cat == $id) return true;
    }
    return false;
  }

  private static function checkEmptiness($void){
    if(empty($void)){
      return null;
    } else {
      return $void;
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////

  //Видаляємо категорію////////////////////////////////////////////////////////////////////////////
  public static function deleteCategory(){
    $id = Input::get('id');
    DB::beginTransaction();
    $idArr = self::getParrentCategoryId($id);
    //Видалення всіх новин в категоріях які видаляються
    Posts::whereIn('category_id', $idArr)->delete();

    if(Category::whereIn('id', $idArr)->delete()){
      DB::commit();
      self::clearCache();
      return true;
    } else {
      DB::rollback();
      return false;
    }
  }

  private static function ifIssetChildBranch($tree,$id,&$branch = array()){
    foreach($tree as $category){
      if($category['id'] == $id){
        $branch[] = $category;
        break;
      }
      if(isset($category['childs'])){
        self::ifIssetChildBranch($category['childs'],$id,$branch);
      }
    }
    return $branch;
  }

  private static function depthOfBranch($branchs,&$idArr = array()){
    foreach($branchs as $branch){
      $idArr[] = $branch['id'];
      if(isset($branch['childs'])){
        self::depthOfBranch($branch['childs'],$idArr);
      }
    }
    return $idArr;
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////

  //Генерація HTML дерева категорій////////////////////////////////////////////////////////////////
  public static function generateCategoryForHtml(){
    if (Cache::has('categories_'.self::getLng())) {
      return Cache::get('categories_'.self::getLng());
    } else {
      $tree = self::getListCategories();
      $gen = self::generateLi($tree);
      Cache::forever('categories_'.self::getLng(), $gen);
      return $gen;
    }
  }

  private static function generateLi($tree){
    $res = '';
    foreach($tree as $val){
      if(isset($val['childs'])){
        $res .= '<li>';
        if(!empty($val['link'])){
          if(preg_match("~^http[s]?:\/\/~", $val['link'])) {
            $res .= '<a href="' . $val['link'] . '">' . $val['name'] . '</a>';
          } else {
            $res .= '<a href="' . Config::get('app.url') . $val['link'] . '">' . $val['name'] . '</a>';
          }
        } else {
          $res .= '<a href="'.Config::get('app.url').'/cat/'.$val['id'].'">'.$val['name'].'</a>';
        }
        $res .= '<ul>';
        $res .= self::generateLi($val['childs']);
        $res .= '</ul>';
        $res .= '</li>';
      } else {
        if(!empty($val['link'])){
          if(preg_match("~^http[s]?:\/\/~", $val['link'])) {
            $res .= '<li><a href="' . $val['link'] . '">' . $val['name'] . '</a></li>';
          } else {
            $res .= '<li><a href="' . Config::get('app.url') . $val['link'] . '">' . $val['name'] . '</a></li>';
          }
        } else {
          $res .= '<li><a href="'.Config::get('app.url').'/cat/'.$val['id'].'"> '.$val['name'].' </a></li>';
        }
      }
    }
    return $res;
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////

  public static function getParrentCategoryId($id){
    if (Cache::has('cat_'.$id)) {
      return Cache::get('cat_'.$id);
    } else {
      $tree = self::getListCategories();
      $branch = self::ifIssetChildBranch($tree,$id);
      $idArr = self::depthOfBranch($branch);
      Cache::forever('cat_'.$id, $idArr);
      return $idArr;
    }
  }

  public static function getListPostsInCategy($id){
    $idArr = self::getParrentCategoryId($id);
    return Posts::whereIn('category_id', $idArr)
        ->where('enabled',true)
        ->orderBy('id', 'desc')
        ->remember(1440)
        ->paginate(10);
  }

  public static function getCatInfo($id){
    $res = Category::where('id', $id)->remember(1440)->first();
    if($res){
      switch(SecLang::get()){
        case 'ru':
          $name = $res->name_ru;
          $desc = $res->desc_ru;
          $keyw = $res->keywords_ru;
          break;
        case 'en':
          $name = $res->name_en;
          $desc = $res->desc_en;
          $keyw = $res->keywords_en;
          break;
        default:
          $name = $res->name_ua;
          $desc = $res->desc_ua;
          $keyw = $res->keywords_ua;
      }
      return array(
          'name' => $name,
          'desc' => $desc,
          'keyw' => $keyw,
      );
    }
    return false;
  }
}
```
