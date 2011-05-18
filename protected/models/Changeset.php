<?php
/*
 * This file is part of
 *     ____              _ __
 *    / __ )__  ______ _(_) /_____  _____
 *   / __  / / / / __ `/ / __/ __ \/ ___/
 *  / /_/ / /_/ / /_/ / / /_/ /_/ / /
 * /_____/\__,_/\__, /_/\__/\____/_/
 *             /____/
 * A Yii powered issue tracker
 * http://bitbucket.org/jacmoe/bugitor/
 *
 * Copyright (C) 2009 - 2011 Bugitor Team
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
?>
<?php

/**
 * This is the model class for table "{{changeset}}".
 *
 * The followings are the available columns in table '{{changeset}}':
 * @property integer $id
 * @property string $unique_ident
 * @property string $revision
 * @property string $author
 * @property integer $user_id
 * @property integer $scm_id
 * @property string $commit_date
 * @property string $message
 * @property integer $short_rev
 * @property string $parents
 * @property string $branches
 * @property string $tags
 * @property integer $branch_count
 * @property integer $tag_count
 * @property integer $parent_count
 * @property integer $child_count
 * @property integer $add
 * @property integer $edit
 * @property integer $del
 *
 * The followings are the available model relations:
 * @property Change[] $changes
 * @property Repository $scm
 * @property User $user
 * @property ChangesetIssue[] $changesetIssues
 */
class Changeset extends CActiveRecord
{
	public $maxRev;

        /**
	 * Returns the static model of the specified AR class.
	 * @return Changeset the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{changeset}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unique_ident, revision, commit_date, message', 'required'),
			array('user_id, scm_id, short_rev, add, edit, del, branch_count, tag_count, parent_count, child_count', 'numerical', 'integerOnly'=>true),
			array('author, revision, parents, branches, tags, children', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, revision, user_id, author, scm_id, commit_date, message, short_rev, parents, branches, tags, add, edit, del', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'changes' => array(self::HAS_MANY, 'Change', 'changeset_id'),
                        'scm' => array(self::BELONGS_TO, 'Repository', 'scm_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
                        'changesetIssues' => array(self::HAS_MANY, 'ChangesetIssue', 'changeset_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'revision' => 'Revision',
			'unique_ident' => 'Unique Identifier',
                        'user_id' => 'User',
			'scm_id' => 'Scm',
			'commit_date' => 'Commit Date',
			'message' => 'Message',
			'short_rev' => 'Short Rev',
			'parents' => 'Parents',
			'children' => 'Children',
			'branches' => 'Branches',
			'tags' => 'Tags',
			'add' => 'Add',
			'edit' => 'Edit',
			'del' => 'Del',
                        'author' => 'Author',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('unique_ident',$this->unique_ident);
		$criteria->compare('revision',$this->revision,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('scm_id',$this->scm_id);
		$criteria->compare('commit_date',$this->commit_date,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('short_rev',$this->short_rev);
		$criteria->compare('parents',$this->parents,true);
		$criteria->compare('branches',$this->branches,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('add',$this->add);
		$criteria->compare('edit',$this->edit);
		$criteria->compare('del',$this->del);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        public static function changesetFromRevision($revision)
        {
            $changeset = Changeset::model()->findByAttributes(array('revision' => $revision));
            return $changeset;
        }
}
